<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hunter extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'last_name',
        'first_name',
        'middle_name',
        'date_of_birth',
        'place_of_birth',
        'phone',
        'email',
        'snils',
        'mn',
        'comment',
        'organization_id', // Добавьте это поле!
    ];

    protected $dates = ['deleted_at'];

    // Связь с паспортом
    public function passport()
    {
        return $this->hasOne(Passport::class);
    }

    // Связь с заявками
    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    // Связь с организацией
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    // Связь с членскими билетами
    public function membershipCards()
    {
        return $this->hasMany(MembershipCard::class);
    }

    // Связь с судимостями
    public function convictions()
    {
        return $this->hasMany(Conviction::class);
    }

    // Связь с охотничьими билетами
    public function huntingCards()
    {
        return $this->hasOne(HuntingCard::class); // или hasMany если может быть несколько
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    // ДОБАВЬТЕ ЭТУ СВЯЗЬ:
    public function socialStatus()
    {
        return $this->hasOne(SocialStatus::class);
    }
}
