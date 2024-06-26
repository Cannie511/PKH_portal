<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Models\BaseTableTrait;

class CreateTrnSalaryDetail extends Migration
{
    use BaseTableTrait;

    const TABLE_NAME = "trn_salary_detail";
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('employee_id');
            $table->integer('salary_id');

            $table->integer("total_days")->default(0);
            $table->integer("total_hours")->default(0);
            $table->integer("count_dependent_person")->default(0);
            $table->decimal('overtime_hour',19,2)->default(0);

            //  Mức lương 
            $table->decimal('gross_salary',19,2)->default(0);
            // Lương CB tính BH
            $table->decimal('basic_salary',19,2)->default(0);
            // Lương thực tế theo ngày LV
            $table->decimal('real_salary',19,2)->default(0);
            // Tăng ca
            $table->decimal('overtime_salary',19,2)->default(0);
            // Thưởng + Hoa Hồng
            $table->decimal('bonus',19,2)->default(0);

            // "BHXH 8%"
            $table->decimal('tax_bhxh',19,2)->default(0);
            // "BHYT 1.5%"
            $table->decimal('tax_bhyt',19,2)->default(0);
            // BHTN 1%
            $table->decimal('tax_bhtn',19,2)->default(0);
            // Thuế TNCN
            $table->decimal('tax_pit',19,2)->default(0);
            $table->decimal('tax_pit_edit',19,2)->default(0);
            // Các khoản trừ khác (Phạt)
            $table->decimal('minus_amount',19,2)->default(0);
            // Tạm ứng
            $table->decimal('advance',19,2)->default(0);

            // Lương thực nhận
            $table->decimal('net_salary',19,2)->default(0);

            // "BHXH 17.5%"
            $table->decimal('com_tax_bhxh',19,2)->default(0);
            // "BHYT 3%"
            $table->decimal('com_tax_bhyt',19,2)->default(0);
            // BHTN 1%
            $table->decimal('com_tax_bhtn',19,2)->default(0);

            $table->text('notes')->nullable();

            $this->addRecordHeader($table);

            $table->index(['employee_id', 'salary_id']);
            $table->unique(['employee_id', 'salary_id']);
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
