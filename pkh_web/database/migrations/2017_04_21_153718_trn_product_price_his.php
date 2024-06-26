<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

class TrnProductPriceHis extends Migration
{
    use BaseTableTrait;

    const TABLE_NAME = "trn_product_price_his";
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            
            $table->bigInteger('product_id');
            $table->decimal('selling_price',19,2);
            $table->decimal('selling_price_sample',19,2);
            $table->decimal('selling_price_tax',19,2);
            $table->integer('change_user_id');
            $table->datetime('change_time');
            
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
