<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreScoresTable extends Migration
{
    public function up()
    {
        Schema::create('store_scores', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('store_id');
            $table->integer('year');
            $table->integer('quarter');
            $table->integer('sale_score');
            $table->integer('retention_score');
            $table->integer('order_score');
            $table->integer('dept_score');
            $table->integer('total_score_card');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('store_scores');
    }
}


