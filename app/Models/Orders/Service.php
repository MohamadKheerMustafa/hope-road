<?php

namespace App\Models\Orders;

use App\Models\ServiceInfo\ServiceInfo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'active'
    ];

    public function order()
    {
        return $this->hasMany(Order::class);
    }

    public function serviceInfo()
    {
        return $this->hasMany(ServiceInfo::class);
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
