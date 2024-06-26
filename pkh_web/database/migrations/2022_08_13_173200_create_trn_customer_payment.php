<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

class CreateTrnCustomerPayment extends Migration
{
    use BaseTableTrait;

    const TABLE_NAME = "trn_customer_payment";
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->bigIncrements('cpayment_id');
           
            $table->bigInteger('customer_id');
            $table->date('cpayment_date');
            // PaymentType:
            //      1: chuyển khoản
            //      2: Tiền mặt
            //      3: Điều chỉnh tăng: (cửa hành thanh toán thêm ảo để giảm công nợ)
            //      4: Điều chỉnh giảm: (giảm bớt thanh toán cửa hàng để tăng thêm công nợ)
          
            $table->decimal('cpayment_money',19,2)->default(0);
            $table->decimal('total',19,2)->default(0);
            
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
