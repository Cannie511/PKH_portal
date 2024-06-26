<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

class CreateTrnStoreDelivery extends Migration
{
    use BaseTableTrait;

    const TABLE_NAME = "trn_store_delivery";
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        echo(' - Cretate table ' . self::TABLE_NAME . PHP_EOL);
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->bigIncrements('store_delivery_id');
            $table->bigInteger('store_order_id');
            $table->bigInteger('store_id');
            $table->bigInteger('warehouse_id');

            $table->date('delivery_date');
            $table->decimal('discount_1', 5, 2)->default(0);
            $table->decimal('discount_2', 5, 2)->default(0);
            $table->decimal('total',19,2);
            $table->decimal('total_with_discount',19,2)->default(0);
            $table->decimal('volume',8,2)->default(0);
            $table->decimal('carton',8,2)->default(0);
            $table->integer('seq_no')->default(0);
            $table->integer('delivery_seq_no')->default(0);
            
            // 0: draft
            // 1: dang giao hang
            // 4: Finish
            // 5: cancel
            $table->string('delivery_sts', 8);

            $table->text("notes")->nullable();
            $table->text("notes_cancel")->nullable();
            $table->dateTime('cancel_time')->nullable();
            $table->integer('salesman_id')->nullable();

            $table->bigInteger('promotion_id')->nullable();
            // $table->tinyInteger('warranty_type')->default(0); // 0 : deactive, 1: active
            // $table->tinyInteger('sample_type')->default(0);// 0 : deactive, 1: free, 2: charge 
            // $table->decimal('delivery_time', 5, 2)->default(0);
            $table->bigInteger('branch_id')->default(1);
            $table->bigInteger('supplier_id')->default(1);
            $table->bigInteger('shipping_id')->nullable();
            $table->integer('order_type')->default(0);
            $table->dateTime('packing_time')->nullable();
            $table->dateTime('confirm_time')->nullable();
            $table->dateTime('delivery_time')->nullable();
            $table->dateTime('shipping_time')->nullable();
            $table->dateTime('receive_time')->nullable();
            $table->dateTime('finish_time')->nullable();
            $table->integer('packing_by')->nullable();
            $table->integer('confirm_by')->nullable();
            $table->integer('delivery_by')->nullable();
            $table->integer('shipping_by')->nullable();
            $table->integer('receive_by')->nullable();
            $table->integer('finish_by')->nullable();
            $table->string('store_delivery_code', 32);
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
