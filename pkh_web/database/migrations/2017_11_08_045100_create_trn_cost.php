<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

class CreateTrnCost extends Migration
{

    use BaseTableTrait;

    const TABLE_NAME = "trn_cost";
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->bigIncrements('cost_id');
            $table->bigInteger('cost_cat_id');
            $table->bigInteger('department_id');
            $table->date('cost_date');
            $table->decimal('amount', 19, 2)->default(0);
            $table->string('contra_account', 15);
            $table->string('voucher', 30);
            $table->text('description')->nullable();

            // $table->dateTime('confirm_time')->nullable();
            // $table->dateTime('cancel_time')->nullable();

            // $table->text('request_notes')->nullable();
            // $table->text('confirm_notes')->nullable();
            // $table->text('cancel_notes')->nullable();

            // $table->integer('confirm_by')->nullable();
            // $table->string('cost_sts', 8)->default('0');
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
