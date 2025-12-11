<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Passport extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'hunter_id',
        'series',
        'number',
        'issue_date',
        'issuer',
        'unit_code',
    ];

    protected $dates = ['deleted_at'];
    // Связь с охотником - каждый паспорт принадлежит одному охотнику
    public function hunter()
    {
        return $this->belongsTo(Hunter::class);
    }
}
