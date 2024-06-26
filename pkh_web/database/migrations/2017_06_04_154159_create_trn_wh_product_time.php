<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

class CreateTrnWhProductTime extends Migration
{
    use BaseTableTrait;

    const TABLE_NAME = "trn_wh_product_time";

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        echo(' - Cretate table ' . self::TABLE_NAME . PHP_EOL);
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->date('in_date');
            $table->bigInteger('product_id');
            $table->integer('amount');
            $table->integer('remain');
            $table->bigInteger('supplier_delivery_id')->nullable();
            $table->date('soldout_date')->nullable();;
            $table->index(['in_date', 'product_id']);
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
