<?php

namespace App\Http\Controllers\Application\StepForms;

use App\Http\Requests\Application\Step2Request;

class Step2Controller
{
    public function show()
    {
        $address = session('application.step2', []);

        // Получаем регионы из конфига (просто массив)
        $regions = config('regions');

        return view('applications.create.step2', compact('address', 'regions'));
    }

    public function store(Step2Request $request)
    {
        session(['application.step2' => $request->validated()]);
        return redirect()->route('applications.create.step3');
    }
}
