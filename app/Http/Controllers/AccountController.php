<?php

namespace App\Http\Controllers;

use Auth;
use Hash;
use App\Http\Requests\CreateAccount;
use App\Http\Requests\ChangePassword;
use App\Account;
use App\Player;

/**
 * Class AccountController
 * @package App\Http\Controllers
 */
class AccountController extends Controller
{

    /**
     * AccountController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => array('create', 'store')]);
    }

    /**
     * @return \Illuminate\View\View $players
     */
    public function index()
    {
        $players = Account::loggedin()->players;
        return view('pages.account.index')->with('players', $players);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('pages.account.create');
    }

    /**
     * @param CreateAccount $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateAccount $request)
    {
        Account::create($request->only(['name', 'email', 'password']));
        flash('Account created successfully.')->success();
        return redirect()->route('auth.login');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function changePassword()
    {
        return view('pages.account.password.edit');
    }

    /**
     * @param ChangePassword $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(ChangePassword $request)
    {
        Account::loggedin()->update(['password' => $request->new_password]);
        flash('Password changed.')->success();
        return redirect()->route('account.index');
    }

}
