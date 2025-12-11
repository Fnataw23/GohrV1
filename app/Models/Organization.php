<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organization extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'legal_form',
        'phone',
        'email',
        'postal_code',
        'region',
        'city',
        'street',
        'house',
        'building',
        'apartment',
    ];

    protected $dates = ['deleted_at'];
    // Связь с охотниками - каждая организация может иметь много охотников
    public function hunters()
    {
        return $this->hasMany(Hunter::class);
    }
}
