<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

class CreateTrnLeaveAllocation extends Migration
{
    use BaseTableTrait;

    const TABLE_NAME = "trn_leave_allocation";
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('employee_id');
            $table->decimal('num_days', 5 , 2);
            $table->string('reason', 256);
            $table->date('expired_date');
            $table->text("notes")->nullable();

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
