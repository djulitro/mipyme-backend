<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusPayment extends Model
{
    public $timestamps = false;
    
    protected $table = 'status_payments';

    protected $fillable = [
        'name',
        'description',
    ];
}
