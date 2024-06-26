<?php

namespace App\Providers;

use DB;
use Log;
use Event;
use Monolog\Logger;
use Monolog\Handler\RotatingFileHandler;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Libs\MonologEx\Handler\GoogleChatHandler;
// use App\Services\GoogeChatService;
// use GuzzleHttp\Client;

class EventServiceProvider extends ServiceProvider
{
    /**
     * @var mixed
     */
    private $errorLog;

    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        "App\Events\AccessEvent" => [
            "App\Listeners\AccessEventListener",
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);
        Log::debug('EventServiceProvider');
        $this->configLogFile();
        $this->configLogSql();
    }

    private function configLogFile()
    {
        $this->errorLog = new Logger('PKH');
        // Add rolling file handler
        $this->errorLog->pushHandler(new RotatingFileHandler(storage_path() . '/logs/app_error.log', 0, Logger::ERROR));

        // Add google chat handler;
        $gcWebhookUrl = env('CHAT_LOG_CHANEL', '');
        if(!empty($gcWebhookUrl)) {
            $this->errorLog->pushHandler(new GoogleChatHandler([
                'uri'             => $gcWebhookUrl,
    	        'method'          => 'POST',
            ], Logger::ERROR));
        }

        $errorLog = $this->errorLog;

        Log::listen(function (
            $level,
            $message,
            $context
        ) use ($errorLog) {
            if ('error' == $level) {
                $errorLog->error($message, $context);
            }
        });
    }

    private function configLogSql()
    {

        if (env('APP_DEBUG') == true) {
            DB::enableQueryLog();

            DB::listen(function ($event) {
                Log::debug('DB::listen ' . get_class($event));

                $query    = $event->sql;
                $bindings = $event->bindings;

                foreach ($bindings as $i => $binding) {
                    if ($binding instanceof \DateTime) {
                        $bindings[$i] = $binding->format('\'Y-m-d H:i:s\'');
                    } elseif (is_string($binding)) {
                        $bindings[$i] = "'$binding'";
                    }

                }

                // Insert bindings into query
                $rawQuery = str_replace(array('%', '?'), array('%%', '%s'), $query);
                $rawQuery = vsprintf($rawQuery, $bindings);

                Log::debug('illuminate.query - START ------ ');
                Log::debug('- sql: ' . $query);
                Log::debug('- bindings: ' . print_r($bindings, true));
                Log::debug('- times: ' . $event->time);
                Log::debug('- conn: ' . $event->connection->getName());
                Log::debug('- raw: ' . $rawQuery);

                Log::debug('illuminate.query - END ------ ');
            });
        }
    }
}
