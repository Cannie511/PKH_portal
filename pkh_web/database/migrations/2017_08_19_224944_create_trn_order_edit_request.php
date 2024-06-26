<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

class CreateTrnOrderEditRequest extends Migration
{
    use BaseTableTrait;

    const TABLE_NAME = "trn_order_edit_request";

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->bigIncrements('request_id');
            $table->date('request_date');

            // 1: huy don dat hang
            // 2: huy phieu xuat hang
            // 3: tach don hang va huy phan chua giao
            // 4: huy cong no
            $table->integer('request_type')->default(1);
            // 0: waiting
            // 1: ok
            // 2: ng
            $table->integer('request_sts')->default(0);
            $table->bigInteger('ref_id')->nullable();

            $table->text('request_notes');
            $table->text('response_notes');

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
