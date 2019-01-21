<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Guild;
use App\Http\Requests\CreateGuild;

/**
 * Class GuildController
 * @package App\Http\Controllers
 */
class GuildController extends Controller
{
    /**
     * GuildController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth', ['only' => ['create', 'store']]);
        $this->middleware('checkguild', ['only' => ['create', 'store']]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View $guilds
     */
    public function index()
    {
        $guilds = Guild::all();
        if ($guilds->isEmpty()) {
            flash('There are no guilds yet.')->error();
        }
        return view('guilds.index')->with('guilds', $guilds);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $players = \App\Account::loggedin()
            ->players()
            ->where('level', '>=', env('OWL_GUILD_LEVEL'))
            ->pluck('name', 'id')
            ->toArray();
        return view('guilds.create')->with('players', $players);
    }

    /**
     * @param CreateGuild $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateGuild $request)
    {
        $data = $request->only(['name', 'ownerid', 'motd']);
        $guild = Guild::create($data);
        $guild->players()->attach($guild->id, [
            'player_id' => $request->input('ownerid'),
            'rank_id' => $guild->ranks->sortBy('id')->first()->id
        ]);
        return redirect()->route('guild.show', ['id' => $guild->id]);
    }

    /**
     * @param $id
     * @return \Illuminate\View\View $guild $ranks|\Illuminate\Http\RedirectResponse
     */
    public function show($id)
    {
        $guild = Guild::find($id);
        if ($guild) {
            $ranks = $guild->rank->sortBy('pivot.rank_id')->groupBy('name');

            return view('guilds.show')
                ->with([
                    'guild' => $guild,
                    'ranks' => $ranks,
                ]);
        }
        flash('guild does not exist.')->error();
        return redirect()->route('guild.index');
    }
}
