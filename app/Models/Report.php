<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'reporter_id',
        'reported_post_id',
        'reported_user_id',
        'category',
        'description',
        'status',
    ];

    public function reporter()
    {
        return $this->belongsTo(User::class, 'reporter_id');
    }

    // Relasi ke User yang dilaporkan
    public function reportedUser()
    {
        return $this->belongsTo(User::class, 'reported_user_id');
    }

    // Relasi ke Post yang dilaporkan
    public function reportedPost()
    {
        return $this->belongsTo(Post::class, 'reported_post_id');
    }
}
