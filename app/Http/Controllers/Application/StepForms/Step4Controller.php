<?php

namespace App\Http\Controllers\Application\StepForms;

use App\Http\Requests\Application\Step4Request;
use App\Models\Organization;

class Step4Controller
{
    public function show()
    {
        $data = session('application.step4', []);
        $organizations = Organization::all();

        // Те же регионы из конфига
        $regions = config('regions');

        return view('applications.create.step4', compact('data', 'organizations', 'regions'));
    }

    public function store(Step4Request $request)
    {
        session(['application.step4' => $request->validated()]);
        return redirect()->route('applications.create.step5');
    }
}
