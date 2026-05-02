<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Documentation extends Model
{
    use HasFactory;
    
    protected $table = 't_docs';
    protected $fillable = [
        'ref_type',
        'ref_id',
        'document'
    ];

    // ========= Relationships ========= //
    public function reference(): MorphTo
    {
        return $this->morphTo();
    }
}
