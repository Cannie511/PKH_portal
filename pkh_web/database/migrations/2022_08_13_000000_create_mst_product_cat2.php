<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

class CreateMstProductCat2 extends Migration
{
    use BaseTableTrait;

    const TABLE_NAME = "mst_product_cat2";

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        echo(' - Cretate table ' . self::TABLE_NAME . PHP_EOL);

        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            
            $table->increments('product_cat2_id');
            $table->integer('product_cat1_id');
            $table->string('name', 255);
            $table->integer('supplier_id');
            $table->string('notes', 255);
           
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
