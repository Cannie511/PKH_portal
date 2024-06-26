<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

class CreateTrnCheckWarehouseDetail extends Migration
{
    use BaseTableTrait;

    const TABLE_NAME = "trn_check_warehouse_detail";
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            
            $table->bigInteger('check_warehouse_id');

            $table->bigInteger('product_id');
            $table->integer('seq_no')->default(0);
            $table->integer('amount')->default(0);
            $table->decimal('unit_price', 19, 2)->default(0);
          
            $table->text('notes')->nullable();
            $table->text('notes_2')->nullable();
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
