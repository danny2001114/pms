<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    
    protected $table = 't_comments';
    protected $fillable = [
        'ref_type',
        'ref_id',
        'user_id',
        'comment'
    ];
}
