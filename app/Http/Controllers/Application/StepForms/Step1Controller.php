<?php

namespace App\Http\Controllers\Application\StepForms;

use App\Http\Requests\Application\Step1Request;

class Step1Controller
{
    public function show()
    {
        $data = session('application.step1', []);
        return view('applications.create.step1', compact('data'));
    }

    public function store(Step1Request $request)
    {
        session(['application.step1' => $request->validated()]);
        return redirect()->route('applications.create.step2');
    }
}
