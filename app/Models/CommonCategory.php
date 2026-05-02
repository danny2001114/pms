<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CommonCategory extends Model
{
    protected $table = 't_common_categories';
    protected $fillable = [
        'ref_type',
        'ref_id',
        'category_id'
    ];

    // ========= Relationships ========= //
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
