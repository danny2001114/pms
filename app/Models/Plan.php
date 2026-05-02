<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'order',
        'remark',
        'task_id',
        'highlight',
        'status',
        'date'
    ];

    protected $casts = [
        'highlight' => 'boolean',
        'status' => 'boolean',
        'date' => 'date'
    ];
}
