<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use App\Models\BaseTableTrait;

class CreateUsersTable extends Migration
{

    use BaseTableTrait;

    const TABLE_NAME = "users";

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        echo(' - Cretate table ' . self::TABLE_NAME . PHP_EOL);

        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->increments('id');
            $table->string('oauth_provider')->nullable();
            $table->string('oauth_provider_id')->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->string('avatar')->nullable();
            $table->enum('email_verified', ['1', '0'])->default('0');
            $table->string('email_verification_code', 60)->nullable();
            $table->rememberToken();

            $table->timestampTz('last_login_at')->nullable();
            $table->integer('count_login_fail')->default(0);
            $table->bigInteger('store_id')->nullable();
            $table->bigInteger('supplier_id')->nullable();
            $table->bigInteger('relation_id')->nullable();
            $table->bigInteger('branch_id')->nullable();

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
