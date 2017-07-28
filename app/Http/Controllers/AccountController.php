<?php

namespace App\Http\Controllers;

use Auth;
use Hash;
use App\Http\Requests\CreateAccount;
use App\Http\Requests\ChangePassword;
use App\Account;
use App\Player;

class AccountController extends Controller
{
    /**
     * Defines Middleware, who have permission to acess this controller
     * Only logged in is necessary
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => array('create', 'store')]);
    }

    /**
     * Index of Account Management
     * @return view resources/views/pages/accountManager.blade.php
     */
    public function index()
    {
        $players = Account::loggedin()->players;
        return view('pages.accountManager')->with('players', $players);
    }

    /**
     * page of Create Account
     * @return view resources/views/pages/accountManager.blade.php
     */
    public function create()
    {
        return view('auth.register');   
    }

    /**
     * Create an Account
     * @param  CreateAccount          App/Http/Requests/CreateAccount
     * @param  CreateAccount $request Form data
     * @return redirect               redirect to route auth.login
     */
    public function store(CreateAccount $request)
    {
        Account::create($request->only(['name', 'email', 'password']));
        return redirect()->route('auth.login');
    }

    /**
     * page of Change Password
     * @return view resources/views/pages/account/changePassword.blade.php
     */
    public function changePassword()
    {
        return view('pages.account.changePassword');
    }

    public function updatePassword(ChangePassword $request)
    {          
        Account::loggedin()->update(['password' => $request->new_password]);
        return redirect()->route('account.index')->with('status', 'Password changed!');
    }

}
