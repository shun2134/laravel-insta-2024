<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use HasFactory;

    # One to Many (inverse)
    # Post belongs to a user
    # To get the owner / user of the post
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    # One to Many
    # Post has many Categories
    # To get all the categories under a post but only the IDs
    public function categoryPost()
    {
        return $this->hasMany(CategoryPost::class);
    }

    # To get all the comments of a post
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    # To get all the likes of a post
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    # Returns TRUE if the Auth user already liked the post
    public function isLiked()
    {
        return $this->likes()->where('user_id', Auth::user()->id)->exists();
    }

}
