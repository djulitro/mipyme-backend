<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';

    protected $fillable = [
        'pyme_id',
        'name',
        'description',
        'price',
        'duration',
        'status',
    ];

    public function pyme()
    {
        return $this->belongsTo(Pyme::class);
    }
}
