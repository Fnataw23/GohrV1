<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HuntingCard extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'hunter_id',
        'series',
        'number',
        'issue_date',
        'cancellation_date',
        'cancellation_reason',
    ];

    protected $dates = ['deleted_at'];
    // Связь с охотником - каждый охотник может иметь много охотничьих билетов
    public function hunter()
    {
        return $this->belongsTo(Hunter::class);
    }
}
