<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 't_profiles';
    protected $fillable = [
        'user_id',
        'gender',
        'birthday',
        'address',
        'git_acc',
        'image',
        'bio'
    ];

    // ========= Genders ========= //
    public const MALE = 1;
    public const FEMALE = 2;

    // ========= Attributes ========= //
    protected $appends = [
        'gender_text'
    ];

    protected function getGenderTextAttribute()
    {
        if (!$this->gender) return null;
        return config('constants.USER.ROLES.TEXT')[$this->gender];
    }
}
