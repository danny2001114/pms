<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeamMember extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'team_members';
    protected $fillable = [
        'member_id',
        'team_id',
    ];

    // ========= Relationships ========= //
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'member_id');
    }
}
