<?php namespace App\Services;

use Log;
use GuzzleHttp\Client;

/**
 * UserService
 */
class ZaloService
{
    const BASE_V2_API = "https://openapi.zalo.me/v2.0";

    /**
     * @var string
     */
    private $oaid = null;
    /**
     * @var string
     */
    private $secret_key = "QkLBm86SEbhP8DgG9OVg";

    private $access_token = null;

    /**
     * @var string
     */
    private $base_url_send_message = 'https://openapi.zaloapp.com/oa/v1/sendmessage/text';
    /**
     * @var string
     */
    private $base_url_get_list_followers = "https://openapi.zalo.me/v2.0/oa/getfollowers";
    /**
     * @var string
     */
    private $base_url_get_follower = "https://openapi.zalo.me/v2.0/oa/getprofile";


    public function __construct() {
        $this->oaid = env("ZALO_OAID", "1307991396108552028");
        $this->access_token = env("ZALO_ACCESS_TOKEN", "");
        $this->client = new Client([
            'headers' => ['Content-Type' => 'application/json'],
        ]);
    }

    /**
     * @param $base_url
     * @param $myvars
     */
    private function makePostRequest(
        $base_url,
        $myvars
    ) {
        $ch = curl_init($base_url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $myvars);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }

    /**
     * @param $base_url
     * @param $myvars
     */
    private function makeGetRequest(
        $base_url,
        $myvars
    ) {
        $ch = curl_init($base_url . '?' . $myvars);
        // Log::debug($base_url.'?'.$myvars);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }

// Get maximum 50 followers at one time
    /**
     * @return mixed
     */
    public function getList50Followers()
    {
        $data          = '{"offset":0,"count":50}';
        $timestamp     = round(microtime(true) * 1000);
        $hash_code_get = $this->oaid . $data . strval($timestamp) . $this->secret_key;
        $mac           = hash('sha256', $hash_code_get);

        $myvars = 'oaid=' . $this->oaid . '&data=' . $data . "&timestamp=" . strval($timestamp) . "&mac=" . $mac;

        $response = $this->makeGetRequest($this->base_url_get_list_followers, $myvars);

        return $response;
    }

    /**
     * @param $uid
     * @return mixed
     */
    public function getInforOneFollower($uid)
    {
        $timestamp     = round(microtime(true) * 1000);
        $hash_code_get = $this->oaid . $uid . strval($timestamp) . $this->secret_key;
        $mac           = hash('sha256', $hash_code_get);

        $myvars = 'oaid=' . $this->oaid . '&uid=' . $uid . "&timestamp=" . strval($timestamp) . "&mac=" . $mac;

        $response = $this->makeGetRequest($this->base_url_get_follower, $myvars);

        return $response;
    }

    /**
     * @param $message
     */
    public function notifyAllFollowers($message)
    {
        $list_followers = $this->getList50Followers();
        $followers      = $list_followers['data']['followers'];

        foreach ($followers as $follower) {
            $infor_follower = $this->getInforOneFollower($follower["uid"]);
            $userId         = $infor_follower["data"]["userId"];
            $response       = $this->notifyOneFollower($userId, $message);
        }

    }

    /**
     * @param $userId
     * @param $message
     * @return mixed
     */
    public function notifyOneFollower(
        $userId,
        $message
    ) {
        $timestamp      = round(microtime(true) * 1000);
        $data_mess      = '{"uid":' . strval($userId) . ',"message":"' . strval($message) . '"}';
        $hash_code_post = $this->oaid . strval($data_mess) . strval($timestamp) . $this->secret_key;
        $mac            = hash('sha256', $hash_code_post);

        $myvars = 'oaid=' . $this->oaid . '&data=' . strval($data_mess) . '&timestamp=' . strval($timestamp) . "&mac=" . $mac;
        Log::debug($this->base_url_send_message . '?' . $myvars);
        $response = $this->makePostRequest($this->base_url_send_message, $myvars);

        return $response;
    }

    /**
     * @param
     *      phone_number (uid)
     *      message
     * return message from zalo
     */
    public function notifyOneFollowerByPhone($param)
    {
Log::info('notifyOneFollowerByPhone');
        $phone_number = $param["uid"];
        $message      = $param["message"];

        $infor_follower = $this->getInforOneFollower($phone_number);

Log::info($infor_follower);
        if (1 != $infor_follower["errorCode"]) {
            return $infor_follower;
        }

        $userId = $infor_follower["data"]["userId"];

        $response = $this->notifyOneFollower($userId, $message);
        Log::info($response);

        return $response;
    }

    public function callGet($uri, $data) {
        $param = [
            "access_token" => $this->access_token,
            "data" => json_encode($data)
        ];

        $query = http_build_query($param);
        $url = self::BASE_V2_API . $uri . "?" . $query;
        Log::info('URL: ' . $url);

        try {
            $res = $this->client->get($url);
            $body = (string)$res->getBody();
            return json_decode($body);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e);
            return null;
        }
    }

    public function callPost($uri, $data) {
        // $param = [
        //     "access_token" => $this->access_token,
        //     "data" => json_encode($data)
        // ];

        // $query = http_build_query($param);
        // Log::info('getFollowers: '. $query);
        // Log::info('getFollowers encode: '. urlencode($query));

        // $url = self::BASE_V2_API . "?" . urlencode($query);
        // Log::info('URL: ' . $url);

        // try {
        //     $res = $this->client->request('POST', $url, [
        //         'body' => json_encode($data),
        //     ]);
        // } catch (\Exception $e) {
        //     Log::debug($e->getMessage());

        //     return;
        // }
    }

