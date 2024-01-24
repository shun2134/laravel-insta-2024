<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
