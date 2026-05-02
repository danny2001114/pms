<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 't_members';
    protected $fillable = [
        'member_id',
        'team_id',
        'is_leader'
    ];

    protected $casts = [
        'is_leader' => 'boolean'
    ];

    // ========= Relationships ========= //
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'member_id');
    }
}
