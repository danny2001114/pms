<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    protected $table = 't_configurations';
    protected $fillable = [
        'key',
        'type',
        'value',
        'updated_by'
    ];

    // ========= Types ========= //
    public const TEXT = 1;
    public const NUM = 2;
    public const BOOL = 3;
}
