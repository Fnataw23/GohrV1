<?php

namespace App\Orchid\Screens\User;

use App\Models\User;
use Illuminate\Http\Request;
use Orchid\Screen\Screen;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Password;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Alert;

class UserEditScreen extends Screen
{
    public $name = 'Пользователь';

    public function query(User $user): iterable
    {
        return [
            'user' => $user,
        ];
    }

    public function commandBar(): iterable
    {
        return [
            Button::make('Сохранить')
                ->icon('check')
                ->method('save'),
        ];
    }

    public function layout(): iterable
    {
        return [
            Layout::rows([
                Input::make('user.login')
                    ->title('Логин')
                    ->required(),

                Input::make('user.email')
                    ->title('Email')
                    ->type('email'),

                Select::make('user.role')
                    ->title('Роль')
                    ->required()
                    ->options([
                        'admin'    => 'Администратор',
                        'operator' => 'Оператор',
                    ]),

                Password::make('password')
                    ->title('Пароль')
                    ->placeholder('Если пусто — не менять'),
            ]),
        ];
    }

    public function save(User $user, Request $request)
    {
        $user->fill($request->get('user'));

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        Alert::success('Пользователь сохранён');

        return redirect()->route('platform.systems.users');
    }
}
