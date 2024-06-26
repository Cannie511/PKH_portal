<?php

namespace App\Listeners;

use Log;
use App\Events\AccessEvent;
use App\Models\TrnAuditLog;
use App\Services\IpService;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Services\GoogeChatService;

class AccessEventListener implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * @var mixed
     */
    private $ipService;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(IpService $ipService, GoogeChatService $googleChatService)
    {
        $this->ipService = $ipService;
        $this->googleChat = $googleChatService;
    }

    /**
     * Handle the event.
     *
     * @param  AccessEvent  $event
     * @return void
     */
    public function handle(AccessEvent $event)
    {
        $item             = new TrnAuditLog();
        $item->user_id    = $event->userId;
        $item->ip         = $event->ip;
        $item->event_name = $event->eventName;
        $item->agent      = $event->agent;
        $item->notes      = $event->notes;
        $item->created_by = $event->userId;
        $item->updated_by = $event->userId;

        try {
            $ipInfo = $this->ipService->getIpInfo($event->ip);
            //$ipInfo = $this->ipService->getIpInfo('162.158.178.49');
            $this->ipService->setIpInfoToObject($item, $ipInfo);
        } catch (\Throwable $e) {
            Log::warning($e);
        }

        $this->googleChat->sendLoginLog($item->user_id, $item->ip, $item->event_name, $item->agent, $event->email, $item->ip_lat, $item->ip_long);

        $item->save();
    }
}
