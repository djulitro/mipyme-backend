<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    protected $table = 'commissions';

    protected $fillable = [
        'percent',
        'fixed_amount',
        'start_date',
        'end_date',
    ];
}
