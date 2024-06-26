<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

// class CreateTrnStoreOrder extends Migration
// {
//     use BaseTableTrait;

//     const TABLE_NAME = "trn_store_order";

//     /**
//      * Run the migrations.
//      *
//      * @return void
//      */
//     public function up()
//     {
//         echo(' - Cretate table ' . self::TABLE_NAME . PHP_EOL);
//         Schema::create(self::TABLE_NAME, function (Blueprint $table) {
//             $table->bigIncrements('store_order_id');
//             $table->string('store_order_code', 32);

//             $table->bigInteger('prev_store_order_id')->nullable();
//             $table->string('prev_store_order_code', 32)->nullable();
//             $table->bigInteger('store_id');
//             $table->decimal('discount_1', 5, 2)->default(0);
//             $table->decimal('discount_2', 5, 2)->default(0);

//             $table->date('order_date');
//             $table->decimal('total',19,2)->default(0);
//             $table->decimal('total_with_discount',19,2)->default(0);
//             $table->decimal('carton',8,2)->default(0);
//             $table->decimal('volume',8,2)->default(0);
//             // 0: draft
//             // 1: dang xuat hang -> khong cho sua
//             // 2: dang giao hang
//             // 4: Finish
//             // 5: cancel
//             $table->string('order_sts', 8);
//             $table->text("notes")->nullable();
//             $table->text("notes_cancel")->nullable();
//             $table->integer('salesman_id')->nullable();
//             $table->integer('count_print')->default(0);
//             $table->dateTime('last_print_check_time')->nullable();
//             $table->integer('seq_no')->default(0);
//             $table->dateTime('cancel_time')->nullable();
//             $table->dateTime('split_time')->nullable();
//             $table->dateTime('expected_date')->nullable();
//             $table->dateTime('confirm_time')->nullable();

//             $table->bigInteger('promotion_id')->nullable();
//             // $table->tinyInteger('warranty_type')->default(0); // 0 : deactive, 1: active
//             // $table->tinyInteger('sample_type')->default(0);// 0 : deactive, 1: free, 2: charge 
//             $table->decimal('admin_time', 5, 2)->default(0);
//             $table->decimal('warehouse_time', 5, 2)->default(0);
//             $table->tinyInteger('order_type')->default(0);
//             $table->bigInteger('branch_id')->nullable();
//             $table->bigInteger('supplier_id')->nullable();
//             $table->decimal('completion_percent', 5, 2)->default(0);

//             $table->string('source_sale', 64)->nullable();
//             $table->string('order_id_3rd', 64)->nullable();

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
