<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    # To get all the posts of a user
    public function posts()
    {
        return $this->hasMany(Post::class)->latest();
    }

    # To get all the followers of a user, but only the IDs
    public function followers()
    {
        return $this->hasMany(Follow::class, 'following_id');
    }

    # To get all the users that the user is following, but only the IDs
    public function following()
    {
        return $this->hasMany(Follow::class, 'follower_id');
    }

    # Return true if the Auth user already following the user
    public function isFollowed()
    {
        return $this->followers()->where('follower_id', Auth::user()->id)->exists();
    }

}
