<?php

namespace App\Models;

use DB;
use Schema;
use Illuminate\Database\Schema\Blueprint;

trait BaseTableTrait {
	
	/**
     * Add record header field to table
     */
    public function addRecordHeader(Blueprint $table) {
        
        $table->boolean('active_flg')->default(1);  
        $table->timestampTz('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        $table->integer('created_by');
        $table->timestampTz('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP')); 
        $table->integer('updated_by');
        $table->integer('version_no')->default(0);
    }

    /**
     * Add contact info
     * @param Blueprint     $table  [description]
     * @param String|string $prefix [description]
     */
    public function addContactInfo(Blueprint $table, $prefix) {
        
        $table->string($prefix . '_name', 255)->nullable();
        $table->string($prefix . '_email', 255)->nullable();
        $table->string($prefix . '_tel', 64)->nullable();
        $table->string($prefix . '_fax', 64)->nullable();
        $table->string($prefix . '_mobile1', 64)->nullable();
        $table->string($prefix . '_mobile2', 64)->nullable();
    }

    /**
     * Add bank account
     * @param Blueprint     $table  [description]
     * @param String|string $prefix [description]
     */
    public function addBankInfo(Blueprint $table, $prefix) {
        $table->string($prefix . '_name', 255)->nullable();
        $table->string($prefix . '_branch', 255)->nullable();
        $table->string($prefix . '_account_no', 255)->nullable();
        $table->string($prefix . '_account_name', 255)->nullable();
    }

    /**
     * Add IP to location information
     *
     * @param Blueprint $table
     * @param [type] $prefix
     * @return void
     */
    public function addLocationInfo(Blueprint $table, $prefix) {
        $table->string($prefix . '_as', 255)->nullable();
        $table->string($prefix . '_city', 255)->nullable();
        $table->string($prefix . '_country', 255)->nullable();
        $table->string($prefix . '_country_code', 255)->nullable();
        $table->string($prefix . '_isp', 255)->nullable();
        $table->decimal($prefix . '_lat', 10, 8)->nullable();
        $table->decimal($prefix . '_lon', 11, 8)->nullable();
        $table->string($prefix . '_org', 255)->nullable();
        $table->string($prefix . '_region', 255)->nullable();
        $table->string($prefix . '_region_name', 255)->nullable();
        $table->string($prefix . '_timezone', 255)->nullable();
        $table->string($prefix . '_zip', 255)->nullable();
    }

    /**
     * Add GPS location
     *
     * @param Blueprint $table
     * @return void
     */
    public function addGPS(Blueprint $table) {
        $table->double('gps_lat')->default(0);
        $table->double('gps_long')->default(0);
    }

    public function dropColumnIfExists($tableName, $column)
    {
        // if (Schema::hasColumn($tableName, $column)) //check the column
        // {
        //     Schema::table($tableName, function (Blueprint $table) use ($column)
        //     {
        //         try {
        //             $table->dropColumn($column); //drop it
        //         } catch (Exception $e) {
        //             echo $column . ": " . $e->getMessage();
        //         }
        //     });
        // }

        Schema::table($tableName, function (Blueprint $table) use ($column)
        {
            try {
                $table->dropColumn($column); //drop it
            } catch (Exception $e) {
                echo $column . ": " . $e->getMessage();
            }
        });
    }
}