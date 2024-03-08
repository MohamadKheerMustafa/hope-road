<?php

namespace App\Models\Tasks;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'completed',
    ];

    protected $casts = [
        'title' => 'string',
        'description' => 'string',
        'start_date' => 'string',
        'end_date' => 'string',
        'completed' => 'bool'
    ];

    public function references()
    {
        return $this->belongsToMany(Reference::class)
            ->using(ReferenceTask::class)
            ->withPivot([
                'done', 'by_Who'
            ])->withTimestamps();
    }

    public function times()
    {
        return $this->hasMany(Time::class);
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
