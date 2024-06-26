<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

class CreateTrnWorkingHours extends Migration
{
    use BaseTableTrait;

    const TABLE_NAME = "trn_working_hours";

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        echo(' - Cretate table ' . self::TABLE_NAME . PHP_EOL);
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->date('working_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->time('first_time');
            $table->time('last_time');
            $table->integer('working_hours');
            $table->integer('absent_type')->default(0);
            $table->boolean('is_holiday')->default(0);
            $table->integer('holiday_hours')->default(0);
            
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
