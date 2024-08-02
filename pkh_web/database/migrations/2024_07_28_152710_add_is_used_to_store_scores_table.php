<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsUsedToStoreScoresTable extends Migration
{
    public function up()
    {
        Schema::table('store_scores', function (Blueprint $table) {
            $table->boolean('isUsed')->default(false);
        });
    }

    public function down()
    {
        Schema::table('store_scores', function (Blueprint $table) {
            $table->dropColumn('isUsed');
        });
    }
}
