<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Report extends Model
{
    use HasFactory;
    
    protected $table = 't_reports';
    protected $fillable = [
        'reported_by',
        'report'
    ];

    // ========= Relationships ========= //
    public function reporter(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
