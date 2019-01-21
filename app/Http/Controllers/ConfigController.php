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
    public function index()
    {
        return view('dashboard.configurations.index')->with('path', Setting::get('server.path'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function setPath(Request $request)
    {
        $path = $request->path;
        Setting::set('server.path', $path);
        return redirect()->route('config.index');
    }
}
