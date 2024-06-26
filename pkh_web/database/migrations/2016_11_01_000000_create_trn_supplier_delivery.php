<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

class CreateTrnSupplierDelivery extends Migration
{
    use BaseTableTrait;

    const TABLE_NAME = "trn_supplier_delivery";
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->bigIncrements('supplier_delivery_id');
            $table->bigInteger('supplier_order_id');
            $table->integer('supplier_id');
            $table->string('pi_no', 8)->nullable();
            $table->date('delivery_date');

            //new column
            $table->string('contract_no', 25)->nullable();
            $table->date('payment_1_date')->nullable();
            $table->date('finish_cont_date')->nullable();
            $table->date('deliver_cont_date')->nullable();
            $table->date('arrive_port_date')->nullable();
            $table->date('comming_pkh_date')->nullable();
            $table->date('payment_2_date')->nullable();

            $table->date('finish_cont_expected_date')->nullable();
            $table->date('deliver_cont_expected_date')->nullable();
            $table->date('arrive_port_expected_date')->nullable();
            $table->date('comming_pkh_expected_date')->nullable();
            $table->date('payment_2_expected_date')->nullable();

            $table->integer('payment_1_percent')->default(40);
            $table->integer('payment_2_duration')->default(45);
            $table->decimal('insurance_cost');
            $table->integer('delivery_sts')->default(0);
            $table->decimal('volume', 19, 2)->nullable();

            $table->text("notes")->nullable();
            //end new column

            $table->decimal('total',19,2)->default(0);
            $table->decimal('total_vi',19,2)->default(0);
            $table->double('rate')->default(1);
            // Chi phí hàng có tính duty tax
            $table->decimal('total_duty_vi',19,2)->default(0);
            // Phí VAT
            $table->decimal('vat_tax');
            // Cước tàu
            $table->decimal('frieght_cost');
            // 5) Phí vận chuyển từ cảng về kho, 6) Phí làm thủ tục hải quan, 7) Phí bến bãi (local charge), 8) Phí nâng hạ (handling fee), 9) Phí bốc dỡ từ cont xuống kho
            $table->decimal('landed_cost');
            $table->dateTime('cancel_time')->nullable();
            
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
