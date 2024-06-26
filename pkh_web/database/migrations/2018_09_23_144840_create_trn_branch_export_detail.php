<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

class CreateTrnBranchExportDetail extends Migration
{
    use BaseTableTrait;

    const TABLE_NAME = "trn_branch_export_detail";

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->bigInteger('branch_export_id');
            $table->bigInteger('product_id');
            $table->integer('seq_no');
            $table->integer('amount');
            $table->decimal('unit_price', 19, 2)->default(0);

            $this->addRecordHeader($table);

            $table->primary(['branch_export_id', 'product_id'], self::TABLE_NAME . "_pk");
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
