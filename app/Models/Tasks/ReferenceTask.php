<?php

namespace App\Models\Tasks;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ReferenceTask extends Pivot
{
    use HasFactory;
    protected $with = ['tasks', 'references'];
    protected $fillable = [
        'reference_id',
        'task_id',
        'done',
        'by_Who',
    ];

    protected $casts = [
        'reference_id' => 'integer',
        'task_id' => 'integer',
        'done' => 'bool',
        'by_Who' => 'string',
    ];

    public function getCreatedAtAttribute($value)
    {
        return diffForHumanCreatedAt($value);
    }

    public function getUpdatedAtAttribute($value)
    {
        return diffForHumanUpdatedAt($value);
    }
}
