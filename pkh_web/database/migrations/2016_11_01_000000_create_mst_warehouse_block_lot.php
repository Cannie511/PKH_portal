<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

class CreateMstWarehouseBlockLot extends Migration
{
    use BaseTableTrait;

    const TABLE_NAME = "mst_warehouse_block_lot";
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        echo(' - Cretate table ' . self::TABLE_NAME . PHP_EOL);
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->integer('warehouse_block_id');
            $table->integer('warehouse_lot_id');

            $table->primary(['warehouse_block_id', 'warehouse_lot_id'], self::TABLE_NAME . "_pk");

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
