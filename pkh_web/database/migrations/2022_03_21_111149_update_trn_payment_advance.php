<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

class UpdateTrnPaymentAdvance extends Migration
{
    use BaseTableTrait;

    const TABLE_NAME = "trn_payment_advance";

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(self::TABLE_NAME, function (Blueprint $table) {
            $table->text('confirm_notes')->after('discount')->nullable();
            $table->text('confirm_by')->after('confirm_notes')->nullable();
            $table->text('confirm_time')->after('confirm_by')->nullable();
            $table->text('cancel_time')->after('confirm_time')->nullable();
            $table->text('cancel_notes')->after('cancel_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(self::TABLE_NAME, function (Blueprint $table) {
            $table->dropColumn('confirm_notes');
            $table->dropColumn('confirm_by');
            $table->dropColumn('confirm_time');
            $table->dropColumn('cancel_time');
            $table->dropColumn('cancel_notes');
        });
    }
}
