<?php namespace App\Services;

class AuthService extends BaseService
{
    /**
     * @param $permission
     * @return mixed
     */
    public function can($permission)
    {
        $user = $this->logonUser();

        if (isset($user)) {
            return $user->can($permission);
        }

        return false;
    }

}
