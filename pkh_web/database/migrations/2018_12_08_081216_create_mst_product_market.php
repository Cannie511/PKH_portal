<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

class CreateMstProductMarket extends Migration
{
    use BaseTableTrait;

    const TABLE_NAME = "mst_product_market";
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        echo(' - Cretate table ' . self::TABLE_NAME . PHP_EOL);

        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->bigIncrements('product_market_id');
            // 1: vat pham marketing
            // 2: van phong pham
            $table->integer('type')->default(1);
            $table->string('code', 32);
            $table->string('name', 255);
            $table->string('img_path', 255)->nullable();
            $table->string('description', 1024)->nullable();
            
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
