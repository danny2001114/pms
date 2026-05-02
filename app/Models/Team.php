<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Team extends Model
{
    use HasFactory;

    protected $table = 't_teams';
    protected $fillable = [
        'name',
        'image'
    ];

    // ========= Relationships ========= //
    public function members(): HasMany
    {
        return $this->hasMany(Member::class);
    }

    public function projects(): HasManyThrough
    {
        return $this->hasManyThrough(Project::class, TeamProject::class);
    }

    public function documents(): MorphMany
    {
        return $this->MorphMany(Documentation::class, 'ref');
    }

    public function skills(): MorphMany
    {
        return $this->MorphMany(CommonSkill::class, 'ref');
    }
}
