<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

class CreateTrnWarehouseChange extends Migration
{
    use BaseTableTrait;

    const TABLE_NAME = "trn_warehouse_change";
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        echo(' - Update table ' . self::TABLE_NAME . PHP_EOL);
        
        Schema::table(self::TABLE_NAME, function (Blueprint $table) {


            $table->dropColumn('warehouse_id');
            $table->dropColumn('supplier_delivery_id')->nullable();
            $table->dropColumn('import_wh_factory_id')->nullable();
            $table->dropColumn('store_delivery_id')->nullable();
            $table->dropColumn('warehouse_exim_id')->nullable();
            $table->dropColumn('branch_id')->nullable();
            $table->dropColumn('description')->nullable();   
            
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
