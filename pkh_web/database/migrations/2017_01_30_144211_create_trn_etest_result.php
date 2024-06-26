<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

class CreateTrnEtestResult extends Migration
{
    use BaseTableTrait;

    const TABLE_NAME = "trn_etest_result";
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->bigInteger('etest_id');
            $table->integer('user_id');
            $table->integer('seq_no');

            $table->text('answer')->nullable();
            $table->integer('mark')->default(0);

            $this->addRecordHeader($table);

            $table->primary(['etest_id', 'user_id', 'seq_no'], self::TABLE_NAME . "_pk");
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
