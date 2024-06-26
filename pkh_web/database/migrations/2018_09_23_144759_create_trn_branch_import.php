<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

class CreateTrnBranchImport extends Migration
{
    use BaseTableTrait;

    const TABLE_NAME = "trn_branch_import";

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->bigIncrements('branch_import_id');

            $table->bigInteger('branch_id_from');
            $table->bigInteger('branch_id_to');
            $table->string('branch_import_code', 32);
            $table->decimal('total', 19, 2)->default(0);
            $table->decimal('total_with_discount', 19, 2)->default(0);
            $table->integer('seq_no');
            $table->string('import_sts', 16);
            $table->text('notes')->nullable();
            $table->dateTime('cancel_time')->nullable();
            $table->bigInteger('warehouseman_id')->nullable();
            $table->dateTime('confirm_time')->nullable();
            $table->dateTime('import_time')->nullable();
            $table->bigInteger('confirm_by')->nullable();
            $table->bigInteger('import_by')->nullable();

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
