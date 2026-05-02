<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, SoftDeletes;

    protected $table = 't_users';
    protected $fillable = [
        'code',
        'password',
        'name',
        'email',
        'phone',
        'role',
        'is_request'
    ];

    protected $casts = [
        'password' => 'hashed',
        'is_request' => 'boolean'
    ];

    // ========= Roles ========= //
    public const MEMBER = 1;
    public const LEADER = 2;
    public const ADMIN = 3;
    public const SUPER = 4;

    // ========= Attributes ========= //
    protected $appends = [
        'role_text'
    ];

    protected function getRoleTextAttribute()
    {
        if (!$this->role) return null;
        return config('constants.USER.ROLES.TEXT')[$this->role];
    }

    // ========= Relationships ========= //
    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
    }

    public function changeLog(): hasOne
    {
        return $this->hasOne(ChangeLog::class, 'role', 'role');
    }

    public function teams(): HasManyThrough
    {
        return $this->hasManyThrough(Team::class, Member::class);
    }

    public function bugs(): HasManyThrough
    {
        return $this->hasManyThrough(Bug::class, Task::class, 'assignee_id', 'task_id', 'id', 'id');
    }

    public function skills(): MorphMany
    {
        return $this->MorphMany(CommonSkill::class, 'ref');
    }
}
