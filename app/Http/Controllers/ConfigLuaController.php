<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Setting;

class ConfigLuaController extends Controller
{
    /**
     * Get content of config.lua
     * @return array
     * TODO: change how get the content of config.lua without parse_ini_file
     * BUG: If have one line with comment like | -- "something" | parse_ini_file dont works
     * because the ""
     */
    public function getAll(){
        $configLua = parse_ini_file(Setting::get('Server.dir').'config.lua');
        return $configLua;
    }
}
