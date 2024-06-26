<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

class CreateTrnSupplierOrderDetail extends Migration
{
    use BaseTableTrait;

    const TABLE_NAME = "trn_supplier_order_detail";
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        echo(' - Update table ' . self::TABLE_NAME . PHP_EOL);
        Schema::table(self::TABLE_NAME, function (Blueprint $table) {
           
            $table->dropColumn('seq_no');
            $table->dropColumn('price');
            $table->dropColumn('price_vi');
            $table->dropColumn('rate');

            $table->decimal('unit_price', 19,2);
            $table->integer('pakaging');
            $table->string('describes',255)->nullable();
            $table->string('pakaging_type',32)->nullable();
            
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
