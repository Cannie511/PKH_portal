<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

class CreateMstStore extends Migration
{
    use BaseTableTrait;

    const TABLE_NAME = "mst_store";
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        echo(' - Cretate table ' . self::TABLE_NAME . PHP_EOL);
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->bigIncrements('store_id');
            $table->string('name', 255);
            $table->string('address', 512)->nullable();
            $table->decimal('discount', 5, 2)->default(0);
            $table->integer('level')->nullable();
            $table->integer('area1')->nullable();
            $table->integer('area2')->nullable();
            $table->double('gps_lat')->default(0);
            $table->double('gps_long')->default(0);
            $table->string('img_path', 255);
            $table->bigInteger('new_store_id');
            $table->bigInteger('dealer_id');
            $table->string('store_sts', 16);
            $table->string('tax_code', 16)->nullable();
            $table->text("notes")->nullable();
            // $table->text("address_chanh")->nullable();
            // $table->double('gps_lat_chanh')->default(0);
            // $table->double('gps_long_chanh')->default(0);
            $table->bigInteger('chanh_id')->nullable();
            
            $this->addContactInfo($table, "contact");
            $this->addBankInfo($table, "bank");
            $table->integer('salesman_id')->nullable();
            $table->boolean('inner_flg')->default(0);  
            $table->date('first_order')->nullable();
            $table->string('accountant_store_id', 32)->nullable();
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
