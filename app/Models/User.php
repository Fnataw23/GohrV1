<?php

namespace App\Models;

use Orchid\Filters\Types\Like;
use Orchid\Filters\Types\Where;
use Orchid\Filters\Types\WhereDateStartEnd;
use Orchid\Platform\Models\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'login',
        'last_name',
        'first_name',
        'middle_name',
        'position',
        'email',
        'password',
        'role',
        'status',
        'permissions',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'permissions',
    ];

    protected $casts = [
        'permissions'       => 'array',
        'email_verified_at' => 'datetime',
    ];

    protected $allowedFilters = [
        'id'          => Where::class,
        'login'       => Like::class,
        'email'       => Like::class,
        'role'        => Where::class,
        'status'      => Where::class,
        'last_name'   => Like::class,
        'first_name'  => Like::class,
        'middle_name' => Like::class,
        'position'    => Like::class,
        'updated_at'  => WhereDateStartEnd::class,
        'created_at'  => WhereDateStartEnd::class,
    ];

    protected $allowedSorts = [
        'id',
        'login',
        'email',
        'role',
        'status',
        'last_name',
        'first_name',
        'position',
        'updated_at',
        'created_at',
    ];

    /**
     * Orchid использует этот атрибут для отображения имени пользователя
     * Теперь возвращает ФИО, если заполнено, иначе логин
     */
    public function getNameAttribute(): string
    {
        $full = trim(implode(' ', [
            $this->last_name ?? '',
            $this->first_name ?? '',
            $this->middle_name ?? ''
        ]));

        return $full ?: $this->login;
    }

    /**
     * Orchid использует этот атрибут для отображения email
     * Оставляем как было — fallback на login@localhost
     */
    public function getEmailAttribute()
    {
        return $this->attributes['email'] ?? ($this->login . '@localhost');
    }

    /**
     * Проверка прав доступа для Orchid (текущая логика)
     */
    public function hasAccess(string $permit, bool $cache = true): bool
    {
        return $this->role === 'admin' && !empty($this->attributes['email']);
    }

    /**
     * Проверка роли (используется в твоём коде)
     */
    public function inRole($role): bool
    {
        return $this->role === $role;
    }

    /**
     * Удобные аксессоры для вывода
     */

    // Полное ФИО
    public function getFullNameAttribute(): string
    {
        return trim(implode(' ', array_filter([
            $this->last_name,
            $this->first_name,
            $this->middle_name,
        ]))) ?: $this->login;
    }

    // Короткое ФИО (Иванов И.И.)
    public function getShortNameAttribute(): string
    {
        $short = $this->last_name ?? '';

        if ($this->first_name) {
            $short .= ' ' . mb_substr($this->first_name, 0, 1) . '.';
        }
        if ($this->middle_name) {
            $short .= mb_substr($this->middle_name, 0, 1) . '.';
        }

        return trim($short) ?: $this->login;
    }

    // ФИО + должность (самый удобный для отчётов)
    public function getFullInfoAttribute(): string
    {
        $info = [$this->full_name, $this->position];

        return trim(implode(' — ', array_filter($info))) ?: $this->login;
    }

    // Короткое ФИО + должность (Иванов И.И., инспектор)
    public function getShortInfoAttribute(): string
    {
        $info = [$this->short_name, $this->position];

        return trim(implode(', ', array_filter($info))) ?: $this->login;
    }

    /**
     * Связь с заявками
     */
    public function applications()
    {
        return $this->hasMany(Application::class, 'operator_id');
    }
}
