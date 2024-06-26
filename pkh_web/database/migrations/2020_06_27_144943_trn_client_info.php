<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

class TrnClientInfo extends Migration
{
    use BaseTableTrait;

    const TABLE_NAME = "trn_client_info";

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->string("name", 128)->nullable();
            $table->string("email", 128)->nullable();
            $table->string("tel", 32)->nullable();
            $table->string("tel2", 32)->nullable();
            $table->string("address", 512)->nullable();

            $table->bigInteger('store_id')->nullable();

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
