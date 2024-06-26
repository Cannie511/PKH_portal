<?php namespace App\Services\Request;

use Mail;
use App\Services\BaseService;

class RequestService extends BaseService
{
    /**
     * @var string
     */
    protected $emailsFrom = 'no-reply@phankhangco.com';
    /**
     * @var array
     */
    protected $emailsTo = ['anh.phan@phankhangco.com', 'chien.phan@phankhangco.com'];

    /**
     * @var array
     */
    protected $messes = [
        'Tồn tại request chưa xử lý không thể tạo thêm.',
        'Request này đã được accept.',
    ];
    /**
     * @request_type:
     * + 1: Cancel order.
     * + 2: Cancel delivery.
     * + 3: Cancel remain order.
     * + 4:  Nhập nhà máy
     * + 5: Nhập bảo hành
     * + 6: Nhập trả lại
     * + 7: Cancel export - import warehouse.
     */

    /**
     * @param $param
     */
    protected function sendMail($param)
    {
        $content = $param["content"];
        $subject = $param["subject"];

        Mail::queue('admin.emails.request_edit', ['param' => $content], function ($m) use ($subject) {
            $m->from($this->emailsFrom, 'PKH Automation');
            $m->to($this->emailsTo, '[PKH-PORTAL]')->subject($subject);
        });

    }
}
