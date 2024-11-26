<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    protected $guarded = [];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // relasi ke komentar balasan
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    // Relasi ke komentar induk
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }
}