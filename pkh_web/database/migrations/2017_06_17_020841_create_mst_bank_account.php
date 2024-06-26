<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

class CreateMstBankAccount extends Migration
{
     use BaseTableTrait;

    const TABLE_NAME = "mst_bank_account";

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        echo(' - Cretate table ' . self::TABLE_NAME . PHP_EOL);
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->bigIncrements('bank_account_id');
            $table->bigInteger('store_id');
            $table->text('bank_name');
            $table->text('bank_branch')->nullable();
            $table->text('bank_account_no');
            $table->text('bank_account_name');
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
