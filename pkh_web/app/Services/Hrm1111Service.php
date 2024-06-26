<?php

namespace App\Services;

use DB;
use Log;
use Mail;
use Carbon\Carbon;
use App\Models\TrnCost;
use App\Models\TrnSalary;
use App\Models\TrnSalaryDetail;
use App\Services\Hrm1112Service;
use App\Services\DownloadService;
use App\Services\EmployeeService;

/**
 * Hrm1111Service class
 */
class Hrm1111Service extends BaseService
{
    /**
     * @param DownloadService $downloadService
     * @param Hrm1112Service $hrm1112Service
     */
    public function __construct(
        DownloadService $downloadService,
        Hrm1112Service $hrm1112Service,
        EmployeeService $employeeService
    ) {
        $this->downloadService = $downloadService;
        $this->hrm1112Service  = $hrm1112Service;
        $this->employeeService  = $employeeService;
    }

    /**
     * Select list
     *
     * @param [type] $params
     * @return void
     */
    public function selectById($id)
    {
        $sqlParam = array();
        $sql      = "
        select
          a.id
          , a.salary_month
          , a.from_date
          , a.to_date
          , a.total_amount
          , a.total_com_amount
          , a.total_bhxh
          , a.total_bhyt
          , a.total_bhtn
          , a.total_com_bhxh
          , a.total_com_bhyt
          , a.total_com_bhtn
          , a.tax_bhxh_percent
          , a.tax_bhyt_percent
          , a.tax_bhtn_percent
          , a.com_tax_bhxh_percent
          , a.com_tax_bhyt_percent
          , a.com_tax_bhtn_percent
          , a.salary_sts
          , a.total_days
          , a.total_hours
          , a.notes
        from
          trn_salary a
        where
          a.id = ?
        ";

// $sql .= $this->andWhereDateBetween($param, 'fromDate','toDate', 'a.changed_date', $sqlParam );

// $sql .= $this->andWhereString($param, 'product_code', 'f.product_code', $sqlParam );

// $sql .= $this->andWhereString($param, 'order_code', 'd.store_order_code', $sqlParam );

// $sql .= $this->andWhereString($param, 'store_name', 'e.name', $sqlParam );

// $sql .= $this->andWhereString($param, 'change_type', 'a.warehouse_change_type', $sqlParam, true);
        // $sql .= $this->andWhereInt($param, 'branch_id', 'a.branch_id', $sqlParam );

        $sqlParam[] = $id;
        $result     = DB::select(DB::raw($sql), $sqlParam);

        if (count($result) == 0) {
            return null;
        }

        return $result[0];
    }

    /**
     * @param $param
     */
    public function saveEntity($param)
    {

        $entity = null;

        if (0 == $param["id"]) {
            $entity = new TrnSalary();
        } else {
            $entity = TrnSalary::find($param["id"]);

            if (!isset($entity)) {
                return [
                    "rtnCd" => false,
                    "msg"   => "Không tồn tại",
                ];
            }

        }

        $entity->notes = isset($param["notes"]) ? $param["notes"] : null;

        $this->updateRecordHeader($entity, null, 0 == $param["id"]);

        $entity->save();

        return [
            "rtnCd" => true,
            "id"    => $entity->id,
            "msg"   => "Cập nhật thành công",
        ];
    }

    /**
     * @param $id
     */
    public function deleteEntity($id)
    {
        TrnSalary::where('id', $id)->delete();

        return [
            "rtnCd" => true,
            "msg"   => "Xóa thành công",
        ];
    }

    /**
     * @param $salaryId
     * @return mixed
     */
    public function selectListEmployee($salaryId)
    {
        $sqlParam = array($salaryId);
        $sql      = "
        select
          a.id
          , a.employee_id
          , a.salary_id
          , a.total_days
          , a.total_hours
          , a.overtime_hour
          , a.gross_salary
          , a.basic_salary
          , a.real_salary
          , a.overtime_salary
          , a.bonus
          , a.tax_bhxh
          , a.tax_bhyt
          , a.tax_bhtn
          , a.com_tax_bhxh
          , a.com_tax_bhyt
          , a.com_tax_bhtn
          , a.tax_pit + a.tax_pit_edit as tax_pit
          , a.minus_amount
          , a.advance
          , a.net_salary
          , a.notes
          , b.employee_code
          , b.fullname
          , b.title
          , b.devision
          , b.dob
          , b.gender
          , b.probation_start_date
          , b.probation_end_date
          , b.start_date
          , b.end_date
          , c.email 
          , b.passcode
        from
          trn_salary_detail a
          left join mst_employee_info b
            on a.employee_id = b.employee_id
          left join users c on c.id = b.employee_id 
        where a.salary_id = ?
        order by b.employee_code
        ";

        $result = DB::select(DB::raw($sql), $sqlParam);

        return $result;
    }

