<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

class AddReviewStsToStore extends Migration
{
    use BaseTableTrait;

    const TABLE_NAME = "mst_store";
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(self::TABLE_NAME, function (Blueprint $table) {
            $table->string('review_sts', 16)->after('zalo_user_id');
            $table->integer('review_user_id')->after('review_sts');
            $table->date('review_date')->after('review_user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(self::TABLE_NAME, function (Blueprint $table) {
            $table->dropColumn('review_sts');
            $table->dropColumn('review_user_id');
            $table->dropColumn('review_date');
        });
    }
}
