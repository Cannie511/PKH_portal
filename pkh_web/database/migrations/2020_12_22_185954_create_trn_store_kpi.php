<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

class CreateTrnStoreKpi extends Migration
{
    use BaseTableTrait;

    const TABLE_NAME = "trn_store_kpi";
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('store_id');
            $table->integer("year")->default(0);
            $table->decimal("target_year", 19, 2)->default(0);
            $table->decimal("result_year", 19, 2)->default(0);
            $table->integer("discount")->default(0);

            $table->decimal('month_1_target',19,2)->default(0);
            $table->decimal('month_2_target',19,2)->default(0);
            $table->decimal('month_3_target',19,2)->default(0);
            $table->decimal('month_4_target',19,2)->default(0);
            $table->decimal('month_5_target',19,2)->default(0);
            $table->decimal('month_6_target',19,2)->default(0);
            $table->decimal('month_7_target',19,2)->default(0);
            $table->decimal('month_8_target',19,2)->default(0);
            $table->decimal('month_9_target',19,2)->default(0);
            $table->decimal('month_10_target',19,2)->default(0);
            $table->decimal('month_11_target',19,2)->default(0);
            $table->decimal('month_12_target',19,2)->default(0);

            $table->decimal('month_1_result',19,2)->default(0);
            $table->decimal('month_2_result',19,2)->default(0);
            $table->decimal('month_3_result',19,2)->default(0);
            $table->decimal('month_4_result',19,2)->default(0);
            $table->decimal('month_5_result',19,2)->default(0);
            $table->decimal('month_6_result',19,2)->default(0);
            $table->decimal('month_7_result',19,2)->default(0);
            $table->decimal('month_8_result',19,2)->default(0);
            $table->decimal('month_9_result',19,2)->default(0);
            $table->decimal('month_10_result',19,2)->default(0);
            $table->decimal('month_11_result',19,2)->default(0);
            $table->decimal('month_12_result',19,2)->default(0);
            
            // 0: Draft
            // 1: In Review
            // 2: Done
            $table->string("kpi_sts", 8)->default(0);
            $table->text('notes')->nullable();

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
