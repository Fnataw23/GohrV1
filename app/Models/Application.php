<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'ticket_id', 'application_date', 'status', 'details'];

    // Связь с пользователем
    public function user()
    {
        return $this->belongsTo(User::class); // Каждая заявка принадлежит одному пользователю
    }

    // Связь с билетом
    public function ticket()
    {
        return $this->belongsTo(Ticket::class); // Каждая заявка может быть связана с одним билетом
    }
}
