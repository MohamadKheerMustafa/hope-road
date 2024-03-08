<?php

namespace App\Models\ServiceInfo;

use App\Models\Orders\Service;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceInfo extends Model
{
    use HasFactory;

    protected $table = 'services_info';

    protected $fillable = [
        'service_id',
        'country',
        'durationOfCompletion',
        'serviceValidityPeriod',
        'details',
        'price',
        'requiredPapers',
        'paymentPrice',
        'entity',
    ];

    protected $casts = [
        'country' => 'string',
        'durationOfCompletion' => 'string',
        'serviceValidityPeriod' => 'string',
        'details' => 'string',
        'price' => 'string',
        'requiredPapers' => 'string',
        'paymentPrice' => 'string',
        'entity' => 'string',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'id');
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
