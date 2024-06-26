<?php


use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

class CreateMstBranch extends Migration
{
    use BaseTableTrait;

    const TABLE_NAME = "mst_branch";

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->bigIncrements('branch_id');

            $table->string('branch_code', 32);
            $table->string('branch_name', 255);
            $table->string('branch_address', 1024)->nullable();
            $table->string('branch_contact', 16)->nullable();
            $table->date('started_date')->nullable();

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