    /**
     * Update status of salary
     *
     * @param [Array] $param
     * + id: salary_id
     * + status: 0,1,2
     * @return void
     */
    public function updateSts($param)
    {

        $updateValues               = [];
        $updateValues["salary_sts"] = $param['status'];

        if (isset($param["notes"])) {
            $updateValues["notes"] = $param['notes'];
        }

        TrnSalary::where('id', $param["id"])
            ->update($updateValues);

        if ('2' == $param['status']) {
            // Update cost
            $salary               = TrnSalary::find($param["id"]);
            $cost                 = new TrnCost();
            $cost->cost_cat_id    = 5; // Luong nhan vien
            $cost->department_id  = 3; // HR
            $cost->cost_date      = Carbon::today();
            $cost->amount         = $salary->total_com_amount; // HR
            $cost->contra_account = '112';                     // HR
            $cost->voucher        = 'UKN';
            $cost->description    = 'CHI LƯƠNG NHÂN VIÊN ' . Carbon::createFromFormat('Y-m-d', $salary->salary_month)->format('Y-m');
            $this->updateRecordHeader($cost, null, true);
            $cost->save();
        }

        return [
            "rtnCd" => true,
        ];
    }

    /**
     * @param $id
     * @param $salary_id
     */
    public function remove(
        $id,
        $salary_id
    ) {
        $salary = TrnSalary::find($salary_id);

        if (!isset($salary)) {
            return [
                "rtnCd" => false,
                "msg"   => "Không tồn tại bảng lương",
            ];
        }

        if ('0' != $salary->salary_sts) {
            return [
                "rtnCd" => false,
                "msg"   => "Không thể cập nhật",
            ];
        }

        TrnSalaryDetail::where('id', $id)->delete();

        return [
            "rtnCd" => true,
            "msg"   => "Đã xóa thành công",
        ];
    }

    /**
     * Download excel file
     *
     * @param [type] $param
     * @return void
     */
    public function download($param)
    {
        $sheets = [];

        // Print all
        $salary       = $this->selectById($param["id"]);
        $listEmployee = $this->selectListEmployee($param["id"]);
        $sheets[] = [
            "name" => "ALL",
            "data" => [
                'salary'       => $salary,
                'listEmployee' => $listEmployee,
            ],
            "view" => "hrm1111-list",
        ];

        foreach ($listEmployee as $employee) {
            // Print child
            $childData = $this->hrm1112Service->selectById($employee->id);
            $sheets[] = [
                "name" => $employee->employee_code,
                "data" => [
                    'detail' => $childData,
                    'salary' => $salary,
                ],
                "view" => "hrm1111-detail",
            ];
        }

        $paramDownload = [
            "file_name" => "TimeTable",
            "view"      => "hrm1111",
            "sheets"    => $sheets,
        ];

        $result = $this->downloadService->downloadExcelFileMultiSheets($paramDownload);

        return $result;
    }

    /**
     * Send to all email
     *
     * @param [type] $param
     * @return void
     */
    public function sendAll($param)
    {
        $id = $param["id"];
        $salary       = $this->selectById($param["id"]);
        $listEmployee = $this->selectListEmployee($id);

        $salaryMonth = Carbon::parse($salary->salary_month)->format('Y-m');

        foreach($listEmployee as $employee) {
            // Create pdf file
            $data = [
                'salaryMonth' => $salaryMonth,
                'salary' => $salary,
                'employee' => $employee
            ];
            $fileName = "payslip-$salaryMonth-" . str_slug($employee->fullname, "_");
            $paramPdf = [
                "data"        => $data,
                "file_name"   => $fileName,
                "folder_name" => "payslip",
                "view"        => "payslip",
                "type"        => 1,
                "paper"       => 'a4',
            ];
            $pdfResult = $this->downloadService->downloadPDFFile($paramPdf);
            $pdfFullFilePath = storage_path('app' . $pdfResult["url"][0]);
            $zipFileName = $pdfFullFilePath . ".zip";

            $temp = explode("/", $pdfFullFilePath);
            $newFileName = end($temp);

            $folder = storage_path('app/pdf/payslip');
            $passCode = $this->employeeService->createPasscodeIfNotExist($employee->employee_id);
            ob_start(); 
            $cmdZip = "cd $folder && zip -P $passCode $newFileName.zip $newFileName";
            system($cmdZip);
            ob_clean(); 

            // Send mail
            $mailParam = [
                'salaryMonth' => $salaryMonth,
                'salary' => $salary,
                'employee' => $employee
            ];
    
            Mail::queue('admin.emails.payslip', ['param' => $mailParam], function ($m) use ($salaryMonth, $employee, $pdfFullFilePath, $fileName) {
                $m->from('no-reply@phankhangco.com', 'PKH Automation');
    
                $toEmail = $employee->email;
                if(env('APP_ENV') == 'local') {
                    $toEmail = 'phucuong1112@gmail.com';
                }

                $m->to($toEmail, $employee->fullname)->subject("[PhanKhangHome] Payslip $salaryMonth");
                $m->attach($pdfFullFilePath . ".zip", ['as' => $fileName . ".zip", 'mime' => "application/zip"]);
            });

            
            // TODO
            // break;
        }

        return [
            "rtnCd" => true
        ];
    }

}
