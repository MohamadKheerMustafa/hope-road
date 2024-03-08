<?php

namespace App\Models\Tasks;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'date_assignment',
        'type',
    ];

    protected $casts = [
        'name' => 'string',
        'date_assignment' => 'string',
        'type' => 'string',
    ];

    public function tasks()
    {
        return $this->belongsToMany(Task::class)
            ->using(ReferenceTask::class)
            ->withPivot([
                'done', 'by_Who'
            ])
            ->withTimestamps();
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
