<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

class CreateTrnAbsent extends Migration
{
    use BaseTableTrait;

    const TABLE_NAME = "trn_absent";
    
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
            $table->date('absent_date');
            $table->float('amount', 4, 2);
            // 1: sang, 2: chieu, 3: ca ngay
            $table->integer('absent_type');
            // 1: Annual leave 2: No-pay leave
            $table->integer('leave_type')->default(1);
            $table->text('reason')->nullable();
            // 0: default
            // 1: accept
            // 2: deny
            // 3: cancel
            $table->string('status', 8)->default('0');
            $table->integer('approve_user_id');
            $table->text('cmt')->nullable();
            $table->timestampTz('approve_ts')->nullable();
            $table->integer('leave_allocation_id')->nullable();

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
