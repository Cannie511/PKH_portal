<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\BaseTableTrait;

class CreateTrnTaskUser extends Migration
{
    use BaseTableTrait;

    const TABLE_NAME = "trn_task_user";
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        echo(' - Cretate table ' . self::TABLE_NAME . PHP_EOL);
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {

            $table->bigIncrements('task_id');
            $table->integer('task_group_id');
            $table->integer('user_id');
            $table->string('task_name', 255);
            $table->text("task_content")->nullable();
            $table->integer('task_sts')->default(0);
            $table->integer('task_score')->default(0);
            $table->dateTime('start_date')->nullable();
            $table->dateTime('deadline')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->text("submit_notes")->nullable();
            $table->text("response_notes")->nullable();
            $table->string('task_code', 32);
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
