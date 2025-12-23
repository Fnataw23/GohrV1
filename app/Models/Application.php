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

    // ДОБАВЬТЕ ЭТУ СВЯЗЬ для охотничьих билетов через охотника
    public function huntingCards()
    {
        // Вариант 1: Если нужен доступ как к коллекции
        return $this->hasManyThrough(
            HuntingCard::class,
            Hunter::class,
            'id',          // Ключ в таблице hunters
            'hunter_id',   // Ключ в таблице hunting_cards
            'hunter_id',   // Локальный ключ в applications
            'id'           // Ключ в hunters
        );

        // ИЛИ Вариант 2: Если нужен только первый/последний билет
        // return $this->hasOneThrough(
        //     HuntingCard::class,
        //     Hunter::class,
        //     'id',
        //     'hunter_id',
        //     'hunter_id',
        //     'id'
        // );
    }
}
