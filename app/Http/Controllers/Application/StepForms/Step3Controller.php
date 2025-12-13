<?php

namespace App\Http\Controllers\Application\StepForms;

use App\Http\Requests\Application\Step3Request;

class Step3Controller
{
    public function show()
    {
        $data = session('application.step3', []);
        return view('applications.create.step3', compact('data'));
    }

    public function store(Step3Request $request)
    {
        session(['application.step3' => $request->validated()]);
        return redirect()->route('applications.create.step4');
    }
}
