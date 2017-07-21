<?php

namespace App\Http\Controllers;

use Auth;
use App\Http\Requests\CreateAccount;
use App\Account;
use App\Player;

class AccountController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth', ['except' => array('create', 'store')]);
	}
	
	public function index()
	{
		$players = Account::find(Auth::user()->id)->players;

		return view('pages.accountManager')->with('players', $players);
	}

	public function create()
	{
		return view('auth.register');	
	}

	public function store(CreateAccount $request)
	{	
		$this->createAccount($request);
		return redirect()->route('auth.login');
	}

	public function createAccount(CreateAccount $request)
	{
		$data = $request->only(['name', 'email', 'password']);
		$account = Account::create($data);
	}
}
