<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Bug extends Model
{
    use HasFactory;

    protected $table = 't_bugs';
    protected $fillable = [
        'code',
        'task_id',
        'content',
        'state',
        'created_by'
    ];

    // ========= States ========= //
    public const PENDING = 1;
    public const FIXING = 2;
    public const COMPLETED = 3;
    public const CLOSE = 4;

    // ========= Attributes ========= //
    protected $appends = [
        'state_text'
    ];

    protected function getStateTextAttribute()
    {
        if (!$this->state) return null;
        return config('constants.USER.ROLES.TEXT')[$this->state];
    }

    // ========= Scopes ========= //
    public function scopeLog(Builder $query)
    {
        return $query->project()->changeLogs()->where('ref', ChangeLog::BUG)->first();
    }

    // ========= Relationships ========= //
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function project(): HasOneThrough
    {
        return $this->hasOneThrough(Project::class, Task::class);
    }
}
