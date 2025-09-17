<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusReservation extends Model
{
    public $timestamps = false;
    protected $table = 'status_reservations';
    protected $fillable = ['name', 'description'];
}
