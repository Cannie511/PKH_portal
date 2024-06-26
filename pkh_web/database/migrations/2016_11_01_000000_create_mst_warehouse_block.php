<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

class CreateMstWarehouseBlock extends Migration
{
    use BaseTableTrait;

    const TABLE_NAME = "mst_warehouse_block";
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        echo(' - Cretate table ' . self::TABLE_NAME . PHP_EOL);
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->increments('warehouse_block_id');
            $table->integer('warehouse_id');
            $table->integer('parent_block_id')->nullable();
            $table->string('name', 255);
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
