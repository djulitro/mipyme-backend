<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'client_id',
        'pyme_id',
        'status_id',
        'payment_id',
    ];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function pyme()
    {
        return $this->belongsTo(Pyme::class, 'pyme_id');
    }

    public function status()
    {
        return $this->belongsTo(StatusReservation::class, 'status_id');
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'service_has_reservation', 'reservation_id', 'service_id')
                    ->withTimestamps();
    }

    public function bookingSchedule()
    {
        return $this->hasOne(BookingSchedule::class, 'reservation_id');
    }
}
