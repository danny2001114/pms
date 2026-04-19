<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignee extends Model
{
    use HasFactory;

    protected $table = 'assignees';
    protected $fillable = [
        'task_id',
        'member_id',
        'cur_active',
        'created_by',
        'updated_by'
    ];
}
