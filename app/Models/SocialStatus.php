<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SocialStatus extends Model
{
    protected $fillable = [
        'hunter_id',
        'organization_id',
        'job_title',
        'retiree',
        'disabled',
    ];

    protected $casts = [
        'retiree' => 'boolean',
        'disabled' => 'boolean',
    ];

    public function hunter()
    {
        return $this->belongsTo(Hunter::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}
