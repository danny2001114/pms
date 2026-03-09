<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Member extends Authenticatable
{
    use HasFactory, SoftDeletes;

    protected $table = 'members';
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
