<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Class AdminController
 * @package App\Http\Controllers
 */
class AdminController extends Controller
{

    /**
     * AdminController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('dashboard.index');
    }
}
