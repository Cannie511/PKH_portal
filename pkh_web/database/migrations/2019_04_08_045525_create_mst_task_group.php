<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\BaseTableTrait;

class CreateMstTaskGroup extends Migration
{
    use BaseTableTrait;

    const TABLE_NAME = "mst_task_group";
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        echo(' - Cretate table ' . self::TABLE_NAME . PHP_EOL);
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {

            $table->increments('task_group_id');
        
            $table->string('task_group_name', 255);
        
            $table->integer('task_group_weight')->default(0);
           
            $table->text("task_group_notes")->nullable();

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
