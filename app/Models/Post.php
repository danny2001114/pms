<?php

namespace App\Models;

use Dom\Comment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 't_posts';
    protected $fillable = [
        'title',
        'content',
        'type',
        'date',
        'start_datetime',
        'end_datetime',
        'posted_by',
        'updated_by'
    ];

    protected $casts = [
        'start_datetime' => 'datetime',
        'end_datetime' => 'datetime'
    ];

    // ========= Types ========= //
    public const NEWS = 1;
    public const EVENT = 2;

    // ========= Attributes ========= //
    protected $appends = [
        'type_text'
    ];

    protected function getTypeTextAttribute()
    {
        if (!$this->type) return null;
        return config('constants.USER.ROLES.TEXT')[$this->type];
    }

    // ========= Relationships ========= //
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'posted_by', 'id');
    }

    public function changeLog(): HasOne
    {
        return $this->hasOne(ChangeLog::class, 'date', 'date');
    }

    public function access(): HasMany
    {
        return $this->hasMany(PostTarget::class);
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'ref');
    }
}
