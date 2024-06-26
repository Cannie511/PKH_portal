<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

class CreateTrnAbsentSetting extends Migration
{
    use BaseTableTrait;

    const TABLE_NAME = "trn_absent_setting";
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->integer('user_id');
            $table->integer('setting_year');
            $table->float('amount', 4, 2);
            $table->text('notes')->nullable();

            $table->primary(['user_id', 'setting_year'], self::TABLE_NAME . "_pk");
            
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
