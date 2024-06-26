<?php

namespace App\Http\Controllers\Admin;

use DB;
use Auth;
use Hash;
use Mail;
use Input;
use Validator;
use App\Models\User;
use App\Models\MstBranch;
use Bican\Roles\Models\Role;
use Illuminate\Http\Request;
use App\Services\EmployeeService;
use Bican\Roles\Models\Permission;

class UserController extends AdminBaseController
{
    /**
     * @param EmployeeService $employeeService
     */
    public function __construct(
        EmployeeService $employeeService
    ) {
        $this->employeeService = $employeeService;
    }

    /**
     * Get user current context.
     *
     * @return JSON
     */
    public function getMe()
    {
        $user = Auth::user();

        return response()->success($user);
    }

    /**
     * Update user current context.
     *
     * @return JSON success message
     */
    public function putMe(Request $request)
    {
        $user = Auth::user();

        $this->validate($request, [
            'data.name'  => 'required|min:3',
            'data.email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $userForm = app('request')
            ->only(
                'data.current_password',
                'data.new_password',
                'data.new_password_confirmation',
                'data.name',
                'data.email'
            );

        $userForm    = $userForm['data'];
        $user->name  = $userForm['name'];
        $user->email = $userForm['email'];

        if ($request->has('data.current_password')) {
            Validator::extend('hashmatch', function (
                $attribute,
                $value,
                $parameters
            ) {
                return Hash::check($value, Auth::user()->password);
            });

            $rules = [
                'data.current_password'          => 'required|hashmatch:data.current_password',
                'data.new_password'              => 'required|min:8|confirmed',
                'data.new_password_confirmation' => 'required|min:8',
            ];

            $payload = app('request')->only('data.current_password', 'data.new_password', 'data.new_password_confirmation');

            $messages = [
                'hashmatch' => 'Invalid Password',
            ];

            $validator = app('validator')->make($payload, $rules, $messages);

            if ($validator->fails()) {
                return response()->error($validator->errors());
            } else {
                $user->password = Hash::make($userForm['new_password']);
            }

        }

        $user->save();

        return response()->success('success');
    }

    private function getListUser()
    {

        $sqlParam = array();
        $sql      = "
        select
            a.id
            , a.oauth_provider
            , a.oauth_provider_id
            , a.name
            , a.email
            , a.password
            , b.branch_name
            , IF(e.employee_id is NULL, 'FALSE', 'TRUE') as employee
            , e.employee_code
            , GROUP_CONCAT(d.name SEPARATOR ', ') role_name
        from
            users a
            left join mst_branch b
            on a.branch_id = b.branch_id
            left join role_user c
            on a.id = c.user_id
            left join roles d
            on c.role_id = d.id
            left join mst_employee_info e
            on e.employee_id = a.id
        group by
            a.id
            , a.oauth_provider
            , a.oauth_provider_id
            , a.name
            , a.email
            , a.password
            , b.branch_name
            , e.employee_id
            , e.employee_code
        order by
            id
        ";

        return DB::select(DB::raw($sql), $sqlParam);
    }

    /**
     * Get all users.
     *
     * @return JSON
     */
    public function getIndex()
    {
        // $users = User::all();
        $users = $this->getListUser();

//Log::debug('------------------check get user--------------');
        //Log::debug($users);

        return response()->success(compact('users'));
    }

    /**
     * Get user details referenced by id.
     *
     * @param int User ID
     *
     * @return JSON
     */
    public function getShow($id)
    {
        $user         = User::find($id);
        $user['role'] = $user
            ->roles()
            ->select(['slug', 'roles.id', 'roles.name'])
            ->get();

        return response()->success($user);
    }

    /**
     * Update user data.
     *
     * @return JSON success message
     */
    public function putShow(Request $request)
    {
        $userForm = array_dot(
            app('request')->only(
                'data.name',
                'data.email',
                'data.branch',
                'data.email_verified',
                'data.id'
            )
        );

        $userId = intval($userForm['data.id']);

        $user = User::find($userId);

        $this->validate($request, [
            'data.id'    => 'required|integer',
            'data.name'  => 'required|min:3',
            'data.email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $userData = [
            'name'           => $userForm['data.name'],
            'email'          => $userForm['data.email'],
            'branch_id'      => $userForm['data.branch'],
            'email_verified' => $userForm['data.email_verified'],
        ];

        $affectedRows = User::where('id', '=', $userId)->update($userData);

        $user->detachAllRoles();

        foreach (Input::get('data.role') as $setRole) {
            $user->attachRole($setRole);
        }

        return response()->success('success');
    }

    /**
     * Delete User Data.
     *
     * @return JSON success message
     */
    public function deleteUser($id)
    {

// $user = User::find($id);
        // $user->delete();
        return response()->success('success');
    }

    /**
     * Get all user roles.
     *
     * @return JSON
     */
    public function getRoles()
    {
        $roles = Role::all();

        return response()->success(compact('roles'));
        //return $roles;
    }

    public function getBranches()
    {
        $branches = MstBranch::all();

        return response()->success(compact('branches'));
        //return $branches;
    }

    /**
     * Get role details referenced by id.
     *
     * @param int Role ID
     *
     * @return JSON
     */
    public function getRolesShow($id)
    {
        $role = Role::find($id);

        $role['permissions'] = $role
            ->permissions()
            ->select(['permissions.name', 'permissions.id', 'permissions.description'])
            ->get();

        return response()->success($role);
    }

    /**
     * Update role data and assign permission.
     *
     * @return JSON success message
     */
    public function putRolesShow()
    {
        $roleForm = Input::get('data');
        $roleData = [
            'name'        => $roleForm['name'],
            'slug'        => $roleForm['slug'],
            'description' => $roleForm['description'],
        ];

        $roleForm['slug'] = str_slug($roleForm['slug'], '.');
        $affectedRows     = Role::where('id', '=', intval($roleForm['id']))->update($roleData);
        $role             = Role::find($roleForm['id']);

        $role->detachAllPermissions();

        foreach (Input::get('data.permissions') as $setPermission) {
            $role->attachPermission($setPermission);
        }

        return response()->success('success');
    }

    /**
     * Create new user role.
     *
     * @return JSON
     */
    public function postRoles()
    {
        $role = Role::create([
            'name'        => Input::get('role'),
            'slug'        => str_slug(Input::get('slug'), '.'),
            'description' => Input::get('description'),
        ]);

        return response()->success(compact('role'));
    }

    /**
     * Delete user role referenced by id.
     *
     * @param int Role ID
     *
     * @return JSON
     */
    public function deleteRoles($id)
    {
        Role::destroy($id);

        return response()->success('success');
    }

    /**
     * Get all system permissions.
     *
     * @return JSON
     */
    public function getPermissions()
    {
        $permissions = Permission::all();

        return response()->success(compact('permissions'));
    }

    /**
     * Create new system permission.
     *
     * @return JSON
     */
    public function postPermissions()
    {
        $permission = Permission::create([
            'name'        => Input::get('name'),
            'slug'        => str_slug(Input::get('slug'), '.'),
            'description' => Input::get('description'),
        ]);

        return response()->success(compact('permission'));
    }

    /**
     * Get system permission referenced by id.
     *
     * @param int Permission ID
     *
     * @return JSON
     */
    public function getPermissionsShow($id)
    {
        $permission = Permission::find($id);

        return response()->success($permission);
    }

    /**
     * Update system permission.
     *
     * @return JSON
     */
    public function putPermissionsShow()
    {
        $permissionForm         = Input::get('data');
        $permissionForm['slug'] = str_slug($permissionForm['slug'], '.');
        $affectedRows           = Permission::where('id', '=', intval($permissionForm['id']))->update($permissionForm);

        return response()->success($permissionForm);
    }

    /**
     * Delete system permission referenced by id.
     *
     * @param int Permission ID
     *
     * @return JSON
     */
    public function deletePermissions($id)
    {
        Permission::destroy($id);

        return response()->success('success');
    }

    /**
     * Reset password for user
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function postResetPass()
    {

        $userId = intval(Input::get('id'));
        $user   = User::find($userId);

        if (isset($user)) {
            $newPassword    = str_random(8);
            $user->password = bcrypt($newPassword);
            $user->save();

            $loginUrl = '';

            if ($user->is('customer')) {
                $loginUrl = 'http://customer.phankhangco.com/';
            } elseif ($user->is('supplier')) {
                $loginUrl = 'http://supplier.phankhangco.com/';
            } else {
                $loginUrl = 'http://portal.phankhangco.com/';
            }

            $mailParam = [
                'user'        => $user,
                'loginUrl'    => $loginUrl,
                'newPassword' => $newPassword,
            ];

            Mail::queue('admin.emails.reset_password', ['param' => $mailParam], function ($m) use ($user) {
                $m->from('no-reply@phankhangco.com', 'PKH Automation');

                //$m->to(env('MAIL_ORDER_TO', $user->email), '[PKH-SYSTEM]')->subject('[PhanKhangHome] Mat khau cua ban da duoc thiet lap lai. ' . date('Y-m-d H:i:s'));
                $m->to($user->email, '[PKH-SYSTEM]')->subject('[PhanKhangHome] Mat khau cua ban da duoc thiet lap lai. ' . date('Y-m-d H:i:s'));
                $m->to('cuong.nguyen@phankhangco.com', '[PKH-SYSTEM]')->subject('[PhanKhangHome] Mat khau cua ban da duoc thiet lap lai. ' . date('Y-m-d H:i:s'));
            });
        }

        return response()->success('success');
    }

    public function postCreateEmployee()
    {
        $result = $this->employeeService->createEmployeeFromUserId(intval(Input::get('id')));

        return response()->success($result);
    }

}
