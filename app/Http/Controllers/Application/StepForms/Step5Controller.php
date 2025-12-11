<?php

namespace App\Http\Controllers\Application\StepForms;

use App\Http\Requests\Step5Request;

class Step5Controller
{
    public function show()
    {
        $data = session('application.step5', []);
        return view('applications.create.step5', compact('data'));
    }

    public function store(Step5Request $request)
    {
        session(['application.step5' => $request->validated()]);
        return redirect()->route('applications.create.step6');
    }
}
