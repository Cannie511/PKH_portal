<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

class CreateTrnComment extends Migration
{
    use BaseTableTrait;

    const TABLE_NAME = "trn_comment";
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('group', 64);
            $table->bigInteger('id1')->nullable();
            $table->bigInteger('id2')->nullable();
            $table->text('content')->nullable();

            $this->addRecordHeader($table);

            $table->index('group');
            $table->index('user_id');
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
