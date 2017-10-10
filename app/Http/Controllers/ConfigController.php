<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Setting;

class ConfigController extends Controller
{
    public function index(){
        return view('pages.dashboard.configurations.index')->with('dir', Setting::get('Server.dir'));
    }
    
    public function set(Request $request){
       $path = $request->path;
       Setting::set('Server.dir', $path);
       return redirect()->route('config.index');
    }
}
