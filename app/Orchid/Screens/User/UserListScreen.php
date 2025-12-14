<?php

namespace App\Orchid\Screens\User;

use App\Models\User;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Link;

class UserListScreen extends Screen
{
    public $name = 'Пользователи';

    public function query(): iterable
    {
        return [
            'users' => User::paginate(10),
        ];
    }

    public function commandBar(): iterable
    {
        return [
            Link::make('Создать пользователя')
                ->icon('plus')
                ->route('platform.systems.users.create'),
        ];
    }

    public function layout(): iterable
    {
        return [
            Layout::table('users', [
                TD::make('id', 'ID'),
                TD::make('name', 'Имя'),
                TD::make('email', 'Email'),
                TD::make('role', 'Роль'),

                TD::make(__('Actions'))
                    ->render(fn (User $user) =>
                    Link::make('Редактировать')
                        ->icon('pencil')
                        ->route('platform.systems.users.edit', $user)
                    ),
            ]),
        ];
    }
}
