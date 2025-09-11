<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pyme extends Model
{
    protected $table = 'pymes';

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'type_pyme_id',
        'direction',
        'city',
        'country',
        'phone',
        'logo_url',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function services()
    {
        return $this->hasMany(Service::class, 'pyme_id', 'id');
    }
}
