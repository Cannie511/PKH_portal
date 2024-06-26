<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

class CreateTrnCsNotes extends Migration
{
    use BaseTableTrait;

    const TABLE_NAME = "trn_cs_notes";
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('store_id');
            $table->bigInteger('pic_id');

          
            $table->text("cus_review");
            $table->text("com_resolve")->nullable();

            $table->string('cus_rating', 8);
            $table->string('com_rating', 8)->nullable();
            $table->string('status', 8);

            $table->text("notes_1")->nullable();
            $table->text("notes_2")->nullable();
            $table->text("notes_3")->nullable();

            $table->dateTime('deadline')->nullable();
            $table->dateTime('completed_time')->nullable();

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
