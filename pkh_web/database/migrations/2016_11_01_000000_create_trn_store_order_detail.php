<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

// class CreateTrnStoreOrderDetail extends Migration
// {
//     use BaseTableTrait;

//     const TABLE_NAME = "trn_store_order_detail";

//     /**
//      * Run the migrations.
//      *
//      * @return void
//      */
//     public function up()
//     {
//         echo(' - Cretate table ' . self::TABLE_NAME . PHP_EOL);
//         Schema::create(self::TABLE_NAME, function (Blueprint $table) {
//             $table->bigInteger('store_order_id');
//             $table->bigInteger('product_id');
//             $table->integer('seq_no')->default(0);
//             $table->integer('amount')->default(0);
//             $table->decimal('unit_price', 19, 2)->default(0);

//             $table->primary(['store_order_id', 'product_id'], self::TABLE_NAME . "_pk");

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
