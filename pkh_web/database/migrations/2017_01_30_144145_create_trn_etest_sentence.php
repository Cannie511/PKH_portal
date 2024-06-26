<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

class CreateTrnEtestSentence extends Migration
{
    use BaseTableTrait;

    const TABLE_NAME = "trn_etest_sentence";
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->bigInteger('etest_id');
            $table->integer('seq_no');
            // seq_type
            // 0: group
            // 1: text
            // 2: textarea
            // 3: checkbox
            // 4: radio
            $table->string('seq_type', 8)->default('0');
            $table->text('question')->nullable();
            $table->text('answer')->nullable();

            $this->addRecordHeader($table);

            $table->primary(['etest_id', 'seq_no'], self::TABLE_NAME . "_pk");
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
