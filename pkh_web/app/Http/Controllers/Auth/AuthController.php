<?php

namespace App\Http\Controllers\Auth;

use Log;
use Auth;
use Mail;
use Event;
use JWTAuth;
use Socialite;
use App\Models\User;
use App\Events\AccessEvent;
use Bican\Roles\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    /**
     * Get all roles and their corresponding permissions.
     *
     * @return array
     */
    private function getRolesAbilities()
    {
        $abilities = [];
        $roles     = Role::all();

        foreach ($roles as $role) {

            if (!empty($role->slug)) {
                $abilities[$role->slug] = [];
                $rolePermission         = $role->permissions()->get();

                foreach ($rolePermission as $permission) {

                    if (!empty($permission->slug)) {
                        array_push($abilities[$role->slug], $permission->slug);
                    }

                }

            }

        }

        return $abilities;
    }

    /**
     * Get authenticated user details and auth credentials.
     *
     * @return JSON
     */
    public function getAuthenticatedUser()
    {

        if (Auth::check()) {
            $user      = Auth::user();
            $token     = JWTAuth::fromUser($user);
            $abilities = $this->getRolesAbilities();
            $userRole  = [];

            return response()->success(compact('user', 'token', 'abilities', 'userRole'));
        } else {
            return response()->error('unauthorized', 401);
        }

    }

    /**
     * Redirect the user to the Oauth Provider authentication page.
     *
     * @param string oauth provider
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from Oauth Provider.
     *
     * @param string oauth provider
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        try {
            $user = Socialite::driver($provider)->user();
        } catch (Exception $e) {
            return Redirect::to('auth/' . $provider);
        }

        $authUser = $this->findOrCreateUser($user, $provider);

        \Auth::login($authUser, true);

        return \Redirect::to('/#/login-loader');
    }

    /**
     * Create user based from details provided by oauth providers.
     *
     * @param object user data provided by provider
     * @param object oauth provider instance
     *
     * @return Response
     */
    private function findOrCreateUser(
        $oauthUser,
        $provider
    ) {

        if ($authUser = User::where('oauth_provider_id', $oauthUser->getId())->where('oauth_provider', '=', $provider)->first()) {
            return $authUser;
        }

        return User::create([
            'name'              => $oauthUser->name,
            'email'             => $oauthUser->email,
            'oauth_provider'    => $provider,
            'oauth_provider_id' => $oauthUser->getId(),
            'avatar'            => $oauthUser->avatar,
        ]);
    }

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

        // if (env('APP_ENV', '') != 'local') {
        //     $checkRole = 'none';
        //     $host      = $request->getHost();

        //     if (env('DOMAIN_ADMIN') == $host) {
        //         $checkRole = 'domain.portal';
        //     } elseif (env('DOMAIN_CUSTOMER') == $host) {
        //         $checkRole = 'domain.customer';
        //     } elseif (env('DOMAIN_SUPPLIER') == $host) {
        //         $checkRole = 'domain.supplier';
        //     }

        //     if (null == $user || !$user->can($checkRole)) {
        //         return response()->error('Invalid user');
        //     }

        // } else {

        //     if (null == $user) {
        //         return response()->error('Invalid user');
        //     }

        // }

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

        $agent      = $request->header('User-Agent');
        $ip         = $this->getIp($request);
        $eventParam = new AccessEvent($user->id, $ip, $agent, 'LOGIN', null, $user->email);

        event($eventParam);

        $token     = JWTAuth::fromUser($user);
        $abilities = $this->getRolesAbilities();
        $userRole  = [];

        foreach ($user->Roles as $role) {
            $userRole[] = $role->slug;
        }

        return response()->success(compact('user', 'token', 'abilities', 'userRole'));
    }

    /**
     * @param Request $request
     */
    public function postLogout(Request $request)
    {
        $user = null;

        try {
            $user = JWTAuth::toUser();
        } catch (Exception $e) {
            Log::warn($e->message);
        }

        if (null != $user) {
            $agent      = $request->header('User-Agent');
            $ip         = $this->getIp($request);
            $eventParam = new AccessEvent($user->id, $ip, $agent, 'LOGOUT', null, $user->email);
            event($eventParam);
        }

    }

    /**
     * @param $verificationCode
     */
    public function verifyUserEmail($verificationCode)
    {
        $user = User::whereEmailVerificationCode($verificationCode)->first();

        if (!$user) {
            return redirect('/#/userverification/failed');
        }

        $user->email_verified = 1;
        $user->save();

        return redirect('/#/userverification/success');
    }

    /**
     * Create new user.
     *
     * @param Instance Request instance
     *
     * @return JSON user details and auth credentials
     */
    public function postRegister(Request $request)
    {
        $this->validate($request, [
            'name'     => 'required|min:3',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);

        $verificationCode              = str_random(40);
        $user                          = new User();
        $user->name                    = trim($request->name);
        $user->email                   = trim(strtolower($request->email));
        $user->password                = bcrypt($request->password);
        $user->email_verification_code = $verificationCode;
        $user->save();

        $token = JWTAuth::fromUser($user);

        Mail::send('emails.userverification', ['verificationCode' => $verificationCode], function ($m) use ($request) {
            $m->to($request->email, 'test')->subject('Email Confirmation');
        });

        return response()->success(compact('user', 'token'));
    }

    /**
     * @param $request
     * @return mixed
     */
    private function getIp($request)
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

    /**
     * @param Request $request
     */
    public function getHeader(Request $request)
    {
        $headers = getallheaders();

        return response()->success($headers);
    }

}
