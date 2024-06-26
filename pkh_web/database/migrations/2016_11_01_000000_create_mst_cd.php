<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

class CreateMstCd extends Migration
{
    use BaseTableTrait;

    const TABLE_NAME = "mst_cd";
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        echo(' - Cretate table ' . self::TABLE_NAME . PHP_EOL);
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->string('group_id', 128);
            $table->string('code_cd', 16);
            $table->string('code_name', 128);
            $table->string('code_value', 512)->nullable();
            $table->integer('display_order')->default(0);

            $table->primary(['group_id', 'code_cd']);

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
