<?php

namespace App\Http\Controllers\Application\StepForms;

use App\Http\Requests\Step7Request;

class Step7Controller
{
    public function show()
    {
        $data = session('application.step7', []);
        return view('applications.create.step7', compact('data'));
    }

    public function store(Step7Request $request)
    {
        session(['application.step7' => $request->validated()]);
        return redirect()->route('applications.create.confirm');
    }
}
