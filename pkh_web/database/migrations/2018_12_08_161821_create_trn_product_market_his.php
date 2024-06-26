<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

class CreateTrnProductMarketHis extends Migration
{
    use BaseTableTrait;

    const TABLE_NAME = "trn_product_market_his";
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        echo(' - Cretate table ' . self::TABLE_NAME . PHP_EOL);
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->bigIncrements('product_market_his_id');
            // 1: import
            // 2: export
            $table->integer('warehouse_change_type');
            $table->bigInteger('product_market_id');
            $table->date('changed_date');
            $table->decimal('price', 19, 2)->default(0);
            $table->integer('amount');
            $table->bigInteger('store_id')->nullable();

            // 1: NEW
            // 2: APPROVE
            // 3: DENY
            // 4: CANCEL
            $table->integer('status')->default(1);

            $table->text('description')->nullable();
            $table->text('description_approve')->nullable();
            
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
