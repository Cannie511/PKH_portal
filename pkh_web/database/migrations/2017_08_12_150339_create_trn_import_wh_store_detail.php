<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

class CreateTrnImportWhStoreDetail extends Migration
{
    use BaseTableTrait;

    const TABLE_NAME = "trn_import_wh_store_detail";

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->bigInteger('import_wh_store_id');
            $table->bigInteger('product_id');
            $table->integer('amount');
            $this->addRecordHeader($table);

            $table->primary(['import_wh_store_id', 'product_id'], self::TABLE_NAME . "_pk");
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
