<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

class CreateTrnImportWhStore extends Migration
{
    use BaseTableTrait;

    const TABLE_NAME = "trn_import_wh_store";

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->bigIncrements('import_wh_store_id');
            // 1: tra hang
            // 2: bao hanh
            $table->integer('import_type')->default(1);
            $table->bigInteger('store_id');
            $table->bigInteger('warehouse_id');

            $table->date('import_date');
            $table->decimal('total',19,2)->default(0);
            $table->text('notes');
            $table->string('import_sts', 8)->default(0);
            $table->integer('salesman_id')->nullable();
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
