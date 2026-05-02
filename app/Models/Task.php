<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 't_tasks';
    protected $fillable = [
        'issue_no',
        'assignor_id',
        'assignee_id',
        'project_id',
        'state',
        'priority',
        'percentage',
        'start_date',
        'end_date'
    ];

    protected $casts = [
        'start_datetime' => 'datetime',
        'end_datetime' => 'datetime'
    ];

    // ========= States ========= //
    public const PENDING = 1;
    public const ONHOLD = 2;
    public const TESTING = 3;
    public const FIXING = 4;
    public const COMPLETED = 5;

    // ========= Priority ========= //
    public const PRIORITY_LOW = 1;
    public const PRIORITY_MEDIUM = 2;
    public const PRIORITY_HIGH = 3;

    // ========= Attributes ========= //
    protected $appends = [
        'state_text',
        'priority_text'
    ];

    protected function getStateTextAttribute()
    {
        if (!$this->state) return null;
        return config('constants.PROJECT.STATES.TEXT')[$this->state];
    }

    protected function getPriorityTextAttribute()
    {
        if (!$this->priority) return null;
        return config('constants.PROJECT.PRIORITIES.TEXT')[$this->priority];
    }

    // ========= Scopes ========= //
    public function scopeLog(Builder $query)
    {
        return $query->project()->changeLogs()->where('ref', ChangeLog::TASK)->first();
    }

    // ========= Relationships ========= //
    public function assignor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assignor_id', 'id');
    }

    public function assignee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assignee_id', 'id');
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function bugs(): HasMany
    {
        return $this->hasMany(Bug::class);
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'ref');
    }

    public function skills(): MorphMany
    {
        return $this->MorphMany(CommonSkill::class, 'ref');
    }

    public function categories(): MorphMany
    {
        return $this->MorphMany(CommonCategory::class, 'ref');
    }

    public function documents(): MorphMany
    {
        return $this->MorphMany(Documentation::class, 'ref');
    }
}
