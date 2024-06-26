<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

class CreateMstProductSeries extends Migration
{
    use BaseTableTrait;

    const TABLE_NAME = "mst_product_series";

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->bigInteger('product_id');
            $table->bigInteger('product_detail_id');
            $table->decimal('selling_price', 19, 2)->default(0);
            $table->decimal('selling_price_tax', 19, 2)->default(0);

            $this->addRecordHeader($table);

            $table->primary(['product_id', 'product_detail_id'], self::TABLE_NAME . "_pk");
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
