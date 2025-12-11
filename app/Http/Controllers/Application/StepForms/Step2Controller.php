<?php

namespace App\Http\Controllers\Application\StepForms;

use App\Http\Requests\Step2Request;

class Step2Controller
{
    public function show()
    {
        $address = session('application.step2', []);
        return view('applications.create.step2', compact('address'));
    }

    public function store(Step2Request $request)
    {
        session(['application.step2' => $request->validated()]);
        return redirect()->route('applications.create.step3');
    }
}
