<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'schedules';

    protected $fillable = [
        'pyme_id',
        'date',
        'start_time',
        'end_time',
        'is_active',
    ];

    public function pyme()
    {
        return $this->belongsTo(Pyme::class);
    }
}
