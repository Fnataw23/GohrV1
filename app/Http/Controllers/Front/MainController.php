<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(Request $request)
    {
        $query = Application::with([
            'hunter',
            'hunter.passport',
            'hunter.addresses',
            'hunter.socialStatus.organization',
            'user' // добавили для вывода пользователя
        ]);

        // Фильтр по ФИО
        if ($request->filled('fio')) {
            $search = $request->fio;
            $query->whereHas('hunter', function ($q) use ($search) {
                $q->where('last_name', 'like', "%{$search}%")
                    ->orWhere('first_name', 'like', "%{$search}%")
                    ->orWhere('middle_name', 'like', "%{$search}%");
            });
        }

        // Фильтр по дате создания: с
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        // Фильтр по дате создания: по
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $applications = $query->latest()->paginate(10);

        // Сохраняем значения фильтров для отображения в полях
        $filters = $request->only(['fio', 'date_from', 'date_to']);

        return view('main', compact('applications', 'filters'));
    }
}
