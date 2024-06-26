<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

class CreateTrnAuditLog extends Migration
{
    use BaseTableTrait;

    const TABLE_NAME = "trn_audit_log";
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        echo(' - Cretate table ' . self::TABLE_NAME . PHP_EOL);
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->integer('user_id');
            $table->string('ip', 32);
            $table->string("agent", 1024)->nullable();
            $table->string('event_name', 256);
            $table->text("notes")->nullable();
            $this->addLocationInfo($table, "ip");
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
