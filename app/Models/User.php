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
        'id'         => Where::class,
        'login'      => Like::class,
        'email'      => Like::class,
        'role'       => Where::class,
        'status'     => Where::class,
        'updated_at' => WhereDateStartEnd::class,
        'created_at' => WhereDateStartEnd::class,
    ];

    protected $allowedSorts = [
        'id',
        'login',
        'email',
        'role',
        'status',
        'updated_at',
        'created_at',
    ];

    /**
     * Orchid требует этот метод
     */
    public function getNameAttribute()
    {
        return $this->login;
    }

    /**
     * Orchid требует этот метод
     */
    public function getEmailAttribute()
    {
        if (!empty($this->attributes['email'])) {
            return $this->attributes['email'];
        }
        return $this->login . '@localhost';
    }

    /**
     * Проверка прав доступа для Orchid
     * Сигнатура: hasAccess(string $permit, bool $cache = true)
     */
    public function hasAccess(string $permit, bool $cache = true): bool
    {
        return $this->role === 'admin' && !empty($this->attributes['email']);
    }

    /**
     * Проверка роли для Orchid
     * Сигнатура: inRole($role)
     */
    public function inRole($role): bool
    {
        return $this->role === $role;
    }
}
