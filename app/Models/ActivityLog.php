<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActivityLog extends Model
{
    protected $table = 't_activity_logs';
    protected $fillable = [
        'table',
        'user_name',
        'user_code',
        'message'
    ];

    // ========= Relationships ========= //
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, "user_code", "code");
    }
}
