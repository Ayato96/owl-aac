<?php

namespace App\Http\Controllers;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * Display a home page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = \App\Post::all()->reverse();
        if ($posts->isEmpty()) {
            flash('There are no posts.')->error();
        }
        return view('home.index')->with('posts', $posts);
    }

}
