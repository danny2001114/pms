<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamProject extends Model
{
    protected $table = 't_team_projects';
    protected $fillable = [
        'team_id',
        'project_id'
    ];
}
