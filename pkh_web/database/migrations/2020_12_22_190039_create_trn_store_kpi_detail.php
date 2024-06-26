<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

class CreateTrnStoreKpiDetail extends Migration
{
    use BaseTableTrait;

    const TABLE_NAME = "trn_store_kpi_detail";
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('kpi_id');
            $table->integer('month_index');

            $table->bigInteger('product_id');
            $table->integer('seq_no')->default(0);
            $table->integer('amount')->default(0);
            $table->decimal('unit_price', 19, 2)->default(0);
            
            $table->integer('result_amount')->default(0);
            $table->decimal('result_money',19,2)->default(0);

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