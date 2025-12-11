<?php

namespace App\Http\Controllers\Application\StepForms;

use App\Http\Requests\Step6Request;

class Step6Controller
{
    public function show()
    {
        $data = session('application.step6', []);
        return view('applications.create.step6', compact('data'));
    }

    public function store(Step6Request $request)
    {
        session(['application.step6' => $request->validated()]);
        return redirect()->route('applications.create.step7');
    }
}