    public function getFollowers($offset, $limit) {
        $data = [
            "offset" => $offset,
            "count" => $limit
        ];
        
        $followers = $this->callGet('/oa/getfollowers', $data);
        Log::info(print_r($followers, true));
        return $followers;
    }

    public function getAllFollowers() {
        
        
        $result = [];

        // $offset = 0;
        // $limit = 20;
        // while(true) {
        //     $data = [
        //         "offset" => $offset,
        //         "count" => $limit
        //     ];
        //     $followers = $this->callGet('/oa/getfollowers', $data)->data;
        //     Log::info(print_r($followers, true));
        //     if (count($followers->followers) > 0 ) {
        //         $result = array_merge($result, $followers->followers);
        //     }

        //     if(count($result) >= $followers->total) 
        //         break;

        //     $offset += $limit;
        // }

        $temp = '[{"user_id":"6557561811887857751"},{"user_id":"8773019788659475350"},{"user_id":"3578901045546017276"},{"user_id":"8041618646168767695"},{"user_id":"2074296815581409183"},{"user_id":"9122466782860680655"},{"user_id":"625707034380688632"},{"user_id":"2220383828903867526"},{"user_id":"1321506561854881280"},{"user_id":"5457156177188293357"},{"user_id":"4293977890567378625"},{"user_id":"2676361566725110642"},{"user_id":"2857774280107849214"},{"user_id":"8541088794101875934"},{"user_id":"8457488988308983817"},{"user_id":"211527172267186105"},{"user_id":"8492110780420937100"},{"user_id":"6754450635008187370"},{"user_id":"3094771239953638052"},{"user_id":"6700688804513340331"},{"user_id":"2471031811595309596"},{"user_id":"4212772591432709664"},{"user_id":"6311279602159270848"},{"user_id":"5734546063528829123"},{"user_id":"7074484567615747451"},{"user_id":"501441346095810979"},{"user_id":"5292069977813697063"},{"user_id":"8376844970339683862"},{"user_id":"2742791688081722438"},{"user_id":"2360822952317622677"},{"user_id":"2843975793953352225"},{"user_id":"840194399824927230"},{"user_id":"6704644719740529757"},{"user_id":"846386819533590504"},{"user_id":"7843475370006695823"},{"user_id":"495102683658068616"},{"user_id":"7062648889118169941"},{"user_id":"5591146627306299585"},{"user_id":"1943279037311948705"},{"user_id":"7261095579017108114"},{"user_id":"3194142091915756805"},{"user_id":"5781675573814302314"},{"user_id":"6254837745819476379"},{"user_id":"9176801420828565260"},{"user_id":"1737240669227022669"},{"user_id":"8462129654211960889"},{"user_id":"8681262707642628140"},{"user_id":"4291025924769074650"},{"user_id":"1065941620526694044"},{"user_id":"359011016233715117"},{"user_id":"1426622499681412506"},{"user_id":"5290105599584786748"},{"user_id":"319182182357472059"},{"user_id":"8672396303020349452"},{"user_id":"66695164519454394"},{"user_id":"3160499025880485258"},{"user_id":"20955120860606492"},{"user_id":"6616114416545919111"},{"user_id":"1450833432759192692"},{"user_id":"5500932839686496513"},{"user_id":"2786417240738199549"},{"user_id":"4092727078541659802"},{"user_id":"5195387702720605007"},{"user_id":"1710213400023815917"},{"user_id":"3936928773396655860"},{"user_id":"2416550912828789471"},{"user_id":"6190518990460634815"},{"user_id":"5389466362061290397"},{"user_id":"1485172933250151114"},{"user_id":"7195225330592727948"},{"user_id":"6801893728660308275"},{"user_id":"231921699845656161"},{"user_id":"3338396629094105090"},{"user_id":"3224116021497391336"},{"user_id":"6641873160905689722"},{"user_id":"2094451512802641"},{"user_id":"6347024219069036355"},{"user_id":"7709909721687551913"},{"user_id":"7775636648978381246"},{"user_id":"1201308077712491005"},{"user_id":"7841219067791427463"},{"user_id":"5364558522376077860"},{"user_id":"214472799721882031"},{"user_id":"1172457421576613651"},{"user_id":"3906944876186596462"},{"user_id":"8980331109012743926"},{"user_id":"674553163693371146"},{"user_id":"7216617099849644144"},{"user_id":"6729973903471559219"},{"user_id":"3895262420939129432"},{"user_id":"1038352929879497790"},{"user_id":"5962102776965764587"},{"user_id":"4372373895700638715"},{"user_id":"1291099004888482236"},{"user_id":"3523017960696458930"},{"user_id":"6904346969489437831"},{"user_id":"212082519508978087"},{"user_id":"1707676174356078564"},{"user_id":"2469335453279984658"},{"user_id":"85696887408511846"},{"user_id":"6607394409627456484"},{"user_id":"7655028171537525866"},{"user_id":"5428033239794279682"},{"user_id":"5725407695096070434"},{"user_id":"6445968208051918626"},{"user_id":"8390347770092617254"},{"user_id":"2409801530559572519"},{"user_id":"5123323127743784015"},{"user_id":"2067548126794373095"},{"user_id":"5430566631021440011"},{"user_id":"71903763100337577"},{"user_id":"5237866002010866406"},{"user_id":"5245325510478035357"},{"user_id":"8107072793693391060"},{"user_id":"5197615621814752119"},{"user_id":"7582656763912136813"},{"user_id":"4534937564057643961"},{"user_id":"1634803377971282937"},{"user_id":"7457552551250780968"},{"user_id":"3655754252133561325"},{"user_id":"5190296515271865681"}]';
        $result = json_decode($temp);
        return $result;
    }
}
