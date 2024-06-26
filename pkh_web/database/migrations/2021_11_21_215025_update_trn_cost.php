<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

class UpdateTrnCost extends Migration
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
        Schema::table(self::TABLE_NAME, function (Blueprint $table) {
            $table->dateTime('confirm_time')->nullable();
            $table->dateTime('cancel_time')->nullable();

            $table->text('request_notes')->nullable();
            $table->text('confirm_notes')->nullable();
          

            $table->integer('confirm_by')->nullable();
            $table->string('cost_sts', 8)->default('0');
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
            $table->dropColumn('confirm_time');
            $table->dropColumn('cancel_time');
            $table->dropColumn('request_notes');
            $table->dropColumn('confirm_notes');
            $table->dropColumn('confirm_by');
            $table->dropColumn('cost_sts');

            // DB::statement("ALTER TABLE trn_cost DROP COLUMN confirm_time");
            // DB::statement("ALTER TABLE trn_cost DROP COLUMN cancel_time");
            // DB::statement("ALTER TABLE trn_cost DROP COLUMN request_notes");
            // DB::statement("ALTER TABLE trn_cost DROP COLUMN confirm_notes");
            // DB::statement("ALTER TABLE trn_cost DROP COLUMN confirm_by");
            // DB::statement("ALTER TABLE trn_cost DROP COLUMN cost_sts");
        });
    }
}

