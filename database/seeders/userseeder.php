<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class userseeder extends Seeder
{
    public function run(): void
    {
        // Очищаем таблицу перед заполнением
        User::query()->delete();

        // 1. Администратор (имеет email для входа в Orchid)
        User::create([
            'login' => 'admin',
            'email' => 'admin@company.local',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'status' => 'active',
        ]);

        // 2. Операторы/рабочие (НЕ имеют email, только login)
        User::create([
            'login' => 'operator1',
            'email' => null,
            'password' => Hash::make('operator123'),
            'role' => 'operator',
            'status' => 'active',
        ]);

        User::create([
            'login' => 'operator2',
            'email' => null,
            'password' => Hash::make('operator456'),
            'role' => 'operator',
            'status' => 'active',
        ]);

        // 3. Еще один администратор
        User::create([
            'login' => 'superadmin',
            'email' => 'super@company.local',
            'password' => Hash::make('super123'),
            'role' => 'admin',
            'status' => 'active',
        ]);

        $this->command->info('Создано 4 пользователя: 2 админа, 2 оператора');
    }
}
