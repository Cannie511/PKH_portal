<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

class MstEmployeeInfo extends Migration
{
    use BaseTableTrait;

    const TABLE_NAME = "mst_employee_info";
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->integer('employee_id');
            
            $table->string("employee_code", 16)->nullable();
            $table->string("fullname", 128)->nullable();
            $table->string("title", 128)->nullable();
            $table->string("devision", 128)->nullable();
            $table->date("dob");
            $table->string("address_permernance", 512)->nullable();;
            $table->string("address_contact", 512)->nullable();;
            $table->string("card_id", 32)->nullable();;
            $table->date("card_id_issue_on")->nullable();;
            $table->string("card_id_issue_at", 64)->nullable();;
            $table->string("tax_number", 32)->nullable();;
            $table->string("social_number", 32)->nullable();;

            $table->string("home_phone", 32)->nullable();
            $table->string("tel1", 32)->nullable();
            $table->string("tel2", 32)->nullable();
            
            $table->string("nationality", 32)->nullable();
            $table->string("marital_sts", 32)->nullable();
            $table->string("gender", 8)->nullable();

            $table->date("probation_start_date")->nullable();
            $table->date("probation_end_date")->nullable();
            $table->date("start_date")->nullable();
            $table->date("end_date")->nullable();
            $table->integer("count_dependent_person")->default(0);
            $table->text("notes")->nullable();
            $table->string("passcode", 16)->nullable();

            $table->primary(['employee_id'], self::TABLE_NAME . "_pk");

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
