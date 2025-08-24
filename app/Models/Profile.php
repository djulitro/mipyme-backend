<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profiles';

    protected $fillable = [
        'user_id',
        'phone',
        'birthdate',
        'gender',
        'address',
        'city',
        'country',
        'avatar_url',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
