<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

class CreateTrnStoreRank extends Migration
{
    use BaseTableTrait;

    const TABLE_NAME = "trn_store_rank";
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            
            $table->bigInteger('store_id');
            $table->integer('year');
            $table->integer('month');
            $table->integer('store_rank');
            $table->decimal('order_total',19,2);
            $table->decimal('order_total_with_discount',19,2);
            $table->decimal('delivery_total',19,2);
            $table->decimal('delivery_total_with_discount',19,2);
            $table->decimal('payment',19,2);
            
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
