<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;
    
    protected $table = 'projects';
    protected $fillable = [
        'code',
        'order',
        'title',
        'description',
        'owner_id',
        'state',
        'active',
        'type_id',
        'priority',
        'start_date',
        'end_date',
        'created_by'
    ];

    public const INACTIVE = 0;
    public const ACTIVE = 1;
    public const DEVELOP = 1;
    public const MAINTAIN = 2;
    public const FEATURE = 3;
    public const PRIORITY_LOW = 1;
    public const PRIORITY_MEDIUM = 2;
    public const PRIORITY_HIGH = 3;

    // ========= Attributes ========= //
    protected $appends = [
        'state_text', 
        'priority_text'
    ];

    function getStateTextAttribute()
    {
        return config('constants.PROJECT.STATES.TEXT')[$this->state];
    }

    function getPriorityTextAttribute()
    {
        return config('constants.PROJECT.PRIORITIES.TEXT')[$this->priority];
    }

    // ========= Relationships ========= //
    function owner(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    function recipient(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    function type(): BelongsTo
    {
        return $this->belongsTo(ProjectType::class);
    }

    function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}
