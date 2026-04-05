<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, SoftDeletes;

    protected $table = 'users';
    protected $fillable = [
        'code',
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
}
