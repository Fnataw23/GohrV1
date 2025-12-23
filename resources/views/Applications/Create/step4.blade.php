@extends('layouts.main')

@section('content')
    <div class="container mt-4">
        <h3 class="m-lg-3">Социальный статус</h3>

        <form action="{{ route('applications.store.step4') }}" method="POST" class="border p-4 rounded">
            @csrf

            <!-- Социальный статус -->
            <div class="card mb-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Социальный статус</h5>
                </div>
                <div class="card-body">
                    <!-- Должность -->
                    <div class="mb-3">
                        <label for="job_title" class="form-label">Должность <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="job_title" name="job_title"
                               value="{{ old('job_title', $data['job_title'] ?? '') }}" required>
                        @error('job_title') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <!-- Статусы -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="retiree"
                                       name="retiree" value="1"
                                    {{ old('retiree', $data['retiree'] ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label" for="retiree">
                                    Пенсионер
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="disabled"
                                       name="disabled" value="1"
                                    {{ old('disabled', $data['disabled'] ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label" for="disabled">
                                    Нетрудоспособный
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Организация -->
            <div class="card mb-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Организация</h5>
                </div>
                <div class="card-body">
                    <!-- Варианты выбора -->
                    <div class="mb-4">
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="organization_option"
                                   id="option_none" value="none"
                                {{ old('organization_option', $data['organization_option'] ?? 'none') == 'none' ? 'checked' : '' }}>
                            <label class="form-check-label" for="option_none">
                                Без организации
                            </label>
                        </div>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="organization_option"
                                   id="option_existing" value="existing"
                                {{ old('organization_option', $data['organization_option'] ?? '') == 'existing' ? 'checked' : '' }}>
                            <label class="form-check-label" for="option_existing">
                                Выбрать существующую организацию
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="organization_option"
                                   id="option_new" value="new"
                                {{ old('organization_option', $data['organization_option'] ?? '') == 'new' ? 'checked' : '' }}>
                            <label class="form-check-label" for="option_new">
                                Создать новую организацию
                            </label>
                        </div>
                        @error('organization_option') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <!-- Выбор существующей организации -->
                    <div id="existingOrgSection"
                         style="{{ old('organization_option', $data['organization_option'] ?? '') == 'existing' ? '' : 'display: none;' }}">
                        <div class="mb-3">
                            <label for="existing_organization_id" class="form-label">Выберите организацию</label>
                            <select class="form-select" id="existing_organization_id" name="existing_organization_id">
                                <option value="">-- Выберите организацию --</option>
                                @foreach($organizations as $org)
                                    <option value="{{ $org->id }}"
                                        {{ old('existing_organization_id', $data['existing_organization_id'] ?? '') == $org->id ? 'selected' : '' }}>
                                        {{ $org->name }} ({{ $org->legal_form }})
                                    </option>
                                @endforeach
                            </select>
                            @error('existing_organization_id') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <!-- Создание новой организации -->
                    <div id="newOrgSection"
                         style="{{ old('organization_option', $data['organization_option'] ?? '') == 'new' ? '' : 'display: none;' }}">
                        @php
                            $org = $data['organization'] ?? [];
                        @endphp

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="org_name" class="form-label">Наименование</label>
                                <input type="text" class="form-control" id="org_name"
                                       name="organization[name]"
                                       value="{{ old('organization.name', $org['name'] ?? '') }}">
                                @error('organization.name') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="org_legal_form" class="form-label">Орг.-правовая форма</label>
                                <input type="text" class="form-control" id="org_legal_form"
                                       name="organization[legal_form]"
                                       value="{{ old('organization.legal_form', $org['legal_form'] ?? '') }}">
                                @error('organization.legal_form') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="org_phone" class="form-label">Телефон</label>
                                <input type="tel" class="form-control" id="org_phone"
                                       name="organization[phone]"
                                       placeholder="+7 (___) ___-__-__""
                                       value="{{ old('organization.phone', $org['phone'] ?? '') }}">
                                @error('organization.phone') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="org_email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="org_email"
                                       name="organization[email]"
                                       value="{{ old('organization.email', $org['email'] ?? '') }}">
                                @error('organization.email') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <!-- Адрес организации -->
                        <h6 class="mt-4 mb-3">Адрес организации</h6>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="org_postal_code" class="form-label">Индекс</label>
                                <input type="text" class="form-control" id="org_postal_code"
                                       name="organization[postal_code]"
                                       value="{{ old('organization.postal_code', $org['postal_code'] ?? '') }}">
                            </div>
                            <div class="col-md-9">
                                <label for="org_region" class="form-label">Регион</label>
                                <select class="form-select" id="org_region" name="organization[region]">
                                    <option value="">Выберите регион</option>
                                    @foreach($regions as $region)
                                        <option value="{{ $region }}"
                                            {{ old('organization.region', $org['region'] ?? '') == $region ? 'selected' : '' }}>
                                            {{ $region }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('organization.region')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="org_city" class="form-label">Населенный пункт</label>
                                <input type="text" class="form-control" id="org_city"
                                       name="organization[city]"
                                       value="{{ old('organization.city', $org['city'] ?? '') }}">
                            </div>
                            <div class="col-md-6">
                                <label for="org_street" class="form-label">Улица</label>
                                <input type="text" class="form-control" id="org_street"
                                       name="organization[street]"
                                       value="{{ old('organization.street', $org['street'] ?? '') }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="org_house" class="form-label">Дом</label>
                                <input type="text" class="form-control" id="org_house"
                                       name="organization[house]"
                                       value="{{ old('organization.house', $org['house'] ?? '') }}">
                            </div>
                            <div class="col-md-4">
                                <label for="org_building" class="form-label">Корпус/строение</label>
                                <input type="text" class="form-control" id="org_building"
                                       name="organization[building]"
                                       value="{{ old('organization.building', $org['building'] ?? '') }}">
                            </div>
                            <div class="col-md-4">
                                <label for="org_apartment" class="form-label">Квартира/офис</label>
                                <input type="text" class="form-control" id="org_apartment"
                                       name="organization[apartment]"
                                       value="{{ old('organization.apartment', $org['apartment'] ?? '') }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Кнопки навигации -->
            <div class="d-flex justify-content-between">
                <a href="{{ route('applications.create.step3') }}" class="btn btn-secondary">Назад</a>
                <button type="submit" class="btn btn-primary">Далее</button>
            </div>
        </form>
    </div>

    <!-- JavaScript для переключения между вариантами -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const options = document.querySelectorAll('input[name="organization_option"]');
            const existingSection = document.getElementById('existingOrgSection');
            const newSection = document.getElementById('newOrgSection');

            function toggleSections() {
                const selectedOption = document.querySelector('input[name="organization_option"]:checked').value;

                // Скрываем все секции
                existingSection.style.display = 'none';
                newSection.style.display = 'none';

                // Снимаем обязательность полей
                existingSection.querySelector('select').required = false;
                newSection.querySelectorAll('input').forEach(input => input.required = false);

                // Показываем нужную секцию и делаем поля обязательными
                if (selectedOption === 'existing') {
                    existingSection.style.display = 'block';
                    existingSection.querySelector('select').required = true;
                } else if (selectedOption === 'new') {
                    newSection.style.display = 'block';
                    newSection.querySelectorAll('input:not([name*="building"]):not([name*="apartment"])').forEach(input => {
                        if (!input.name.includes('building') && !input.name.includes('apartment')) {
                            input.required = true;
                        }
                    });
                }
            }

            // Обработка переключения радиокнопок
            options.forEach(option => {
                option.addEventListener('change', toggleSections);
            });

            // Инициализация
            toggleSections();
        });
    </script>
@endsection
