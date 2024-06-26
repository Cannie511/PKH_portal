<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;


class TrnEsmsRecord extends Migration
{
    use BaseTableTrait;

    const TABLE_NAME = "trn_esms_record";
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('ref_id')->nullable();
            $table->text("param")->nullable();  
            $table->string('type', 8);
            $table->text("notes")->nullable();  
            $table->string('phone', 100)->nullable();
            $table->string('temp_id', 100)->nullable();
            $table->string('code_result', 255)->nullable();
            $table->string('SMSID', 255)->nullable();
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
