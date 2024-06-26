<?php

namespace App\Http\Controllers\Mobile;

use JWTAuth;
use Dingo\Api\Http\Request;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Dingo\Api\Exception\ValidationHttpException;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class MobileBaseController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    /**
     * @var string
     */
    protected $viewFolder = "mobile.";

/*Fixes dingo/api form request validation https://github.com/dingo/api/wiki/Errors-And-Error-Responses#form-requests*/
    /**
     * @param Request $request
     * @param array $rules
     * @param array $messages
     * @param array $customAttributes
     */
    public function validate(
        Request $request,
        array $rules,
        array $messages = [],
        array $customAttributes = []
    ) {
        $validator = $this->getValidationFactory()->make($request->all(), $rules, $messages, $customAttributes);

        if ($validator->fails()) {
            throw new ValidationHttpException($validator->errors());
        }

    }

    /**
     * Get current login user
     *
     * @return User $user
     */
    protected function logonUser()
    {
        $user = null;

        try {
            $user = JWTAuth::toUser();
        } catch (Exception $e) {
            Log::warn($e->message);
        }

        return $user;
    }

    /**
     * @param $perm
     * @param $all
     */
    protected function requirePermission(
        $perm,
        $all = false
    ) {
        $user = $this->logonUser();
        if (!isset($user) || !$user->can($perm, $all)) {
            abort(403);
        }

        return true;
    }

    /**
     * @param $request
     * @return mixed
     */
    protected function getIp(HttpRequest $request)
    {
        $ip = $request->ip();

        if ($request->header('X-Client') != null) {
            $ip = $request->header('X-Client');
        }

        if ($request->header('cf-connecting-ip') != null) {
            $ip = $request->header('cf-connecting-ip');
        }

        return $ip;
    }

}
