<?php

namespace App\Http\Controllers;

use Auth;
use Hash;
use App\Http\Requests\CreateAccount;
use App\Http\Requests\ChangePassword;
use App\Account;
use Illuminate\Support\Str;

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
        $account = Account::loggedin();
        $players = $account->players;
        return view('account.index')
            ->with([
                'account' => $account,
                'players' => $players
            ]);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('account.create');
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
        return view('account.password.edit');
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

    public function showKey()
    {
        if (Account::loggedin()->key) {
            flash('Key has already been generated.')->error()->important();
            return redirect()->back();
        }

        $key = $this->keyGenerate();
        Account::loggedin()->update(['key' => $key]);
        return view('account.key')->with('key', $key);
    }

    public function keyGenerate()
    {
        $key = Str::random(20);
        $account = Account::where('key', $key)->first();
        if ($account)
            $this->keyGenerate();
        else
            return $key;

    }


}
