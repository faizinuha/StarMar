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
}
