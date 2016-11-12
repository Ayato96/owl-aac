<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePlayer;
use App\Account;
use App\Player;
use Auth;

class PlayerController extends Controller
{
	public function index()
	{
		
	}

	public function create()
	{
		return view('pages.createcharacter');
	}

	public function store(CreatePlayer $request)
	{
		$this->createPlayer($request);
		return redirect('account');
	}

	public function update()
	{

	}

	public function delete()
	{

	}

	public function createPlayer(CreatePlayer $request)
	{
		$data = $request->only(['name', 'vocation', 'sex', 'town_id']); 

		$account = Account::find(Auth::user()->id);
		
		$player = $account->players()->create($data);
	}
}
