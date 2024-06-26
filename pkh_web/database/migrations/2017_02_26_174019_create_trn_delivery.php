<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

class CreateTrnDelivery extends Migration
{
    use BaseTableTrait;

    const TABLE_NAME = "trn_delivery";
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('delivery_date');
            $table->bigInteger('delivery_vendor_id');
            $table->decimal('price', 19, 2)->default(0);
            $table->string('payment_flg')->nullable('0');

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
