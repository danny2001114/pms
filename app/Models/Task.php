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

    public const PENDING = 1;
    public const DEVELOPING = 2;
    public const TESTING = 3;
    public const FIXING = 4;
    public const COMPLETED = 5;
    public const PRIORITY_LOW = 1;
    public const PRIORITY_MEDIUM = 2;
    public const PRIORITY_HIGH = 3;
}
