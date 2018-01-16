<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreatePlayer;
use App\Http\Requests\EditPlayer;
use App\Account;
use App\Player;

/**
 * Class PlayerController
 * @package App\Http\Controllers
 */
class PlayerController extends Controller
{
    /**
     * PlayerController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth'], ['except' => ['show', 'index', 'search']]);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('pages.players.search');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {
        if (Account::loggedin()->players->count() >= env('OWL_MAX_ACCOUNT_PLAYERS')) {
            flash("You've already reached the limit of character creation.")
                ->error()
                ->important();
            return redirect()->back();
        }
        return view('pages.players.create');
    }

    /**
     * @param CreatePlayer $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreatePlayer $request)
    {
        $data = $request->only(['name', 'vocation', 'sex', 'town_id']);
        Account::loggedin()->players()->create($data);
        flash('Character created successfully.')->success()->important();
        return redirect('account');
    }

    /**
     * @param $name
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function show($name)
    {
        $player = Player::whereName($name)->first();
        if ($player) {
            return view('pages.players.show')->with([
                'player' => $player,
            ]);
        }
        return redirect()->route('player.index');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function search(Request $request)
    {
        $name = ucwords(strtolower($request->name));
        $player = Player::whereName($name)->first();
        if ($player) {
            return redirect()->route('player.show', [$player->name]);
        }
        flash('Player not found')->error();
        return redirect()->route('player.index');
    }

    /**
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit($id)
    {
        $player = Player::find($id);
        if (!$player) {
            flash('Player not exist.')->error();
            return redirect()->route('account.index');
        }
        $this->authorize('update', $player);
        return view('pages.players.edit')->with(compact('player'));
    }

    /**
     * @param EditPlayer $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(EditPlayer $request, $id)
    {
        Player::where('id', $id)->update($request->only(['description']));
        flash('character edited successfully.')->success();
        return redirect()->route('account.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy($id)
    {
        $player = Player::find($id);
        if (!$player) {
            flash('Player not exist.')->error();
            return redirect()->route('account.index');
        }
        $this->authorize('delete', $player);
        $player->delete();
        flash('Character deleted.')->success()->important();
        return redirect()->back();
    }

}
