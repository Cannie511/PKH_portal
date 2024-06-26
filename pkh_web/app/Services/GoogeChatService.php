<?php

namespace App\Services;

use Log;
use GuzzleHttp\Client;
use Illuminate\Support\Str;

/**
 * GoogeChatService class
 */
class GoogeChatService extends BaseService
{
    public function __construct()
    {
        $this->client = new Client([
            'headers' => ['Content-Type' => 'application/json'],
        ]);
    }

    /**
     * @param $channel
     * @param $data
     * @return null
     */
    public function sendMessage(
        $channel,
        $data
    ) {

        if (empty($channel)) {
            return;
        }

        try {
            $res = $this->client->request('POST', $channel, [
                'body' => json_encode($data),
            ]);
        } catch (\Exception $e) {
            Log::debug($e->getMessage());

            return;
        }

    }

    /**
     * @param $message
     * @param $context
     * @return null
     */
    public function sendError(
        $message,
        $context
    ) {
        $webhookUrl = env('CHAT_LOG_CHANEL', '');

        if (empty($webhookUrl)) {
            return;
        }

        $data = [
            "text" => Str::limit("Hello <users/all>! ERROR: " . $message . " - " . print_r($context, true), 2048),
        ];

        $this->sendMessage($webhookUrl, $data);
    }

    /**
     * @param $message
     * @return null
     */
    public function sendBatchLog($message)
    {
        $webhookUrl = env('BATCH_LOG_CHANEL', '');

        if (empty($webhookUrl)) {
            return;
        }

        $data = [
            "text" => Str::limit($message, 2048),
        ];

        $this->sendMessage($webhookUrl, $data);
    }

// $this->googleChat->sendLoginLog($item->user_id, $item->ip, $item->event_name, $item->agent);
    /**
     * @param $user
     * @param $ip
     * @param $eventName
     * @param $agent
     * @param $email
     * @param $lat
     * @param $long
     * @return null
     */
    public function sendLoginLog(
        $user,
        $ip,
        $eventName,
        $agent,
        $email,
        $lat,
        $long
    ) {
        $webhookUrl = env('LOGIN_CHANEL', '');

        if (empty($webhookUrl)) {
            return;
        }

        $message = "$user - $ip - $eventName - $agent - $email - $lat - $long";

// $data = [

//     "text" => Str::limit($message, 2048)
        // ];
        $card1 = [
            "header"   => [
                "title" => $eventName,
            ],
            "sections" => [
                [
                    "widgets" => [
                        [
                            "keyValue" => [
                                "topLabel" => "Email",
                                "content"  => $email,
                            ],
                        ],
                        [
                            "keyValue" => [
                                "topLabel" => "IP",
                                "content"  => $ip,
                            ],
                        ],
                        [
                            "keyValue" => [
                                "topLabel" => "Agent",
                                "content"  => $agent,
                            ],
                        ],
                    ],
                ],
            ],
        ];

// $card2 = [

//     "header" => [

//         "title" => "Location"

//     ],

//     "widgets" => [

//         [

//             "image" => [

//                 "imageUrl" => "https://www.google.com/maps/@10.7398581,106.6565632,15z"

//             ]

//         ]

//     ]
        // ];

        $cards = [$card1];

        $data = [
            "cards" => $cards,
        ];

        $this->sendMessage($webhookUrl, $data);
    }

}
