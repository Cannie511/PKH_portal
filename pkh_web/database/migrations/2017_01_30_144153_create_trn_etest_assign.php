<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

class CreateTrnEtestAssign extends Migration
{
    use BaseTableTrait;

    const TABLE_NAME = "trn_etest_assign";
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->bigInteger('etest_id');
            $table->integer('user_id');
            $table->date('from_date');
            $table->date('to_date');
            $table->integer('mark');
            $table->timestampTz('start_time')->nullable();
            $table->timestampTz('end_time')->nullable();
            
            $this->addRecordHeader($table);

            $table->primary(['etest_id', 'user_id'], self::TABLE_NAME . "_pk");
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
