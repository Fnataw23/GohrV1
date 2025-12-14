<?php

namespace App\Http\Controllers\Application;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EditController extends Controller
{
    public function edit(Application $application)
    {
        $application->load([
            'hunter.addresses',
            'hunter.passport',
            'hunter.socialStatus.organization',
            'hunter.membershipCards',
            'hunter.convictions',
            'hunter.huntingCards',
        ]);

        $hunter = $application->hunter;
        $address = $hunter->addresses->first();
        $passport = $hunter->passport;
        $socialStatus = $hunter->socialStatus;
        $membershipCard = $hunter->membershipCards->first();
        $conviction = $hunter->convictions->first();
        $huntingCard = $hunter->huntingCards->first();
        $organization = $socialStatus ? $socialStatus->organization : null;

        $organizations = \App\Models\Organization::all(); // <-- добавили список организаций

        return view('applications.edit', compact(
            'application', 'hunter', 'address', 'passport',
            'socialStatus', 'membershipCard', 'conviction', 'huntingCard', 'organization', 'organizations'
        ));
    }

    public function update(Request $request, Application $application)
    {
        $application->load('hunter');

        DB::transaction(function () use ($request, $application) {
            $hunter = $application->hunter;

            // Обновляем личные данные охотника
            $hunter->update($request->only([
                'last_name', 'first_name', 'middle_name', 'date_of_birth',
                'phone', 'email', 'snils', 'mn'
            ]));

            // Обновляем адрес
            if ($hunter->addresses->count()) {
                $hunter->addresses->first()->update($request->only([
                    'postal_code', 'region', 'city', 'street', 'house', 'apartment'
                ]));
            }

            // Обновляем паспорт
            if ($hunter->passport) {
                $hunter->passport->update($request->only([
                    'series', 'number', 'issue_date', 'issuer', 'department_code'
                ]));
            }

            /// Социальный статус и организация
            if ($hunter->socialStatus) {
                $hunter->socialStatus->update($request->only([
                    'job_title', 'retiree', 'disabled'
                ]));

                if ($request->filled('organization_id')) {
                    $hunter->socialStatus->organization_id = $request->organization_id;
                    $hunter->socialStatus->save();
                } elseif ($request->filled('new_organization_name')) {
                    $organization = \App\Models\Organization::create([
                        'name' => $request->new_organization_name
                    ]);
                    $hunter->socialStatus->organization_id = $organization->id;
                    $hunter->socialStatus->save();
                }
            }

            // Членский билет
            if ($hunter->membershipCards->count()) {
                $hunter->membershipCards->first()->update($request->only([
                    'series', 'number', 'issue_date', 'issuer'
                ]));
            }

            // Судимость
            if ($hunter->convictions->count()) {
                $hunter->convictions->first()->update($request->only([
                    'status', 'description'
                ]));
            }

            // Охотничий билет
            if ($hunter->huntingCards->count()) {
                $hunter->huntingCards->first()->update($request->only([
                    'series', 'number', 'issue_date', 'expiry_date', 'issued_by',
                    'is_cancelled', 'cancellation_date', 'cancellation_reason'
                ]));
            }
        });

        return redirect()->route('applications.show', $application)
            ->with('success', 'Заявка успешно обновлена!');
    }
}
