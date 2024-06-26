<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

class CreateMstCostCat extends Migration
{

    use BaseTableTrait;

    const TABLE_NAME = "mst_cost_cat";
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->bigIncrements('cost_cat_id');
            $table->bigInteger('parent_id')->nullable();
            $table->string('name', 1024);
         
            $table->text('description')->nullable();
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
