<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

class CreateTrnBranchExport extends Migration
{
    use BaseTableTrait;

    const TABLE_NAME = "trn_branch_export";

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->bigIncrements('branch_export_id');

            $table->bigInteger('branch_id_from');
            $table->bigInteger('branch_id_to');
            $table->string('branch_export_code', 32);
            $table->decimal('total', 19, 2)->default(0);
            $table->decimal('total_with_discount', 19, 2)->default(0);
            $table->integer('seq_no');
            $table->string('export_sts', 16);
            $table->text('notes')->nullable();
            $table->dateTime('cancel_time')->nullable();
            $table->bigInteger('warehouseman_id')->nullable();
            $table->bigInteger('shipping_id')->nullable();
            $table->dateTime('packing_time')->nullable();
            $table->dateTime('confirm_time')->nullable();
            $table->dateTime('delivery_time')->nullable();
            $table->dateTime('shipping_time')->nullable();
            $table->dateTime('receive_time')->nullable();
            $table->bigInteger('packing_by')->nullable();
            $table->bigInteger('confirm_by')->nullable();
            $table->bigInteger('delivery_by')->nullable();
            $table->bigInteger('shipping_by')->nullable();
            $table->bigInteger('receive_by')->nullable();

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
