<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

class MstOaFollower extends Migration
{
    use BaseTableTrait;

    const TABLE_NAME = "mst_oa_follower";
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->bigIncrements('oa_follower_id');
            $table->bigInteger('store_id')->nullable();
            $table->string('avatar', 255);
            $table->string('user_id', 255);
            $table->string('user_id_by_app', 255);
            $table->string('display_name', 255);
            $table->string('birth_date', 255)->nullable();
            $table->text("notes")->nullable();
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
