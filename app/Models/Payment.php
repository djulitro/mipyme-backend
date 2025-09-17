<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';

    protected $fillable = [
        'pyme_id',
        'total',
        'commission_id',
        'net_amount',
        'payment_method_id',
        'status_id',
        'date',
    ];

    public function commission()
    {
        return $this->belongsTo(Commission::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function status()
    {
        return $this->belongsTo(StatusPayment::class, 'status_id');
    }
}
