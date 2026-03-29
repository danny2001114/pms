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
    public const INACTIVE = 0;
    public const ACTIVE = 1;
    public const NOT_CLIENT = 0;
    public const CLIENT = 1;
    public const DEVELOP = 1;
    public const MAINTAIN = 2;
    public const FEATURE = 3;
}
