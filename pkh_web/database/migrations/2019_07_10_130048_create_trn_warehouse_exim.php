<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\BaseTableTrait;

class CreateTrnWarehouseExim extends Migration
{
    use BaseTableTrait;

    const TABLE_NAME = "trn_warehouse_exim";

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        echo(' - Cretate table ' . self::TABLE_NAME . PHP_EOL);
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->bigIncrements('warehouse_exim_id');
           
            $table->bigInteger('from_warehouse_id');
            $table->bigInteger('to_warehouse_id');
            $table->string('warehouse_exim_code', 32);

            $table->decimal('total',19,2);
            $table->decimal('volume',8,2);
            $table->decimal('carton',8,2);

            $table->integer('seq_no')->default(0);
            
            // 0: new
            // 1: export
            $table->string('exim_sts', 8);

            $table->text("notes")->nullable();
            $table->text("notes_cancel")->nullable();
            $table->dateTime('cancel_time')->nullable();

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
