<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        return view('settings.index');
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'last_name'   => 'required|string|max:255',
            'first_name'  => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'position'    => 'nullable|string|max:255',
        ]);

        auth()->user()->update($validated);

        return back()->with('success', 'Настройки профиля успешно сохранены');
    }
}
