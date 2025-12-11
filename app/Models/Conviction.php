<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Conviction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'hunter_id',
        'status',
        'description',
    ];

    protected $dates = ['deleted_at'];
    // Связь с охотником - каждый охотник может иметь несколько судимостей
    public function hunter()
    {
        return $this->belongsTo(Hunter::class);
    }
}
