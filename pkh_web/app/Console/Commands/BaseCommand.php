<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Models\TrnBatchLog;

class BaseCommand extends Command
{
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get param as string of date
     *
     * @param [type] $paramName
     * @param [type] $defaulValue
     * @param [type] $format
     * @return void
     */
    protected function getDateOptionAsString(
        $paramName,
        $defaulValue,
        $format
    ) {
        $result = $defaulValue;

        if ($this->hasOption($paramName)) {
            $pDate = $this->option($paramName);

            if (isset($pDate) && !empty($pDate)) {
                $temp   = Carbon::parse($pDate);
                $result = $temp->format($format);
            }

        }

        return $result;
    }

    /**
     * Get param as array
     *
     * @param [type] $paramName
     * @param [type] $defaulValue
     * @param [type] $format
     * @return void
     */
    protected function getArrayOption(
        $paramName,
        $defaulValue
    ) {

        if (isset($defaulValue)) {
            $result = $defaulValue;
        } else {
            $result = [];
        }

        if ($this->hasOption($paramName)) {
            $temp = $this->option($paramName);

            if (isset($temp)) {
                $result = explode(',', $temp);
            }

        }

        return $result;
    }

    /**
     * Get param as int
     *
     * @param [type] $paramName
     * @param [type] $defaulValue
     * @return void
     */
    protected function getIntOption(
        $paramName,
        $defaulValue
    ) {
        $result = $defaulValue;

        if ($this->hasOption($paramName)) {
            $temp = $this->option($paramName);

            if (isset($temp) && !empty($temp)) {
                $result = intval($temp);
            }

        }

        return $result;
    }

    protected function writeLog($batchName, $event, $params, $notes) {
        $entity = new TrnBatchLog();

        $entity->batch_time = Carbon::now();
        $entity->name = $batchName;
        $entity->event_name = $event;
        $entity->params = print_r($params, true);
        $entity->notes = print_r($notes, true); 
        $entity->created_by = 0;
        $entity->updated_by = 0;

        $entity->save();
    }

    protected function writeStartLog() {
        $entity = new TrnBatchLog();

        $entity->batch_time = Carbon::now();
        $entity->name = $this->signature;
        $entity->event_name = 'STARTED';
        $entity->params = json_encode ([
            "arguments" => $this->argument(),
            "options" => $this->option(),
        ]);
        // $entity->notes = print_r($notes, true); 
        $entity->created_by = 0;
        $entity->updated_by = 0;

        $entity->save();
    }

    protected function writeEndLog($notes = null) {
        $entity = new TrnBatchLog();

        $entity->batch_time = Carbon::now();
        $entity->name = $this->signature;
        $entity->event_name = 'FINISHED';
        $entity->params = json_encode ([
            "arguments" => $this->argument(),
            "options" => $this->option(),
        ]);
        $entity->notes =$notes;
        $entity->created_by = 0;
        $entity->updated_by = 0;

        $entity->save();
    }

}
