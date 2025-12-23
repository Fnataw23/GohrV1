<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\User;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function index(Request $request)
    {
        $query = Application::with(['hunter', 'huntingCards', 'operator'])
            ->latest();

        // Фильтр по дате
        if ($request->filled('date_filter')) {
            switch ($request->date_filter) {
                case 'today':
                    $query->whereDate('created_at', today());
                    break;
                case 'yesterday':
                    $query->whereDate('created_at', today()->subDay());
                    break;
                // 'all' - без фильтра
            }
        }

        // Фильтр по ФИО
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('hunter', function($q) use ($search) {
                $q->where('last_name', 'like', "%{$search}%")
                    ->orWhere('first_name', 'like', "%{$search}%")
                    ->orWhere('middle_name', 'like', "%{$search}%");
            });
        }

        // Фильтр по охотничьему билету
        if ($request->filled('ticket_status')) {
            switch ($request->ticket_status) {
                case 'issued':
                    $query->whereHas('huntingCards', function($q) {
                        $q->whereNotNull('issue_date');
                    });
                    break;
                case 'not_issued':
                    $query->whereDoesntHave('huntingCards')
                        ->orWhereHas('huntingCards', function($q) {
                            $q->whereNull('issue_date');
                        });
                    break;
                // 'all' - без фильтра
            }
        }

        $applications = $query->paginate(20);

        return view('applications.index', compact('applications'));
    }
}
