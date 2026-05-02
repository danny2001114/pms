<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 't_projects';
    protected $fillable = [
        'key',
        'title',
        'owner_id',
        'state',
        'active',
        'priority',
        'start_date',
        'end_date',
        'created_by'
    ];

    protected $casts = [
        'active' => 'boolean',
        'start_datetime' => 'date',
        'end_datetime' => 'date'
    ];

    // ========= States ========= //
    public const DEVELOP = 1;
    public const MAINTAIN = 2;
    public const FEATURE = 3;

    // ========= Priorities ========= //
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

    // ========= Relationships ========= //
    public function sec_owner(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function primary_owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function sources(): HasMany
    {
        return $this->hasMany(Source::class);
    }

    public function changeLogs(): HasMany
    {
        return $this->hasMany(ChangeLog::class, 'key', 'key');
    }

    public function bugs(): HasManyThrough
    {
        return $this->hasManyThrough(Bug::class, Task::class);
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'ref');
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
