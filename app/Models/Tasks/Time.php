<?php

namespace App\Models\Tasks;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_id',
        'statement',
        'start_date',
        'end_date',
    ];

    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id');
    }

    public function getCreatedAtAttribute($value)
    {
        return diffForHumanCreatedAt($value);
    }

    public function getUpdatedAtAttribute($value)
    {
        return diffForHumanUpdatedAt($value);
    }
}
