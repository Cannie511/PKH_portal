<?php

namespace App\Http\Controllers\Mobile;

use Auth;
use Event;
use JWTAuth;
use App\Models\User;
use App\Events\AccessEvent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    /**
     * Authenticate user.
     *
     * @param Instance Request instance
     *
     * @return JSON user details and auth credentials
     */
    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        $user = User::whereEmail($credentials['email'])->first();

        if (isset($user->email_verified) && 0 == $user->email_verified) {
            return response()->error('Email Unverified');
        }

// if( $user == null || !$user->can('mobile.login') ) {
        if (null == $user) {
            return response()->error('Invalid user');
        }

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->error('Invalid credentials', 401);
            }

        } catch (\JWTException $e) {
            return response()->error('Could not create token', 500);
        }

        $agent = $request->header('User-Agent');
        $ip    = $request->ip();
        if ($request->header('X-Client') != null) {
            $ip = $request->header('X-Client');
        }

        if ($request->header('cf-connecting-ip') != null) {
            $ip = $request->header('cf-connecting-ip');
        }

        $eventParam = new AccessEvent($user->id, $ip, $agent, 'LOGIN-SP', null, $user->email);

        event($eventParam);

        $token = JWTAuth::fromUser($user);
        // $abilities = $this->getRolesAbilities();
        $userRole = [];

        foreach ($user->Roles as $role) {
            $userRole[] = $role->slug;
        }

        // return response()->success(compact('user', 'token', 'abilities', 'userRole'));

        return response()->success(compact('user', 'token', 'userRole'));
    }

}
