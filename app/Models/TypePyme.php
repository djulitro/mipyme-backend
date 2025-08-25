<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypePyme extends Model
{
    protected $table = 'type_pymes';

    protected $fillable = [
        'category_id',
        'name',
        'description',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
