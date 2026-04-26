<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, SoftDeletes;

    protected $table = 'users';
    protected $fillable = [
        'password',
        'name',
        'email',
        'phone',
        'role',
        'gender',
        'birthday',
        'address',
        'bio',
        'image'
    ];

    public const MEMBER = 1;
    public const LEADER = 2;
    public const ADMIN = 3;
    public const SUPER = 4;
    public const MALE = 1;
    public const FEMALE = 2;

    // ========= Attributes ========= //
    protected $appends = [
        'role_text',
        'gender_text',
        'code'
    ];

    protected function getRoleTextAttribute()
    {
        if (!$this->role) return null;
        return config('constants.USER.ROLES.TEXT')[$this->role];
    }

    protected function getGenderTextAttribute()
    {
        if (!$this->gender) return null;
        return config('constants.USER.GENDERS.TEXT')[$this->gender] ?? null;
    }

    protected function getCodeAttribute()
    {
         if (!$this->role) return null;
        $role = config('constants.USER.ROLES.TEXT')[$this->role][0];
        $id = sprintf("%05d", $this->id);
        return $role . $id;
    }

    // ========= Relationships ========= //
    public function members(): HasMany
    {
        return $this->hasMany(TeamMember::class, "member_id");
    }
}
