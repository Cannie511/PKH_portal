<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

class TrnAttendance extends Migration
{
    use BaseTableTrait;

    const TABLE_NAME = "trn_attendance";
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->dateTime('working_time');
            $table->integer('user_id');
            $table->string('ip', 32);
            $table->string("agent", 1024)->nullable();
            $table->string('event_name', 256);
            $table->text("notes")->nullable();
            
            $this->addLocationInfo($table, "ip");
            $this->addGPS($table);

            $this->addRecordHeader($table);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(self::TABLE_NAME);
    }
}
