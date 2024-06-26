<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

class CreateTrnImportWhFactory extends Migration
{
    use BaseTableTrait;

    const TABLE_NAME = "trn_import_wh_factory";

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->bigIncrements('import_wh_factory_id');
            $table->bigInteger('supplier_id');
            $table->bigInteger('warehouse_id');

            $table->date('import_date');
            $table->text('notes');
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
