<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;
use App\Models\MstEmployeeInfo;
use App\Models\TrnLeaveAllocation;
use App\Models\TrnAbsent;

class LeaveAllocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('[Started] LeaveAllocationSeeder');

        $this->command->info('- Truncate table trn_leave_allocation');
        DB::table('trn_leave_allocation')->truncate();

        $listEmployee = MstEmployeeInfo::where('active_flg', 1)->get();
        foreach($listEmployee as $employee) {
            $this->command->info('- Employee: ' . $employee->employee_code);

            $entity = new TrnLeaveAllocation();
            $entity->employee_id = $employee->employee_id;
            
            if ($employee->start_date < '2020-01-01') {
                $entity->num_days = 12;
            } else {
                echo $employee->start_date;
                $entity->num_days = 12 - Carbon::createFromFormat('Y-m-d',$employee->start_date)->month + 1;
            }
            $entity->reason = 'Phép năm 2020';
            $entity->expired_date = '2021-06-30';

            $entity->created_by = 1;
            $entity->version_no = 1;
            $entity->updated_by = 1;
            $entity->updated_at = Carbon::now();
            $entity->save();

            $this->command->info("=> Create allocate " . $entity->id);

            // Update Trn absent
            TrnAbsent::where('user_id', $employee->employee_id)
                ->where('absent_date', '>=', '2020-01-01')
                ->where('absent_date', '<=', '2020-12-31')
                ->update([
                    'leave_allocation_id' => $entity->id
                ]);
        }

        $this->command->info('[Done] LeaveAllocationSeeder');
    }
}
