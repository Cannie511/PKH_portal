<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

// class CreateMstProduct extends Migration
// {
//     use BaseTableTrait;

//     const TABLE_NAME = "mst_product";

//     /**
//      * Run the migrations.
//      *
//      * @return void
//      */
//     public function up()
//     {
//         echo (' - Cretate table ' . self::TABLE_NAME . PHP_EOL);
//         Schema::create(self::TABLE_NAME, function (Blueprint $table) {
//             $table->bigIncrements('product_id');
//             // Product type
//             // 0: single
//             // 1: group 
//             $table->integer('product_type')->default(0);
//             $table->integer('supplier_id');
//             $table->integer('product_cat_id');
//             $table->string('product_code', 16)->unique();
//             $table->string('stock_code', 255);
//             $table->string('name', 255);
//             $table->string('name_origin', 255)->nullable();
//             $table->string('color', 255)->nullable();
//             $table->string('packing', 255)->nullable();
//             $table->integer('moq')->nullable();
//             $table->integer('handle_id')->nullable();
//             $table->integer('color_id')->nullable();
//             $table->integer('packing_id')->nullable();
//             $table->integer('packaging_id')->nullable();
//             $table->integer('standard_packing')->nullable();
//             $table->integer('warning_qty')->default(0);
//             $table->decimal('purchase_price', 19, 2)->default(0);
//             $table->decimal('selling_price', 19, 2)->default(0);
//             $table->decimal('accountant_price', 19, 2)->default(0);
//             $table->decimal('selling_price_sample', 19, 2)->default(0);
//             $table->decimal('selling_price_tax', 19, 2)->default(0);
//             $table->string('product_code_old', 256)->nullable();
//             $table->boolean('allow_order_flg')->default(0);
//             $table->integer('warranty_year')->default(0);
//             $table->text('chr_feature')->nullable();
//             $table->integer('priority_degree')->default(0);
//             $table->decimal('selling_price_retail', 19, 2)->default(0);
//             $table->decimal('selling_price_standard', 19, 2)->default(0);
//             $table->decimal('import_price', 19, 2)->default(0);
//             $table->string('shopee_url', 512);

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
