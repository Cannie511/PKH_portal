<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

class CreateTrnStorePaymentStatus extends Migration
{
    use BaseTableTrait;

    const TABLE_NAME = "trn_store_payment_status";
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->bigInteger('store_id');
            $table->bigInteger('store_delivery_id');
            $table->date('delivery_date');
            $table->decimal('delivery_amount', 19, 2)->default(0);
            $table->decimal('remain_amount', 19, 2)->default(0);
            $table->date('payment_start')->nullable();
            $table->date('payment_end')->nullable();
            $table->date('payment_date')->nullable();
            $table->string('sts', 8)->default('0');
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
