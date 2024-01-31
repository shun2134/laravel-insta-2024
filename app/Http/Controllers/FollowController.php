<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    private $follow;

    public function __construct(Follow $follow)
    {
        $this->follow = $follow;
    }

    // store() - follow - save the follower_id(Auth user id) and following_id(Auth user wants to follow)
    public function store($user_id)
    {
        $this->follow->follower_id  = Auth::user()->id;
        $this->follow->following_id = $user_id;
        $this->follow->save();

        return redirect()->back();
    }

    // destroy() - unfollow - delete the record follower_id(Auth user id) and following_id(Auth user is following)
    public function destroy($user_id)
    {
        $this->follow
            ->where('follower_id', Auth::user()->id)
            ->where('following_id', $user_id)
            ->delete();

        return redirect()->back();

    }

}
