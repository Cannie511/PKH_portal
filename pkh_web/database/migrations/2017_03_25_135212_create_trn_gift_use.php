<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

class CreateTrnGiftUse extends Migration
{
    use BaseTableTrait;

    const TABLE_NAME = "trn_gift_use";
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            
            $table->bigInteger('gift_id');
            // 0: buy
            // 1: give
            $table->integer('use_type');
            $table->date('use_date');
            // 
            $table->integer('use_sts')->default(0);
            $table->bigInteger('order_id')->nullable();
            $table->text('notes')->nullable();

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
