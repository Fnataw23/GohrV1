<?php

namespace App\Http\Controllers\Application\StepForms;

use App\Models\Organization;

class ConfirmController
{
    public function __invoke()
    {
        // Проверяем, что все шаги заполнены
        $steps = ['step1', 'step2', 'step3', 'step4', 'step5', 'step6', 'step7'];
        foreach ($steps as $step) {
            if (!session()->has("application.$step")) {
                return redirect()->route('applications.create.step1')
                    ->with('error', 'Заполните все шаги перед подтверждением');
            }
        }

        // Собираем все данные из сессии
        $data = [
            'hunter' => session('application.step1', []),
            'address' => session('application.step2', []),
            'passport' => session('application.step3', []),
            'socialStatus' => session('application.step4', []),
            'membershipCard' => session('application.step5', []),
            'conviction' => session('application.step6', []),
            'huntingCard' => session('application.step7', []),
        ];

        // Если выбрана существующая организация, получаем ее данные
        if ($data['socialStatus']['organization_option'] === 'existing' &&
            !empty($data['socialStatus']['existing_organization_id'])) {
            $organization = Organization::find($data['socialStatus']['existing_organization_id']);
            $data['organization'] = $organization;
        }

        return view('applications.create.confirm', compact('data'));
    }
}
