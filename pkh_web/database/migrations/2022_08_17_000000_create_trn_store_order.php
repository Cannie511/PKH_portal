<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

class CreateTrnStoreOrder extends Migration
{
    use BaseTableTrait;

    const TABLE_NAME = "trn_store_order";
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        echo(' - Update table ' . self::TABLE_NAME . PHP_EOL);
        Schema::table(self::TABLE_NAME, function (Blueprint $table) {
            
            $table->dropColumn('prev_store_order_id');
            $table->dropColumn('prev_store_order_code');      
            $table->dropColumn('discount_1');
            $table->dropColumn('discount_2');
            $table->dropColumn('carton');
            $table->dropColumn('volume');
            $table->dropColumn('order_sts');
            $table->dropColumn("notes_cancel");
            $table->dropColumn('salesman_id');
            $table->dropColumn('count_print');
            $table->dropColumn('last_print_check_time');
            $table->dropColumn('seq_no');
            $table->dropColumn('cancel_time');
            $table->dropColumn('split_time');
            $table->dropColumn('expected_date');
            $table->dropColumn('confirm_time');
            $table->dropColumn('promotion_id');
            $table->dropColumn('admin_time');
            $table->dropColumn('warehouse_time');
            $table->dropColumn('order_type');
            $table->dropColumn('branch_id');
            $table->dropColumn('supplier_id');
            $table->dropColumn('completion_percent');
         
          

            $table->decimal('discount', 19,2);
           
          
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
