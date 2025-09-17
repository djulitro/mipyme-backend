<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceHasReservation extends Model
{
    protected $table = 'service_has_reservation';

    protected $fillable = [
        'service_id',
        'reservation_id',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function reservation()
    {
        return $this->belongsTo(Reservation::class, 'reservation_id');
    }
}
