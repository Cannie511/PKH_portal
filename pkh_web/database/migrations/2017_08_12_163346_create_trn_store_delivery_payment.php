<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

class CreateTrnStoreDeliveryPayment extends Migration
{
    use BaseTableTrait;

    const TABLE_NAME = "trn_store_delivery_payment";

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->bigIncrements('trn_store_delivery');
            $table->date('delivery_date');
            $table->decimal('total',19,2)->default(0);
            $table->decimal('total_with_discount',19,2)->default(0);
            // 1: Not yet
            // 2: finish
            $table->integer('payment_sts')->default(1);
            $table->decimal('payment_amount',19,2)->default(0);
            $table->date('payment_finish_date')->nullable();
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
