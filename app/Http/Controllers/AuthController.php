<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecoveryKey;
use Auth;
use Illuminate\Contracts\Auth\Guard;
use App\Account;
use App\Http\Requests\login\LoginUser;
use App\Http\Requests\RecoveryPassword;

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

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showKeyRequestForm()
    {
        return view('auth.key.form');
    }

    /**
     * @param RecoveryKey $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function showRecoveryForm(RecoveryKey $request)
    {
        $account = Account::where($request->only('name', 'key'))->first();
        session(['id' => $account->id]);
        if ($account)
            return view('auth.key.recovery');

        flash('Recovery key invalid.')->error()->important();
        return redirect()->back();
    }

    /**
     * @param RecoveryPassword $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resetPassword(RecoveryPassword $request)
    {
        Account::find(session('id'))->update(['password' => $request->password]);

        session()->forget('id');

        flash('password changed with success.')->success()->important();
        return redirect()->route('auth.login');
    }
}
