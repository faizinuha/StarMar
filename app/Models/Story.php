<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    protected $table = 'stories';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
