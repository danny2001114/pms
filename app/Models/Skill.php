<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $table = 't_skills';
    protected $fillable = [
        'name',
        'type',
        'logo',
        'remark',
        'active'
    ];

    protected $casts = [
        'active' => 'boolean'
    ];

    // ========= Types ========= //
    public const PROGRAMMING = 1;
    public const TECHNICAL = 2;
    public const BUSINESS = 3;
    public const LANGUAGE = 4;

    // ========= Attributes ========= //
    protected $appends = [
        'type_text'
    ];

    protected function getTypeTextAttribute()
    {
        if (!$this->type) return null;
        return config('constants.USER.ROLES.TEXT')[$this->type];
    }
}
