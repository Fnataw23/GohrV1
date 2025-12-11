<?php

namespace App\Http\Controllers\Application\StepForms;

use App\Models\Application;
use Illuminate\Http\Request;

class IndexController
{
    public function __invoke(Request $request)
    {
        // Получаем все заявки с охотником
        $applications = Application::with('hunter')->latest()->paginate(10);

        return view('applications.index', compact('applications'));
    }
}
