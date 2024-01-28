<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function show($id)
    {
        $user = $this->user->findOrFail($id);

        return view('users.profile.show')
                ->with('user', $user);
    }
    
    // edit() - view the Edit Profile Page
    public function edit()
    {
        $user = $this->user->findOrFail(Auth::user()->id);

        return view('users.profile.edit')
                ->with('user', $user);
    }

    // update() - save the changes of the auth user info
    public function update(Request $request)
    {
        $request->validate([
            'name'          => 'required|min:1|max:50',
            'email'         => 'required|email|max:50|unique:users,email,' . Auth::user()->id,
            'avatar'        => 'mimes:jpg,jpeg,gif,png|max:1048',
            'introduction'  => 'max:100'
        ]);

        $user               = $this->user->findOrFail(Auth::user()->id);
        $user->name         = $request->name;
        $user->email        = $request->email;
        $user->introduction = $request->introduction;

        if ($request->avatar){
            $user->avatar = 'data:image/' . $request->avatar->extension() . ';base64,' . base64_encode(file_get_contents($request->avatar));
        }

        # Save
        $user->save();

        return redirect()->route('profile.show', Auth::user()->id);
    }

}
