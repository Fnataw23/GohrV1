<?php

namespace App\Http\Controllers\Front;

use App\Models\Application;

class MainController
{
    public function index()
    {
        // Загружаем все заявки с охотниками и нужными связями
        $applications = Application::with([
            'hunter',
            'hunter.passport',
            'hunter.addresses',
            'hunter.socialStatus.organization',
        ])->latest()->paginate(10);

        return view('main', compact('applications'));
    }
}
