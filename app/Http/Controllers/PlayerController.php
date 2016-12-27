<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePlayer;
use App\Http\Requests\EditPlayer;
use App\Account;
use App\Player;
use Auth;

class PlayerController extends Controller
{

	public function __construct()
	{
		$this->middleware(['auth'], ['except' => ['show', 'index']]);
	}

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

		$account = Account::find(Auth::id());
		
		$player = $account->players()->create($data);
	}

	public function show($slug)
	{
		$player = Player::whereSlug($slug)->first();
		if ($player) 
		{
			$playerAccount = Player::whereSlug($slug)->first()->account->toArray();
			return view('pages.player')->with([
				'player' => $player, 
				'playerAccount' => $playerAccount 
				]);
		}
		return redirect()->route('player.index');
	}

	public function edit($id)
	{	
        $player = Player::find($id);

        $this->authorize('update', $player);

        if (!$player) 
        {
			return redirect()->route('account.index')->with('error', 'Player not exist');	
		}

		return view('pages.players.edit')->with(compact('player'));
	}

    public function update(EditPlayer $request, $id)
    {
        Player::where('id', $id)->update($request->only(['description']));

        return redirect()->route('account.index')->with('status', 'Player edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
