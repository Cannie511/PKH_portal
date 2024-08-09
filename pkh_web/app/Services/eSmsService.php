<?php 
namespace App\Services;
use App\Services\ESMS\EsmsEndpoint;
use App\Services\ESMS\EsmsTempId;
use App\Services\ESMS\Esms;
use Exception;
use App\Services\FuncConfService;
use Illuminate\Support\Facades\Log;
class eSmsService 
{
    const ESMS_API_KEY ="58F65ACA4D72E730093418DE90A96A";
    const ESMS_SECRET_KEY = "DC0D9B321DBFEFBD1B6C31AEC09358";

    const SEND_SMS = "https://rest.esms.vn/MainService.svc/json/SendMultipleMessage_V4_post_json/";//API SEND SMS OTP/CSKH
    const SEND_ZALO = "https://rest.esms.vn/MainService.svc/json/SendZaloMessage_V6/";//API 
    const ESMS_BRANDNAME ="Baotrixemay";//BrandName đăng ký 

    const EMS_API_KEY_TEST ="E264C43C8157026D7F98385F549598";// API KEY CTY
    const ESMS_SECRET_KEY_TEST ="42E9C9F0F7A11242D88D524FFF7986"; //API SECRET KEY CTY
    const ZALO_OA ="1307991396108552028"; 
    
    //http_request
    private function sendRequest($data)
    {
      $ch = curl_init(self::SEND_SMS);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, [
          'Content-Type: application/json',
      ]);
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
      $response = curl_exec($ch);

      if (curl_errno($ch)) {
          throw new \Exception('cURL error: ' . curl_error($ch));
      }

      curl_close($ch);
    //   $result = json_decode($response, true);
      return  $response;
    }

    // hàm dùng thực hiện gửi và nhận toàn bộ Response
    public function post($id,$phone,$param)
    {
        $data = $this->buildSMS($id,$phone,$param);
        $req = json_encode($data);
        $response = $this->sendRequest($req);
        return json_decode($response,true);
    }

    //Hàm dùng để tổng hợp toàn bộ thông tin request
    public function buildSMS($id,$phone,$param)
    {
      $data = array(
        'ApiKey' => self::EMS_API_KEY_TEST,
        'SecretKey'=>self::ESMS_SECRET_KEY_TEST,
        'Phone' =>$phone,
        "Brandname" => self::ESMS_BRANDNAME,
        "SmsType" => "2",// Loại tin nhắn: 2 là Tin nhắn SMS OTP/CSKH,
        'CallbackUrl'  =>  'https://www.phankhangco.com',
        "IsUnicode" => 0,
        "Sandbox"=> "1",
      );
      $temp = $this->buildContent($id,$phone,$param);

      $data= $data + $temp;
      return $data;
    }
    // hàm dùng để xác định loại content sẽ được gửi cho khách hàng
    public function buildContent($id,$phone,$param)
    {
      switch($id){
        case 1:// tin nhắn thanh toán
         
          // 5 param param['customer_name'],param['address'],param['payments'],param['payment_id'],param['total_score_card']
          $content = "Xác nhận thanh toán Phan Khang Home trân trọng xác nhận quý Đại Lý đã thanh toán thành công.Tên khách hàng ". $param['customer_name'].".Có địa chỉ".$param['address']." .Số tiền thanh toán ".$param['payments'].".Mã thanh toán ".$param['payment_id'].".Điểm tích".$param['total_score_card']."";
          $data = array (
            'Content'=> $content,
            'campaignid' => "Cảm ơn sau mua hàng tháng 7",
          );
          return $data;
        case 2: // Tin nhắn nhắc điểm
          // param['total_score_card']
          $content = "Điểm tích lũy của quý khách trong quý này là ".$param['total_score_card'].". Qúy khách vẫn chưa sử dụng điểm mếu không sử dụng trong quý này thì điểm sẽ hết hiệu lực ";
          $data = array (
            'Content'=> $content,
            'campaignid' => "Nhắc nhở dùng điểm tích lũy",
          );
          return $data;
        } 
    }
    // gửi tin sms khi đã thanh toán
    public function sendSMS($phone, $param) {
    $data = $this->post(1,$phone,$param);
     return $data['CodeResult'];
  }

  //Gửi tin nhắn điểm 
  public function sendScore($phone,$param) {
    $data = $this->post(2,$phone,$param);
     return $data['CodeResult'];;
}
//-------------------------------------------------------------------------------//


// Gửi tin nhắn bằng zalo
  public function sendZalo($phone, $param,$id)
  {
    $funcConfService = new FuncConfService();
    $store_id = $id;
    $temp_id = EsmsTempId::TEMP_ID_PAYMENT_CONFIRM;
    $ems = new Esms($funcConfService);
    $data = $ems->post($temp_id,$phone,$store_id,$param);
    log::info('Running1');
    return $data['CodeResult'];
  }
}

