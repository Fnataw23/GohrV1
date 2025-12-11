<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Application extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'hunter_id',
        'operator_id',
        'status',
        'scan_front',
        'scan_back',
        'consent_scan',
    ];

    protected $dates = ['deleted_at'];

    // Связь с охотником
    public function hunter()
    {
        return $this->belongsTo(Hunter::class);
    }
    // Связь с оператором
    public function user()
    {
        return $this->belongsTo(User::class, 'operator_id');
    }
}
