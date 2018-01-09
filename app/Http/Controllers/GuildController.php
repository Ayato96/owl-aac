<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Guild;

class GuildController extends Controller
{
    public function index(){
        $guilds = Guild::all();
        return view('pages.guilds.index')->with('guilds', $guilds);
    }

    public function show($id)
    {
        $guild = Guild::find($id);
        if ($guild) 
        {
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
