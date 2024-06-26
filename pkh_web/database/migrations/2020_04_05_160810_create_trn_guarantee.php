<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

class CreateTrnGuarantee extends Migration
{
    use BaseTableTrait;

    const TABLE_NAME = "trn_guarantee";
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('product_id');
            $table->integer('area1');
            $table->integer('area2')->nullable();
          
            $table->string("name", 128);
            $table->string("email", 128)->nullable();
            $table->string("tel", 32)->nullable();
            $table->string("store", 1024)->nullable();
            $table->date("purchase_date");
            
            $table->string('ip', 32);
            $table->string("agent", 1024)->nullable();
            $this->addLocationInfo($table, "ip");

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
