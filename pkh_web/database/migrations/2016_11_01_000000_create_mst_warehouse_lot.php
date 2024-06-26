<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

class CreateMstWarehouseLot extends Migration
{
    use BaseTableTrait;

    const TABLE_NAME = "mst_warehouse_lot";

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        echo(' - Cretate table ' . self::TABLE_NAME . PHP_EOL);
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->increments('warehouse_lot_id');
            $table->string('name', 255);
            $table->integer('length');
            $table->integer('width');
            $table->integer('height');
            $table->integer('max_item');
            $table->text('description');

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
