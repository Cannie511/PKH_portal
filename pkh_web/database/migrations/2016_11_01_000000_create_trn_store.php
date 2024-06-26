<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

class CreateTrnStore extends Migration
{
    use BaseTableTrait;

    const TABLE_NAME = "trn_store";
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        echo(' - Cretate table ' . self::TABLE_NAME . PHP_EOL);
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->bigIncrements('new_store_id');
            $table->string('name', 255);
            $table->string('address', 512);
            $table->integer('area1');
            $table->integer('area2');
            $table->double('gps_lat');
            $table->double('gps_long');
            $table->string('img_path', 255);
            $table->integer('store_id');

            $this->addContactInfo($table, "contact");
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
