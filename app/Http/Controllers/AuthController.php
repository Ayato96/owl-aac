<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Contracts\Auth\Guard;
use App\Account;
use App\Http\Requests\login\LoginUser;

/**
 * Class AuthController
 * @package App\Http\Controllers
 */
class AuthController extends Controller
{

    /**
     * AuthController constructor.
     * @param Guard $auth
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function login()
    {
        return view('auth.login');
    }

    /**
     * @param LoginUser $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function authenticate(LoginUser $request)
    {
        $credentials = $request->only(['name', 'password']);

        if (Auth::attempt($credentials)) {
            return redirect()->intended(route('account.index'));
        }
        return redirect()->back()
            ->withErrors((array('message' => 'Invalid Password.')))
            ->withInput();
    }

    /**
     * @return \Illuminate\Routing\Redirector
     */
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
