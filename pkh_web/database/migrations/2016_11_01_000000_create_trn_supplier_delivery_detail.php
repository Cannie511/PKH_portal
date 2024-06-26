<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

class CreateTrnSupplierDeliveryDetail extends Migration
{
    use BaseTableTrait;

    const TABLE_NAME = "trn_supplier_delivery_detail";
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        echo(' - Cretate table ' . self::TABLE_NAME . PHP_EOL);
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->bigInteger('supplier_delivery_id');
            $table->bigInteger('product_id');
            $table->integer('seq_no')->default(0);
            $table->integer('amount')->default(0);
            $table->decimal('price', 19, 2)->default(0);
            $table->decimal('price_vi', 19, 2)->default(0);
               // Phí hải quan 
            $table->decimal('duty_tax', 19, 2)->default(0);
            $table->primary(['supplier_delivery_id', 'product_id'], self::TABLE_NAME . "_pk");
            
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
