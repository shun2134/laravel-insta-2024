<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    private $post;

    public function __construct(Post $post)
    {
        $this->post     = $post;
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $home_posts = $this->getHomePosts();

        return view('users.home')
                ->with('home_posts', $home_posts);
    }

    # Get the posts of the users that the Auth user is following
    public function getHomePosts()
    {
        $all_posts = $this->post->latest()->get();
        $home_posts = [];

        foreach ($all_posts as $post)
        {
            if ($post->user->isFollowed() || $post->user_id === Auth::user()->id) {
                $home_posts[] = $post;
                /*
                    $home_posts = [
                        [4],
                        [2],
                        [1],
                    ];
                */
            }
        }

        return $home_posts;
    }

}
