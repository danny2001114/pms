<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    protected $table = 't_sources';
    protected $fillable = [
        'project_id',
        'link'
    ];
}
