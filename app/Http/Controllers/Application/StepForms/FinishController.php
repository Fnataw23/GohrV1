<?php

namespace App\Http\Controllers\Application\StepForms;

use App\Models\Hunter;
use App\Models\Address;
use App\Models\Passport;
use App\Models\SocialStatus;
use App\Models\MembershipCard;
use App\Models\Conviction;
use App\Models\HuntingCard;
use App\Models\Organization;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FinishController
{
    public function __invoke(Request $request)
    {
        // Проверяем, что все шаги заполнены
        $steps = ['step1', 'step2', 'step3', 'step4', 'step5', 'step6', 'step7'];
        foreach ($steps as $step) {
            if (!session()->has("application.$step")) {
                return redirect()->route('applications.create.step1')
                    ->with('error', 'Заполните все шаги перед сохранением');
            }
        }

        try {
            DB::beginTransaction();

            // 1. Создаем охотника - ИСПРАВЛЕНО date_of_birth
            $hunterData = session('application.step1');
            \Log::info('Данные для создания охотника: ', $hunterData);

            $hunter = Hunter::create([
                'last_name' => $hunterData['last_name'] ?? null,
                'first_name' => $hunterData['first_name'] ?? null,
                'middle_name' => $hunterData['middle_name'] ?? null,
                'date_of_birth' => $hunterData['date_of_birth'] ?? null, // ПРАВИЛЬНО!
                'place_of_birth' => $hunterData['place_of_birth'] ?? null,
                'phone' => $hunterData['phone'] ?? null,
                'email' => $hunterData['email'] ?? null,
                'snils' => $hunterData['snils'] ?? null,
                'mn' => $hunterData['mn'] ?? false,
                'comment' => $hunterData['comment'] ?? null,
            ]);
            \Log::info('Охотник успешно создан с ID: ', ['hunter_id' => $hunter->id]);

            // 2. Создаем адрес
            $addressData = session('application.step2');
            \Log::info('Данные для создания адреса: ', $addressData);

            $hunter->addresses()->create([
                'postal_code' => $addressData['postal_code'] ?? null,
                'region' => $addressData['region'] ?? null,
                'city' => $addressData['city'] ?? null,
                'street' => $addressData['street'] ?? null,
                'house' => $addressData['house'] ?? null,
                'apartment' => $addressData['apartment'] ?? null,
            ]);
            \Log::info('Адрес успешно добавлен для охотника: ', ['hunter_id' => $hunter->id]);

            // 3. Создаем паспорт
            $passportData = session('application.step3');
            \Log::info('Данные для создания паспорта: ', $passportData);

            $hunter->passport()->create([
                'series' => $passportData['series'] ?? null,
                'number' => $passportData['number'] ?? null,
                'issuer' => $passportData['issuer'] ?? null,
                'issue_date' => $passportData['issue_date'] ?? null,
                'department_code' => $passportData['unit_code'] ?? null,
            ]);
            \Log::info('Паспорт успешно создан для охотника: ', ['hunter_id' => $hunter->id]);

            // 4. Создаем социальный статус и организацию
            $socialData = session('application.step4', []);
            \Log::info('Данные step4 для социального статуса: ', $socialData);

// Работа с организацией
            $organizationId = null;

            if (isset($socialData['organization_option'])) {
                if ($socialData['organization_option'] === 'existing' &&
                    !empty($socialData['existing_organization_id'])) {
                    // Привязываем существующую организацию
                    $organizationId = $socialData['existing_organization_id'];
                    \Log::info('Привязываем существующую организацию: ', ['organization_id' => $organizationId]);
                }
                elseif ($socialData['organization_option'] === 'new' &&
                    !empty($socialData['organization'])) {
                    // Создаем новую организацию
                    $organizationData = $socialData['organization'];

                    // Создаем организацию с ВСЕМИ полями из формы
                    $organization = Organization::create([
                        'name' => $organizationData['name'] ?? null,
                        'legal_form' => $organizationData['legal_form'] ?? 'ООО',
                        'phone' => $organizationData['phone'] ?? null,
                        'email' => $organizationData['email'] ?? null,
                        'postal_code' => $organizationData['postal_code'] ?? null,
                        'region' => $organizationData['region'] ?? null,
                        'city' => $organizationData['city'] ?? null,
                        'street' => $organizationData['street'] ?? null,
                        'house' => $organizationData['house'] ?? null,
                        'building' => $organizationData['building'] ?? null,
                        'apartment' => $organizationData['apartment'] ?? null,
                        // Добавьте другие поля если они есть в форме
                    ]);
                    $organizationId = $organization->id;
                    \Log::info('Новая организация создана: ', [
                        'organization_id' => $organizationId,
                        'name' => $organization->name
                    ]);
                }
            }

// Обновляем охотника с организацией
            if ($organizationId) {
                $hunter->update(['organization_id' => $organizationId]);
                \Log::info('Охотник обновлен с организацией: ', [
                    'hunter_id' => $hunter->id,
                    'organization_id' => $organizationId
                ]);
            }

// Создаем социальный статус
            $socialStatus = $hunter->socialStatus()->create([
                'job_title' => $socialData['job_title'] ?? null,
                'retiree' => $socialData['retiree'] ?? false,
                'disabled' => $socialData['disabled'] ?? false,
                'organization_id' => $organizationId,
            ]);
            \Log::info('Социальный статус создан для охотника: ', [
                'hunter_id' => $hunter->id,
                'social_status_id' => $socialStatus->id
            ]);
            // 5. Создаем членский билет
            $membershipData = session('application.step5', []);
            \Log::info('Данные step5 для членского билета: ', $membershipData);

            $membershipCard = $hunter->membershipCards()->create([
                'series' => $membershipData['series'] ?? null,
                'number' => $membershipData['number'] ?? null,
                'issue_date' => $membershipData['issue_date'] ?? null,
                'issuer' => $membershipData['issuer'] ?? null,
            ]);
            \Log::info('Членский билет создан для охотника: ', [
                'hunter_id' => $hunter->id,
                'membership_card_id' => $membershipCard->id
            ]);

            // 6. Создаем судимость
            $convictionData = session('application.step6', []);
            \Log::info('Данные step6 для судимости: ', $convictionData);

            // Преобразуем данные из формы
            $status = $convictionData['status'] ?? 'unknown'; // 'yes', 'no' или 'unknown'

            $conviction = $hunter->convictions()->create([
                'status' => $status,
                'description' => $convictionData['description'] ?? null,
            ]);

            \Log::info('Судимость создана для охотника: ', [
                'hunter_id' => $hunter->id,
                'conviction_id' => $conviction->id
            ]);

            // 7. Создаем охотничий билет
            $huntingData = session('application.step7', []);
            \Log::info('Данные step7 для охотничьего билета: ', $huntingData);

            $huntingCardData = [
                'series' => $huntingData['series'] ?? null,
                'number' => $huntingData['number'] ?? null,
                'issue_date' => $huntingData['issue_date'] ?? null,
                'expiry_date' => $huntingData['expiry_date'] ?? null,
                'issued_by' => $huntingData['issued_by'] ?? null,
            ];

            // Обработка аннулирования
            if (!empty($huntingData['is_cancelled'])) {
                $huntingCardData['cancellation_date'] = $huntingData['cancellation_date'] ?? null;
                $huntingCardData['cancellation_reason'] = $huntingData['cancellation_reason'] ?? null;
            } else {
                $huntingCardData['cancellation_date'] = null;
                $huntingCardData['cancellation_reason'] = null;
            }

            $huntingCard = $hunter->huntingCards()->create($huntingCardData);
            \Log::info('Охотничий билет создан для охотника: ', [
                'hunter_id' => $hunter->id,
                'hunting_card_id' => $huntingCard->id
            ]);

            // 8. Создаем саму заявку
            $application = $hunter->applications()->create([
                'status' => 'new',
                'operator_id' => auth()->id(),
            ]);
            \Log::info('Заявка успешно создана: ', ['application_id' => $application->id]);

            DB::commit();

            // Очищаем сессию
            session()->forget('application');

            return redirect()->route('main.index')->with('success', 'Заявка успешно создана!');

        } catch (\Exception $e) {
            DB::rollBack();

            // Логируем ошибку
            \Log::error('Ошибка при создании заявки: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'step1_data' => session('application.step1', []),
            ]);

            return redirect()->route('main.index')
                ->with('error', 'Ошибка при сохранении: ' . $e->getMessage());
        }
    }
}
