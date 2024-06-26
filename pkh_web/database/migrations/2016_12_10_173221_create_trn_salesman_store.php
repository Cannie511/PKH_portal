<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

class CreateTrnSalesmanStore extends Migration
{
    use BaseTableTrait;

    const TABLE_NAME = "trn_salesman_store";
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->bigIncrements('salesman_store_id');
            $table->integer('salesman_id');
            $table->bigInteger('store_id');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            
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
