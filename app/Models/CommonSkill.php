<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CommonSkill extends Model
{
    protected $table = 't_common_skills';
    protected $fillable = [
        'ref_type',
        'ref_id',
        'skill_id'
    ];

    // ========= Relationships ========= //
    public function skill(): BelongsTo
    {
        return $this->belongsTo(Skill::class);
    }
}
