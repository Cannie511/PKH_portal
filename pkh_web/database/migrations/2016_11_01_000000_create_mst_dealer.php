<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

class CreateMstDealer extends Migration
{
    use BaseTableTrait;

    const TABLE_NAME = "mst_dealer";
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        echo(' - Cretate table ' . self::TABLE_NAME . PHP_EOL);
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->bigIncrements('dealer_id');
            $table->string('name', 255);
            $table->string('address', 512)->nullable();
            $table->integer('area1');
            $table->integer('area2');

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
