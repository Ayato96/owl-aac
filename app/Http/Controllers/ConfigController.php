<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Setting;

/**
 * Class ConfigController
 * @package App\Http\Controllers
 */
class ConfigController extends Controller
{
    /**
     * @return $this
     */
    public function index(){
        return view('dashboard.configurations.index')->with('dir', Setting::get('Server.dir'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function set(Request $request){
       $path = $request->path;
       Setting::set('Server.dir', $path);
       return redirect()->route('config.index');
    }
}
