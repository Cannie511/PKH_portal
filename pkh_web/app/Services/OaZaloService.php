<?php namespace App\Services;

use Log;
use Exception;
use Zalo\Zalo;
use Zalo\ZaloEndpoint;
use Zalo\Builder\MessageBuilder;
use Zalo\FileUpload\ZaloFile;

use App\Models\TrnOaFollowerMessage;
use DB;

class OaZaloService
{
    const ZALO_ACCESS_TOKEN="LQOu0nYZ01nKepC75AK26bMlCWCJisLZ5yq4UnkASWW-xK1N1BrvA4RbErHbiruwOD8jU7sbTJrOfY9bGF90EmFmTrCzi30I9Sa1022NNcukpomI4Pfr2ZV237aecdi95kmsPJ3lUWvtcZ9WOVvUFt2_EKLKm4WZOQ4jUNRrTI93ioDzHFjhBrUiFb1Dp5L2Lx8nBNVEHKmwfIidFlrzMdkYH0X4toWQMx9QVK74CJO7nK9f59fs8XZTGN4ghXuiPkLKKtkxEorQns5t7geIQpltPW0Ll2jZCzXfA1Uk9LHGycbET380AXAw2nu";
    const ZALO_APP_ID = "3797858231441758032" ;
    const ZALO_APP_SECRET = "6JAHIMv9SK2wiQDd3BYN";

    public function __construct() {
        // $this->app_id = ZALO_APP_ID; //env("ZALO_APP_ID", "");
        // $this->access_token = ZALO_ACCESS_TOKEN; //env("ZALO_ACCESS_TOKEN", "");
        // $this->app_secret = ZALO_APP_SECRET ; //env("ZALO_APP_SECRET", "");
        $this->callback_url = env("ZALO_CALLBACK_URL", "");
        $this->test_user_id = "6311279602159270848";
        // $this->pkceService  = $pkceService;
        // Log::debug($this->access_token);
        $config = array(
            'app_id' => self::ZALO_APP_ID,
            'app_secret' => self::ZALO_APP_SECRET,
            'callback_url' => $this->callback_url
        );

        $this->zalo = new Zalo($config);
    }

    // Get maximum 50 followers at one time
    /**
     * @return mixed
     */
    public function getListFollowers($offset ,$count)
    {
        if ($count>50 || $count<=0){
            $count = 50;
        }
        $data = ['data' => json_encode(array(
            'offset' => $offset,
            'count' => $count
        ))];
        $response = $this->zalo->get(ZaloEndPoint::API_OA_GET_LIST_FOLLOWER, self::ZALO_ACCESS_TOKEN, $data);
        $result = $response->getDecodedBody(); // result

        return $result;
    }


    // Get maximum 50 followers at one time
    /**
     * @return mixed
     */
    public function getFullListFollowers()
    {
        $follower_list = array();
        $offset  = 0;
        $count = 50 ;
        while ($count == 50){
            $res = $this->getListFollowers($offset, $count);
            $count = count($res["data"]["followers"]);
            $offset += $count;
            // Log::debug(" follower");
            // Log::debug($res);
            $follower_list = array_merge($follower_list,$res["data"]["followers"] );
        }

        return $follower_list;
    }

    // Get detail infor of user
    /**
     * @return mixed
     */
    public function getDetailFollower($user_id)
    {
        $data = ['data' => json_encode(array(
            'user_id' => $user_id
        ))];
        try {
            $response = $this->zalo->get(ZaloEndpoint::API_OA_GET_USER_PROFILE, self::ZALO_ACCESS_TOKEN, $data);
            $result = $response->getDecodedBody(); // result
        }
        catch (Exception $e) {
            //Xử lý ngoại lệ ở đây
            $result = array('error' => 1);
        }
      
        // Log::debug($result );
        return $result;
    }

    // Get detail infor of user
    /**
     * @return mixed
     */
    public function getDetailFollowers()
    {
        $follower_list = $this->getFullListFollowers();
        $detail_follower_list = array();
        foreach ($follower_list as $follower) {
            Log::debug($follower );
            $item = $this->getDetailFollower($follower["user_id"]); 
            
            array_push($detail_follower_list, $item);
        }
        // Log::debug("user detail ");
        // Log::debug($detail_follower_list );
        return $detail_follower_list ;
    }

    // Send list to a follower 
    /**
     * @return mixed
     */
    public function broadcastText2Follower($data)
    {
    
        $data_json = json_decode($data,true);

        if ($data_json["test_id"] != "" ){
            $result = $this->sendText2Follower($data_json , $data_json["test_id"]);
        } else {
            $follower_list = $this->getFullListFollowers();
            $total = count($follower_list);
            $total_sent = 0;

            foreach ($follower_list as $follower) {
                $result = $this->sendText2Follower($data_json , $follower["user_id"]);
                if ($result["error"] == 0 ){
                    $total_sent +=1;
                }
            }
            $entity                     = new TrnOaFollowerMessage();
            $entity->content            = $data;
            $entity->total              = $total;
            $entity->total_sent         = $total_sent;
            DB::transaction(function () use ($entity) {
                $entity->save();
            });
            return $total_sent;
        }
        
        return 1;
       
    }

    // Send list to a follower 
    /**
     * @return mixed
     */
    public function sendText2Follower($data, $user_id)
    {
        // build data
        $msgBuilder = new MessageBuilder('list');
        $msgBuilder->withUserId($user_id);
        $msgBuilder->withText('Cảm ơn quý khách đã tin tưởng và sử dụng dịch vụ của chúng tôi');
        
        foreach ($data["actions"] as $action){
            if ($action["type"] == "buildActionOpenURL") {
                $button = $msgBuilder->buildActionOpenURL($action["link"]);
                $msgBuilder->withElement($action["header"], $action["image"], $action["body"], $button);
            } else if ($action["type"] == "buildActionQueryShow") {
                $button = $msgBuilder->buildActionQueryShow($action["link"]);
                $msgBuilder->withElement($action["header"], $action["image"], $action["body"], $button);
            } else if ($action["type"] == "buildActionOpenPhone") {
                $button = $msgBuilder->buildActionOpenPhone($action["link"]);
                $msgBuilder->withElement($action["header"], $action["image"], $action["body"], $button);
            }
        }
        
        $msgList = $msgBuilder->build();
        $response = $this->zalo->post(ZaloEndpoint::API_OA_SEND_MESSAGE, self::ZALO_ACCESS_TOKEN, $msgList);
        $result = $response->getDecodedBody(); // result

        return   $result;
    }

   

    public function uploadImgZalo($filePath)
    {
        $data = array('file' => new ZaloFile($filePath));
        $response = $this->zalo->post(ZaloEndpoint::API_OA_UPLOAD_PHOTO, self::ZALO_ACCESS_TOKEN, $data);
        $result = $response->getDecodedBody(); // result
        // Log::debug("Upload image");
        // Log::debug($result );
        return $result;
    }


}