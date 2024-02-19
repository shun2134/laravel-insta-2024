<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    private $post;
    private $user;

    public function __construct(Post $post, User $user)
    {
        $this->post     = $post;
        $this->user     = $user;
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
        $home_posts      = $this->getHomePosts();
        $suggested_users = $this->getSuggestedUsers();

        return view('users.home')
                ->with('home_posts', $home_posts)
                ->with('suggested_users', $suggested_users);
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

    // getSuggestedUsers() - Get the users that the Auth user is not following
    private function getSuggestedUsers()
    {
        $all_users = $this->user->all()->except(Auth::user()->id);
        $suggested_users = [];

        foreach ($all_users as $user){
            if(!$user->isFollowed()){
                $suggested_users[] = $user;
                /*
                    $suggested_users = [
                        [4],
                        [5],
                        [6],
                        up to
                        [10]
                    ];
                */
            }
        }

        return array_slice($suggested_users, 0, 5);
        // array_slice(x, y, z)
        // x -- array name
        // y -- offset/starting index
        // z -- length/how many
    }

    public function suggestions()
    {
        $all_users = $this->user->all()->except(Auth::user()->id);
        $suggested_users = [];

        foreach($all_users as $user){
            if(!$user->isFollowed()){
                $suggested_users[] = $user;
            }
        }

        return view('users.suggestions')
                ->with('suggested_users', $suggested_users);
    }

    public function search(Request $request)
    {
        $users = $this->user->withTrashed()->where('name', 'like', '%' . $request->search . '%')->get();

        return view('users.search')
                ->with('users', $users)
                ->with('search', $request->search);
    }
    
}
