<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMstGiftScorecardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_gift_scoreCard', function (Blueprint $table) {
            $table->increments('id'); // ID tự động tăng, khóa chính
            $table->integer('Total_ScoreCard'); // Tổng điểm tích lũy
            $table->integer('Discount'); // Giảm giá  
            $table->integer('Voucher'); // giá trị voucher 
            $table->timestamps(); // Thêm các cột created_at và updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mst_gift_scoreCard');
    }
}
