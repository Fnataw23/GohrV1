<?php

namespace App\Http\Controllers\Application\StepForms;

use App\Http\Requests\Step4Request;

class Step4Controller
{
    public function show()
    {
        $data = session('application.step4', []);
        $organizations = \App\Models\Organization::all(); // Получаем все организации

        return view('applications.create.step4', compact('data', 'organizations'));
    }

    public function store(Step4Request $request)
    {
        session(['application.step4' => $request->validated()]);
        return redirect()->route('applications.create.step5');
    }
}
