<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

// class CreateTrnSupplierOrder extends Migration
// {
//     use BaseTableTrait;

//     const TABLE_NAME = "trn_supplier_order";
    
//     /**
//      * Run the migrations.
//      *
//      * @return void
//      */
//     public function up()
//     {
//         echo(' - Cretate table ' . self::TABLE_NAME . PHP_EOL);
//         Schema::create(self::TABLE_NAME, function (Blueprint $table) {
//             $table->bigIncrements('supplier_order_id');
//             $table->integer('supplier_id');
//             $table->date('order_date')->nullable();
//             $table->date('send_po_date'); //new column
//             $table->decimal('total', 19, 2);
//             $table->decimal('total_vi', 19 , 2);
//             $table->decimal('volume', 19, 2)->nullable(); //new column
//             $table->double('rate')->default(1);

//             // 0: draft
//             // 1: confirm
//             // 2: cancel
//             $table->string('order_sts', 8);

//             // // Phí hải quan 
//             // $table->decimal('duty_tax');
//             // // Phí VAT
//             // $table->decimal('vat_tax');
//             // // Cước tàu
//             // $table->decimal('frieght_cost');
//             // // 5) Phí vận chuyển từ cảng về kho, 6) Phí làm thủ tục hải quan, 7) Phí bến bãi (local charge), 8) Phí nâng hạ (handling fee), 9) Phí bốc dỡ từ cont xuống kho
//             // $table->decimal('landed_cost');

//             $table->string('pi_no', 8)->nullable();
            
//             $this->addRecordHeader($table);
//         });
//     }

//     /**
//      * Reverse the migrations.
//      *
//      * @return void
//      */
//     public function down()
//     {
//         Schema::dropIfExists(self::TABLE_NAME);
//     }
// }
