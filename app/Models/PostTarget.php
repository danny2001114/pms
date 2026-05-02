<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostTarget extends Model
{    
    protected $table = 't_post_targets';
    protected $fillable = [
        'target',
        'target_id',
        'by_role',
        'post_id'
    ];

    protected $casts = [
        'by_role' => 'boolean'
    ];
}
