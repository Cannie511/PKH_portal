<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

class CreateTrnSupplierOrder extends Migration
{
    use BaseTableTrait;

    const TABLE_NAME = "trn_supplier_order";
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        echo(' - Update table ' . self::TABLE_NAME . PHP_EOL);
        Schema::table(self::TABLE_NAME, function (Blueprint $table) {
           
         
            $table->dropColumn('send_po_date'); //new column
            $table->dropColumn('total_vi');
            $table->dropColumn('volume'); //new column
            $table->dropColumn('rate');
            $table->dropColumn('order_sts');
            $table->dropColumn('pi_no');


            $table->string('notes', 255)->nullable();
            $table->decimal('discount', 19,2);
            $table->decimal('total_with_discount', 19,2);
            
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
