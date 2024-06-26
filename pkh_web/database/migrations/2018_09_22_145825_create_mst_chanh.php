<?php


use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

class CreateMstChanh extends Migration
{
    use BaseTableTrait;

    const TABLE_NAME = "mst_chanh";

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->bigIncrements('chanh_id');

            $table->string('name', 255);
            $table->string('address', 512)->nullable();
            $table->integer('area1')->nullable();
            $table->integer('area2')->nullable();
            $table->double('gps_lat')->default(0);
            $table->double('gps_long')->default(0);
            $table->string('img_path', 255);
            // $table->bigInteger('new_store_id');
            $table->string('chanh_sts', 16);
            
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
