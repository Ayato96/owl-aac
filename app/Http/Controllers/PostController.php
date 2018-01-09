<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Player;
use App\Post;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        $posts = Post::all();
        return view('pages.dashboard.posts.index')->with('posts', $posts);
    }

    public function create()
    {
    	$players = Player::all();
    	$players = $players->where('account_id', Auth::id())->pluck('name', 'id')->toArray();
    	return view('pages.dashboard.posts.create')->with('players', $players);
    }

    public function store(Request $request)
    {
		$post = Post::create($request->only(['title', 'content', 'player_id']));
        return redirect()->back();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
    	$post = Post::find($id);
    	$players = Player::all();
    	$players = $players->where('account_id', Auth::id())->pluck('name', 'id')->toArray();

		return view('pages.dashboard.posts.edit')->with(['post' => $post, 'players' => $players]);
    }

    public function delete($id)
    {
        //
    }
}
