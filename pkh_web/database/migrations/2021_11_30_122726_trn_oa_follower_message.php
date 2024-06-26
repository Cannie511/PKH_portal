<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

class TrnOaFollowerMessage extends Migration
{
    use BaseTableTrait;

    const TABLE_NAME = "trn_oa_follower_message";
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->bigIncrements('oa_follower_message_id');
            $table->bigInteger('total')->nullable();
            $table->bigInteger('total_sent')->nullable();
            $table->text("content")->nullable();
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
