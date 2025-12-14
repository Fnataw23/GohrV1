@extends('layouts.main')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Редактирование заявки №{{ $application->id }}</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('applications.update', $application) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <!-- Личные данные -->
                            <div class="card mb-4" id="hunter-section">
                                <div class="card-header bg-light"><h5>1. Личные данные</h5></div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 ">
                                            <strong>Фамилия:</strong>
                                            <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $hunter->last_name) }}">
                                        </div>
                                        <div class="col-md-4">
                                            <strong>Имя:</strong>
                                            <input type="text" name="first_name" class="form-control" value="{{ old('first_name', $hunter->first_name) }}">
                                        </div>
                                        <div class="col-md-4">
                                            <strong>Отчество:</strong>
                                            <input type="text" name="middle_name" class="form-control" value="{{ old('middle_name', $hunter->middle_name) }}">
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-4">
                                            <strong>Дата рождения:</strong>
                                            <input type="date" name="date_of_birth" class="form-control"
                                                   value="{{ old('date_of_birth', $hunter->date_of_birth ? \Carbon\Carbon::parse($hunter->date_of_birth)->format('Y-m-d') : '') }}">
                                        </div>
                                        <div class="col-md-4">
                                            <strong>Телефон:</strong>
                                            <input type="text" name="phone" class="form-control" value="{{ old('phone', $hunter->phone) }}">
                                        </div>
                                        <div class="col-md-4">
                                            <strong>Email:</strong>
                                            <input type="email" name="email" class="form-control" value="{{ old('email', $hunter->email) }}">
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-4">
                                            <strong>СНИЛС:</strong>
                                            <input type="text" name="snils" class="form-control" value="{{ old('snils', $hunter->snils) }}">
                                        </div>
                                        <div class="col-md-4">
                                            <strong>Малый народ:</strong>
                                            <select name="mn" class="form-select">
                                                <option value="0" {{ $hunter->mn ? '' : 'selected' }}>Нет</option>
                                                <option value="1" {{ $hunter->mn ? 'selected' : '' }}>Да</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Адрес -->
                            <div class="card mb-4" id="address-section">
                                <div class="card-header bg-light"><h5>2. Адрес</h5></div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <strong>Индекс:</strong>
                                            <input type="text" name="postal_code" class="form-control" value="{{ old('postal_code', $address->postal_code ?? '') }}">
                                            <strong>Регион:</strong>
                                            <input type="text" name="region" class="form-control" value="{{ old('region', $address->region ?? '') }}">
                                            <strong>Город:</strong>
                                            <input type="text" name="city" class="form-control" value="{{ old('city', $address->city ?? '') }}">
                                        </div>
                                        <div class="col-md-6">
                                            <strong>Улица</strong>
                                            <input type="text" name="street" class="form-control" value="{{ old('street', $address->street ?? '') }}">
                                            <strong>Дом</strong>
                                            <input type="text" name="house" class="form-control" value="{{ old('house', $address->house ?? '') }}">
                                            <strong>Квартира</strong>
                                            <input type="text" name="apartment" class="form-control" value="{{ old('apartment', $address->apartment ?? '') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Паспорт -->
                            <div class="card mb-4" id="passport-section">
                                <div class="card-header bg-light"><h5>3. Паспорт</h5></div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <strong>Серия</strong>
                                            <input type="text" name="series" class="form-control" value="{{ old('series', $passport->series ?? '') }}">
                                        </div>
                                        <div class="col-md-3">
                                            <strong>Номер</strong>
                                            <input type="text" name="number" class="form-control" value="{{ old('number', $passport->number ?? '') }}">
                                        </div>
                                        <div class="col-md-3">
                                            <strong>Дата выдачи</strong>
                                            <input type="date" name="issue_date" class="form-control"
                                                   value="{{ old('issue_date', $passport && $passport->issue_date ? \Carbon\Carbon::parse($passport->issue_date)->format('Y-m-d') : '') }}">
                                        </div>
                                        <div class="col-md-3">
                                            <strong>Код подразделения</strong>
                                            <input type="text" name="department_code" class="form-control" value="{{ old('department_code', $passport->department_code ?? '') }}">
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <strong>Кем выдан</strong>
                                        <input type="text" name="issuer" class="form-control" value="{{ old('issuer', $passport->issuer ?? '') }}">
                                    </div>
                                </div>
                            </div>

                            <!-- Соц. статус и организация -->
                            <div class="card mb-4" id="social-section">
                                <div class="card-header bg-light"><h5>4. Социальный статус</h5></div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <strong>Должность</strong>
                                            <input type="text" name="job_title" class="form-control" value="{{ old('job_title', $socialStatus->job_title ?? '') }}">
                                        </div>
                                        <div class="col-md-4 ">
                                            <strong>Пенсионер</strong>
                                            <select name="retiree" class="form-select">
                                                <option value="0" {{ $socialStatus && !$socialStatus->retiree ? 'selected' : '' }}>Нет</option>
                                                <option value="1" {{ $socialStatus && $socialStatus->retiree ? 'selected' : '' }}>Да</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <strong>Нетрудоспособный</strong>
                                            <select name="disabled" class="form-select">
                                                <option value="0" {{ $socialStatus && !$socialStatus->disabled ? 'selected' : '' }}>Нет</option>
                                                <option value="1" {{ $socialStatus && $socialStatus->disabled ? 'selected' : '' }}>Да</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <strong>Организация</strong>
                                        <select name="organization_id" class="form-select">
                                            <option value="">-- Выберите организацию --</option>
                                            @foreach($organizations as $org)
                                                <option value="{{ $org->id }}"
                                                    {{ old('organization_id', $socialStatus->organization_id ?? '') == $org->id ? 'selected' : '' }}>
                                                    {{ $org->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Членский билет -->
                            <div class="card mb-4" id="membership-section">
                                <div class="card-header bg-light"><h5>5. Членский билет</h5></div>
                                <div class="card-body">
                                    <strong>Серия</strong>
                                    <input type="text" name="membership_series" class="form-control mb-2" placeholder="Серия" value="{{ old('membership_series', $membershipCard->series ?? '') }}">
                                    <strong>Номер</strong>
                                    <input type="text" name="membership_number" class="form-control mb-2" placeholder="Номер" value="{{ old('membership_number', $membershipCard->number ?? '') }}">
                                    <strong>Дата выдачи</strong>
                                    <input type="date" name="membership_issue_date" class="form-control mb-2" placeholder="Дата выдачи" value="{{ old('membership_issue_date', optional($membershipCard)->issue_date) }}">
                                    <strong>Кем выдан</strong>
                                    <input type="text" name="membership_issuer" class="form-control" placeholder="Кем выдан" value="{{ old('membership_issuer', $membershipCard->issuer ?? '') }}">
                                </div>
                            </div>

                            <!-- Судимость -->
                            <div class="card mb-4" id="conviction-section">
                                <div class="card-header bg-light"><h5>6. Судимость</h5></div>
                                <div class="card-body">
                                    <strong>Наличие судимости</strong>
                                    <select name="status" class="form-select mb-2">
                                        <option value="unknown" {{ $conviction && $conviction->status === 'unknown' ? 'selected' : '' }}>Неизвестно</option>
                                        <option value="yes" {{ $conviction && $conviction->status === 'yes' ? 'selected' : '' }}>Есть</option>
                                        <option value="no" {{ $conviction && $conviction->status === 'no' ? 'selected' : '' }}>Нет</option>
                                    </select>
                                    <strong>Описание (При наличии)</strong>
                                    <textarea name="description" class="form-control" placeholder="Описание">{{ old('description', $conviction->description ?? '') }}</textarea>
                                </div>
                            </div>

                            <!-- Охотничий билет -->
                            <div class="card mb-4" id="hunting-section">
                                <div class="card-header bg-light"><h5>7. Охотничий билет</h5></div>
                                <div class="card-body">
                                    <strong>Серия</strong>
                                    <input type="text" name="hunting_series" class="form-control mb-2" placeholder="Серия" value="{{ old('hunting_series', $huntingCard->series ?? '') }}">
                                    <strong>Номер</strong>
                                    <input type="text" name="hunting_number" class="form-control mb-2" placeholder="Номер" value="{{ old('hunting_number', $huntingCard->number ?? '') }}">
                                    <strong>Дата выдачи</strong>
                                    <input type="date" name="hunting_issue_date" class="form-control mb-2" placeholder="Дата выдачи"
                                           value="{{ old('hunting_issue_date', $huntingCard && $huntingCard->issue_date ? \Carbon\Carbon::parse($huntingCard->issue_date)->format('Y-m-d') : '') }}">
                                    <div class="form-check mt-2">
                                        <input type="checkbox" name="is_cancelled" class="form-check-input" id="is_cancelled" value="1" {{ $huntingCard && $huntingCard->is_cancelled ? 'checked' : '' }}>
                                        <strong class="form-check-label" for="is_cancelled">Аннулирован</strong>
                                    </div>
                                    <strong>Дата аннулирования</strong>
                                    <input type="date" name="cancellation_date" class="form-control mt-2" placeholder="Дата аннулирования"
                                           value="{{ old('cancellation_date', $huntingCard && $huntingCard->cancellation_date ? \Carbon\Carbon::parse($huntingCard->cancellation_date)->format('Y-m-d') : '') }}">
                                    <strong>Причина аннулирования</strong>
                                    <input type="text" name="cancellation_reason" class="form-control mt-2" placeholder="Причина аннулирования" value="{{ old('cancellation_reason', $huntingCard->cancellation_reason ?? '') }}">
                                </div>
                            </div>


                            <!-- Кнопки -->
                            <div class="d-flex justify-content-between mb-4">
                                <a href="{{ url()->previous() }}" class="btn btn-secondary"><i class="bi bi-arrow-left me-2"></i>Назад</a>
                                <button type="submit" class="btn btn-success"><i class="bi bi-check-circle me-2"></i>Сохранить изменения</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
