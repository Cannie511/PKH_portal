<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;
class CreateTrnWebOrder extends Migration
{
      use BaseTableTrait;

    const TABLE_NAME = "trn_web_order";
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->bigIncrements('web_order_id');
            $table->bigInteger('user_web_id');

            $table->decimal('total',19,2)->default(0);
          
            $table->string('order_sts', 8);
            $table->text("notes")->nullable();
            $table->text("notes_cancel")->nullable();
            $table->integer('salesman_id')->nullable();
         
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
