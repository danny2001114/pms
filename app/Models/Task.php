<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    
    protected $table = 'tasks';
    protected $fillable = [
        'code',
        'project_id',
        'description',
        'priority',
        'state',
        'percentage',
        'start_date',
        'end_date'
    ];
}
