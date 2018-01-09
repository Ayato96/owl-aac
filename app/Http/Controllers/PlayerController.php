<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreatePlayer;
use App\Http\Requests\EditPlayer;
use App\Account;
use App\Player;

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
		return view('pages.createCharacter');
	}

	public function store(CreatePlayer $request)
	{
		$data = $request->only(['name', 'vocation', 'sex', 'town_id']);
        Account::loggedin()->players()->create($data);
		return redirect('account');
	}

	public function show($name)
	{
		$player = Player::whereName($name)->first();
		if ($player)
		{
			return view('pages.player')->with([
				'player' => $player,
				]);
		}
		return redirect()->route('player.index');
	}

    public function search(Request $request)
    {
        $name = ucwords(strtolower($request->name));
        $player = Player::whereName($name)->first();
        if ($player) {
            return redirect()->route('player.show', [$player->name]);
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
