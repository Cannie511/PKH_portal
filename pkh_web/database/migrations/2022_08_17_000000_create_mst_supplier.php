<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

class CreateMstSupplier extends Migration
{
    use BaseTableTrait;

    const TABLE_NAME = "mst_supplier";

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        echo(' - Update table ' . self::TABLE_NAME . PHP_EOL);
        Schema::table(self::TABLE_NAME, function (Blueprint $table) {
           
            $table->string('address', 255);
  
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
