<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

class CreateMstProductCat extends Migration
{
    use BaseTableTrait;

    const TABLE_NAME = "mst_product_cat";

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        echo(' - Cretate table ' . self::TABLE_NAME . PHP_EOL);
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->increments('product_cat_id');
            $table->integer('supplier_id');
            $table->string('product_cat_code', 16)->unique();
            $table->string('name', 255);
            $table->string('name_origin', 255)->nullable();
            $table->boolean('allow_order_flg')->default(1);
            $table->integer('priority');
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
