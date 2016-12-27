<?php
namespace App\Http\Controllers;

use Auth;
use Illuminate\Contracts\Auth\Guard;
use App\Account;
use App\Http\Requests\login\LoginUser;

class AuthController extends Controller
{

	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
		$this->middleware('guest', ['except' => 'logout']);
	}

	public function login()
	{
		return view('auth.login');	
	}

	public function authenticate(LoginUser $request)
	{
		$credentials = $request->only(['name', 'password']);

		if (Auth::attempt($credentials))
		{
			return redirect()->intended('/');
		}

		return redirect()->back()
		->withErrors((array('message' => 'Invalid Password.')))
		->withInput();
	}

	public function logout()
	{
		Auth::logout();
		return redirect('/');
	}
}