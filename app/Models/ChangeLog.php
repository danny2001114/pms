<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChangeLog extends Model
{    
    protected $table = 't_change_logs';
    protected $fillable = [
        'ref',
        'role',
        'key',
        'date',
        'count'
    ];

    protected $casts = [
        "start_date" => 'datetime'
    ];

    // ========= Ref ========= //
    public const USER = 1;
    public const TASK = 2;
    public const BUG = 3;
    public const POST = 4;
}
