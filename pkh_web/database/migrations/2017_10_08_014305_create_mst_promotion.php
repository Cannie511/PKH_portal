<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

class CreateMstPromotion extends Migration
{
    use BaseTableTrait;

    const TABLE_NAME = "mst_promotion";

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->bigIncrements('promotion_id');
            $table->date('from_date');
            $table->date('to_date');

            $table->string('promotion_name', 1024);
            $table->integer('promotion_type')->default(0);
            // 0: default
            // 1: active
            // 2: finished
            // 3: cancelled
            $table->integer('promotion_sts')->default(0);

            $table->text('description')->nullable();
            $table->text('meta_data')->nullable();

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
