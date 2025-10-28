<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'ticket_number', 'issue_date', 'status', 'notes'];

    // Связь с пользователем
    public function user()
    {
        return $this->belongsTo(User::class); // Каждый билет принадлежит одному пользователю
    }
}
