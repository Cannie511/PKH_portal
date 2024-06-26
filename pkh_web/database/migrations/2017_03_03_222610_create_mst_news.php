<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

class CreateMstNews extends Migration
{
    use BaseTableTrait;

    const TABLE_NAME = "mst_news";
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            
            $table->bigIncrements('id');
            $table->date('publish_date')->nullable();
            $table->string('slug', 1024);
            $table->string('title', 1024);
            $table->string('description', 1024)->nullable();
            $table->string('keywords', 1024)->nullable();
            $table->text('short_content')->nullable();
            $table->text('content')->nullable();
            $table->string('image_path', 1024)->nullable();
            $table->string('feature_image_path', 1024)->nullable();
            $table->boolean('show_flg')->default(1);  

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
