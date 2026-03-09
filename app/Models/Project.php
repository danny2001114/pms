<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    
    protected $table = 'projects';
    protected $fillable = [
        'code',
        'order',
        'title',
        'description',
        'owner',
        'recipient',
        'state',
        'active',
        'type',
        'is_client',
        'start_date',
        'end_date'
    ];
}
