<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

class CreateTrnSalary extends Migration
{
    use BaseTableTrait;

    const TABLE_NAME = "trn_salary";
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->increments('id');
            $table->date("salary_month")->unique();
            $table->date("from_date");
            $table->date("to_date");
            $table->integer("total_days")->default(0);
            $table->integer("total_hours")->default(0);
            $table->decimal('total_amount',19,2)->default(0);
            $table->decimal('total_com_amount',19,2)->default(0);
            $table->decimal('total_bhxh',19,2)->default(0);
            $table->decimal('total_bhyt',19,2)->default(0);
            $table->decimal('total_bhtn',19,2)->default(0);
            $table->decimal('total_com_bhxh',19,2)->default(0);
            $table->decimal('total_com_bhyt',19,2)->default(0);
            $table->decimal('total_com_bhtn',19,2)->default(0);
            
            $table->decimal('tax_bhxh_percent', 5, 2)->default(8);
            $table->decimal('tax_bhyt_percent', 5, 2)->default(1.5);
            $table->decimal('tax_bhtn_percent', 5, 2)->default(1);
            $table->decimal('com_tax_bhxh_percent', 5, 2)->default(8);
            $table->decimal('com_tax_bhyt_percent', 5, 2)->default(1.5);
            $table->decimal('com_tax_bhtn_percent', 5, 2)->default(1);
            $table->decimal('min_salary_area',19,2)->default(0);
            // 0: Draft
            // 1: In Review
            // 2: Done
            $table->string("salary_sts", 8)->default(0);
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
