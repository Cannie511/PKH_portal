<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

class TrnEmployeeContract extends Migration
{
    use BaseTableTrait;

    const TABLE_NAME = "trn_employee_contract";
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('employee_id');
            $table->string('contract_no', 32);
            $table->string('title', 256);
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('salary', 19, 2)->default(0);
            $table->decimal('basic_salary', 19, 2)->default(0);
            // contract_type: 
            // + PARTTIME
            // + FULLTIME
            // + PROBATION
            $table->string('contract_type', "32");
            $table->text('notes')->nullable();

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
