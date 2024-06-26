<?php

namespace App\Services;

use DB;
use Mail;
use Carbon\Carbon;
use App\Models\MstEmployeeInfo;
use App\Models\User;

/**
 * EmployeeService class
 */
class EmployeeService extends BaseService
{
    /**
     * @param $id
     */
    public function createEmployeeFromUserId($id)
    {
        $entity              = new MstEmployeeInfo();
        $entity->employee_id = $id;
        $entity->dob         = Carbon::today();

        $logonUser = $this->logonUser();
        $this->updateRecordHeader($entity, $logonUser, true);

        if ($entity->save()) {
            return [
                'rtnCd' => true,
                'msg'   => "Tạo nhân viên thành công $id",
            ];
        }

        return [
            'rtnCd' => false,
            'msg'   => "Tạo nhân viên không thành công $id",
        ];
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getEmployeeInfo($id)
    {
        $sqlParam = [];
        $sql      = "
        select
          a.employee_id
          , a.employee_code
          , a.fullname
          , a.title
          , a.devision
          , a.dob
          , a.address_permernance
          , a.address_contact
          , a.card_id
          , a.card_id_issue_on
          , a.card_id_issue_at
          , a.tax_number
          , a.home_phone
          , a.tel1
          , a.tel2
          , a.nationality
          , a.marital_sts
          , a.gender
          , a.probation_start_date
          , a.probation_end_date
          , a.count_dependent_person
          , a.start_date
          , a.end_date
          , a.notes
          , b.email
        from
          mst_employee_info a
        left join users b on a.employee_id = b.id
        where
          a.employee_id = ?
        limit
          1
      ";

        $sqlParam[] = $id;

        $list = DB::select(DB::raw($sql), $sqlParam);

        if (count($list) == 0) {
            return null;
        }

        return $list[0];
    }

    /**
     * @return mixed
     */
    public function getDropdownEmployee()
    {
        $sqlParam = [];
        $sql      = "
        select
          a.employee_id
          , a.employee_code
          , a.fullname
          , b.email
          , COALESCE(concat('[', SUBSTRING(a.employee_code, 1,6) ,'] ',a.fullname), b.email) display
        from
          mst_employee_info a
          left join users b
            on a.employee_id = b.id
        where a.active_flg = 1
        order by a.employee_code
        ";

        $list = DB::select(DB::raw($sql), $sqlParam);

        return $list;
    }

    /**
     * Send pass code to employee. Create a new one if not exists.
     *
     * @param [Number] $employeeId
     * @return void
     */
    public function sendCode($employeeId) {
      $employee = MstEmployeeInfo::find($employeeId);
      if (empty($employee)) {
        return [
          "rtnCd" => false,
          "msg"   => "Không tìm thấy nhân viên",
        ];
      }

      // Create pass code 
      if (empty($employee->passcode)) {
        $employee->passcode = str_random(12);
        $employee->save();
      }

      // Load user
      $user = User::find($employeeId);

      // Send mail
      $mailParam = [
        'employee'       => $employee,
        'user'        => $user,
      ];

      Mail::queue('admin.emails.notice_passcode', ['param' => $mailParam], function ($m) use ($employee, $user) {
          $m->from('no-reply@phankhangco.com', 'PKH Automation');

          $toEmail = $user->email;
          if(env('APP_ENV') == 'local') {
            $toEmail = 'phucuong1112@gmail.com';
          }

          $m->to($toEmail, '[PKH-SYSTEM]')
            ->bcc(env('MAIL_ADMIN', 'it@phankhangco.com'))
            ->subject('[PhanKhangHome] Thông báo mật khẩu bảng lương. ' . date('Y-m-d H:i:s'));
      });

      return [
        "rtnCd" => true,
        "msg"   => "Đã gửi thành công",
      ];
    }

    public function createPasscodeIfNotExist($employeeId) {
      $employee = MstEmployeeInfo::find($employeeId);
      if (empty($employee)) {
        return null;
      }

      // Create pass code 
      if (empty($employee->passcode)) {
        $employee->passcode = str_random(12);
        $employee->save();

        // Load user
        $user = User::find($employeeId);

        // Send mail
        $mailParam = [
          'employee'       => $employee,
          'user'        => $user,
        ];

        Mail::queue('admin.emails.notice_passcode', ['param' => $mailParam], function ($m) use ($employee, $user) {
            $m->from('no-reply@phankhangco.com', 'PKH Automation');

            $toEmail = $user->email;
            if(env('APP_ENV') == 'local') {
              $toEmail = 'phucuong1112@gmail.com';
            }

            $m->to($toEmail, '[PKH-SYSTEM]')
              ->bcc(env('MAIL_ADMIN', 'it@phankhangco.com'))
              ->subject('[PhanKhangHome] Thông báo mật khẩu bảng lương. ' . date('Y-m-d H:i:s'));
        });
      }

      return $employee->passcode;
    }

}
