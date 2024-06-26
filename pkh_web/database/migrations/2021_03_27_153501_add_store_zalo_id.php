<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStoreZaloId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mst_store', function (Blueprint $table) {
            $table->string('zalo_user_id', 32)->nullable()->after('accountant_store_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mst_store', function (Blueprint $table) {
            $table->dropColumn('zalo_user_id');
        });
    }
}
