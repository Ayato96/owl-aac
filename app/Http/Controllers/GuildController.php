<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Guild;

/**
 * Class GuildController
 * @package App\Http\Controllers
 */
class GuildController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View $guilds
     */
    public function index()
    {
        $guilds = Guild::all();
        return view('pages.guilds.index')->with('guilds', $guilds);
    }

    /**
     * @param $id
     * @return \Illuminate\View\View $guild $ranks|\Illuminate\Http\RedirectResponse
     */
    public function show($id)
    {
        $guild = Guild::find($id);
        if ($guild) {
            $ranks = $guild->rank->groupBy('name');

            return view('pages.guilds.show')
                ->with([
                    'guild' => $guild,
                    'ranks' => $ranks,
                ]);
        }
        return redirect()->route('guild.index');
    }
}
