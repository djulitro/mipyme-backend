<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;
    
    protected $table = 'services';

    protected $fillable = [
        'pyme_id',
        'name',
        'description',
        'price',
        'time',
        'status',
    ];

    public function pyme()
    {
        return $this->belongsTo(Pyme::class);
    }
}
