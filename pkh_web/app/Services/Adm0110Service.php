<?php

namespace App\Services;

use Mail;
use App\Models\User;

class Adm0110Service extends BaseService
{
    /**
     * @param $user
     * @param $info
     * @return mixed
     */
    public function createUser(
        $user,
        $info
    ) {

        $entityUser = null;
        // Create
        $entityUser = new User();

        if (isset($info['name'])) {
            $entityUser->name = $info['name'];
        }

        if (isset($info['email'])) {
            $entityUser->email = $info['email'];
        }

        // create password
        $newPassword          = str_random(8);
        $entityUser->password = bcrypt($newPassword);

        $this->updateRecordHeader($entityUser, $user, true);
        $entityUser->save();

        //send mail
        $loginUrl = 'http://portal.phankhangco.com/';

        $mailParam = [
            'user'        => $entityUser,
            'loginUrl'    => $loginUrl,
            'newPassword' => $newPassword,
        ];

        Mail::queue('admin.emails.reset_password', ['param' => $mailParam], function ($m) use ($entityUser) {
            $m->from('no-reply@phankhangco.com', 'PKH Automation');

            $m->to($entityUser->email, '[PKH-SYSTEM]')->subject('[PhanKhangHome] Tài khoản đã được tạo. ' . date('Y-m-d H:i:s'));
        });

        return $entityUser->id;
    }

}
