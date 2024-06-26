<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;
class CreateUsersWeb extends Migration
{
      use BaseTableTrait;
    /**
     * Run the migrations.
     *
     * @return void
     */
       const TABLE_NAME = "users_web";

    public function up()
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 255);
            $table->string('email', 255);
            $table->string('phone_number', 255);
            $table->integer('area1')->nullable();
            $table->integer('area2')->nullable();
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
