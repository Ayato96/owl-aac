<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Post;

/**
 * Class PostController
 * @package App\Http\Controllers
 */
class PostController extends Controller
{
    /**
     * PostController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    /**
     * @return $this
     */
    public function index()
    {
        $posts = Post::all();
        if ($posts->isEmpty()) {
            flash('there are no posts.')->error();
        }
        return view('pages.dashboard.posts.index')->with('posts', $posts);
    }

    /**
     * @return $this
     */
    public function create()
    {
        $players = \App\Account::loggedin()->players()->pluck('name', 'id')->toArray();
        return view('pages.dashboard.posts.create')->with('players', $players);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        Post::create($request->only(['title', 'content', 'player_id']));
        flash()->overlay('Adicionado com sucesso!');
        return redirect()->back();
    }

    /**
     * @param $id
     */
    public function show($id)
    {
        //TODO
    }

    /**
     * @param $id
     * @return \Illuminate\View\View $players
     *
     * NEED MORE WORK
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $players = \App\Account::loggedin()->players()->pluck('name', 'id')->toArray();
        return view('pages.dashboard.posts.edit')->with(['post' => $post, 'players' => $players]);
    }

    /**
     * @param $id
     */
    public function delete($id)
    {
        //TODO
    }
}
