<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberSkill extends Model
{
    use HasFactory;

    protected $table = 'member_skills';
    protected $fillable = [
        'member_id',
        'skill_id',
        'level'
    ];
}
