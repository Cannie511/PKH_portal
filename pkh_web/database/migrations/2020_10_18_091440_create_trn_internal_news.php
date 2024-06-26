<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

class CreateTrnInternalNews extends Migration
{
    use BaseTableTrait;

    const TABLE_NAME = "trn_internal_news";
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->string('title', 1024);
            $table->text('content')->nullable();
            // news_sts:
            //  + 0: DRAFT
            //  + 1: PUBLISHED
            $table->string('news_sts', 8)->default('0');

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