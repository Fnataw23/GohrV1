<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'hunter_id', 'postal_code', 'region', 'city', 'street', 'house', 'building', 'apartment'
    ];

    public function hunter()
    {
        return $this->belongsTo(Hunter::class); // Каждый адрес принадлежит одному охотнику
    }
}
