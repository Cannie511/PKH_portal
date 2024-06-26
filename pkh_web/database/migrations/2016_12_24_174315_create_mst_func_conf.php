<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

class CreateMstFuncConf extends Migration
{
    use BaseTableTrait;

    const TABLE_NAME = "mst_func_conf";
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->string('func_key');
            $table->string('chr_val')->nullable();
            $table->date('dat_val')->nullable();
            $table->dateTime('dtm_val')->nullable();
            $table->time('tim_val')->nullable();
            $table->integer('int_val')->nullable();
            $table->text('txt_val')->nullable();
            
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
