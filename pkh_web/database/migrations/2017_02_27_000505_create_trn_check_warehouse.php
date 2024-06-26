<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

class CreateTrnCheckWarehouse extends Migration
{
    use BaseTableTrait;

    const TABLE_NAME = "trn_check_warehouse";
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('check_user_id');
            $table->bigInteger('warehouse_id');

            $table->date('check_date');
            $table->bigInteger('branch_id')->nullable();

            // 0: default
            // 1: lock
            $table->string('checking_sts', 8)->default('0');
          
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
