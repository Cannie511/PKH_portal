<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

// class CreateTrnWarehouseChange extends Migration
// {
//     use BaseTableTrait;

//     const TABLE_NAME = "trn_warehouse_change";

//     /**
//      * Run the migrations.
//      *
//      * @return void
//      */
//     public function up()
//     {
//         echo(' - Cretate table ' . self::TABLE_NAME . PHP_EOL);

//         Schema::create(self::TABLE_NAME, function (Blueprint $table) {
//             // 1: import
//             // 2: export
//             // 3: edit + 
//             // 4: edit -
//             // // 5: edit SET
//             // 5: Nhập bảo hành
//             // 6: Nhập trả lại
//             $table->integer('warehouse_change_type');
//             $table->bigInteger('product_id');
//             $table->bigInteger('warehouse_id');

//             $table->date('changed_date');
//             $table->integer('amount');

//             // For import
//             $table->bigInteger('supplier_delivery_id')->nullable();

//              // For import
//             $table->bigInteger('import_wh_factory_id')->nullable();

//             // For export
//             $table->bigInteger('store_delivery_id')->nullable();
//             // For export and import between 2 warehouses
//             $table->bigInteger('warehouse_exim_id')->nullable();

//             $table->bigInteger('branch_id')->nullable();

//             $table->text('description')->nullable();

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
