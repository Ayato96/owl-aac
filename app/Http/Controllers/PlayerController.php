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
		return view('pages.players.index');
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

	public function createPlayer(CreatePlayer $request)
	{
		$data = $request->only(['name', 'vocation', 'sex', 'town_id']); 

		$account = Account::find(Auth::user()->id);
		
		$player = $account->players()->create($data);
	}

	public function show($slug)
	{
		$player = Player::whereSlug($slug)->first();
		if ($player) {
			$playerAccount = Player::whereSlug($slug)->first()->user->toArray();
			return view('pages.player')->with([
				'player' => $player, 
				'playerAccount' => $playerAccount 
				]);
		}
		return redirect()->route('player.index');
		
	}

	public function edit($id)
	{

	}

	public function update()
	{

	}

	public function delete()
	{

	}

}
