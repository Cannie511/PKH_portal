<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

class CreateTrnPaymentAdvance extends Migration
{
    use BaseTableTrait;

    const TABLE_NAME = "trn_payment_advance";
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->bigIncrements('payment_id');
            $table->integer('salesman_id');
            $table->bigInteger('store_id');
            $table->date('payment_date');
            // PaymentType:
            //      1: chuyển khoản
            //      2: Tiền mặt
            //      3: Điều chỉnh tăng: (cửa hành thanh toán thêm ảo để giảm công nợ)
            //      4: Điều chỉnh giảm: (giảm bớt thanh toán cửa hàng để tăng thêm công nợ)
            $table->integer('payment_type')->default(1);
            $table->string('payment_sts', 8);
            $table->decimal('payment_money',19,2)->default(0);
            
            $table->integer('bank_account_id')->nullable();
            
            $table->text('notes')->nullable();
            $table->decimal('discount',5,2)->default(0);

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
