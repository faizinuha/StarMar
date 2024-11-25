<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'content', 'image'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function hashtags()
    {
        return $this->belongsToMany(Hashtag::class, 'hashtag_post');
    }
    public function likedByUsers()
    {
        return $this->belongsToMany(User::class, 'post_user_like')->withTimestamps();
    }
}