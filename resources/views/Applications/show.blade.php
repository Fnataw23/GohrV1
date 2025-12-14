@extends('layouts.main')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0"><i class="bi bi-file-earmark-text me-2"></i>Просмотр заявки №{{ $application->id }}</h4>
                    </div>
                    <div class="card-body">

                        <!-- Навигация по разделам -->
                        <div class="mb-4">
                            <div class="d-flex flex-wrap gap-2">
                                <a href="#hunter-section" class="btn btn-outline-primary btn-sm">Личные данные</a>
                                <a href="#address-section" class="btn btn-outline-primary btn-sm">Адрес</a>
                                <a href="#passport-section" class="btn btn-outline-primary btn-sm">Паспорт</a>
                                <a href="#social-section" class="btn btn-outline-primary btn-sm">Соц. статус</a>
                                <a href="#membership-section" class="btn btn-outline-primary btn-sm">Членский билет</a>
                                <a href="#conviction-section" class="btn btn-outline-primary btn-sm">Судимость</a>
                                <a href="#hunting-section" class="btn btn-outline-primary btn-sm">Охотничий билет</a>
                            </div>
                        </div>

                        @php
                            $hunter = $application->hunter;
                            $address = $hunter->addresses->first();
                            $passport = $hunter->passport;
                            $socialStatus = $hunter->socialStatus;
                            $membershipCard = $hunter->membershipCards->first();
                            $conviction = $hunter->convictions->first();
                            $huntingCard = $hunter->huntingCards->first();
                            $organization = $socialStatus ? $socialStatus->organization : null;
                        @endphp

                            <!-- Личные данные -->
                        <div class="card mb-4" id="hunter-section">
                            <div class="card-header bg-light"><h5>1. Личные данные</h5></div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4"><strong>Фамилия:</strong> {{ $hunter->last_name ?? '-' }}</div>
                                    <div class="col-md-4"><strong>Имя:</strong> {{ $hunter->first_name ?? '-' }}</div>
                                    <div class="col-md-4"><strong>Отчество:</strong> {{ $hunter->middle_name ?? '-' }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4"><strong>Дата рождения:</strong> {{ $hunter->date_of_birth ?? '-' }}</div>
                                    <div class="col-md-4"><strong>Телефон:</strong> {{ $hunter->phone ?? '-' }}</div>
                                    <div class="col-md-4"><strong>Email:</strong> {{ $hunter->email ?? '-' }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4"><strong>СНИЛС:</strong> {{ $hunter->snils ?? '-' }}</div>
                                    <div class="col-md-4"><strong>Малый народ:</strong> {{ $hunter->mn ? 'Да' : 'Нет' }}</div>
                                </div>
                            </div>
                        </div>

                        <!-- Адрес -->
                        <div class="card mb-4" id="address-section">
                            <div class="card-header bg-light"><h5>2. Адрес</h5></div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Индекс:</strong> {{ $address->postal_code ?? '-' }}</p>
                                        <p><strong>Регион:</strong> {{ $address->region ?? '-' }}</p>
                                        <p><strong>Город:</strong> {{ $address->city ?? '-' }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Улица:</strong> {{ $address->street ?? '-' }}</p>
                                        <p><strong>Дом:</strong> {{ $address->house ?? '-' }}</p>
                                        <p><strong>Квартира:</strong> {{ $address->apartment ?? '-' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Паспорт -->
                        <div class="card mb-4" id="passport-section">
                            <div class="card-header bg-light"><h5>3. Паспорт</h5></div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3"><strong>Серия:</strong> {{ $passport->series ?? '-' }}</div>
                                    <div class="col-md-3"><strong>Номер:</strong> {{ $passport->number ?? '-' }}</div>
                                    <div class="col-md-3"><p><strong>Дата выдачи:</strong> {{ optional(\Carbon\Carbon::parse($passport->issue_date))->format('d.m.Y') ?? '-' }}</p></div>
                                    <div class="col-md-3"><strong>Код подразделения:</strong> {{ $passport->department_code ?? '-' }}</div>
                                </div>
                                <p><strong>Кем выдан:</strong> {{ $passport->issuer ?? '-' }}</p>
                            </div>
                        </div>

                        <!-- Социальный статус -->
                        <div class="card mb-4" id="social-section">
                            <div class="card-header bg-light"><h5>4. Социальный статус</h5></div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4"><strong>Должность:</strong> {{ $socialStatus->job_title ?? '-' }}</div>
                                    <div class="col-md-4"><strong>Пенсионер:</strong> {{ $socialStatus->retiree ? 'Да' : 'Нет' }}</div>
                                    <div class="col-md-4"><strong>Нетрудоспособный:</strong> {{ $socialStatus->disabled ? 'Да' : 'Нет' }}</div>
                                </div>
                                <hr>
                                <p><strong>Организация:</strong> {{ $organization->name ?? '-' }}</p>
                            </div>
                        </div>

                        <!-- Членский билет -->
                        <div class="card mb-4" id="membership-section">
                            <div class="card-header bg-light"><h5>5. Членский билет</h5></div>
                            <div class="card-body">
                                <p><strong>Серия:</strong> {{ $membershipCard->series ?? '-' }}</p>
                                <p><strong>Номер:</strong> {{ $membershipCard->number ?? '-' }}</p>
                                <p><strong>Дата выдачи:</strong> {{ optional(\Carbon\Carbon::parse($membershipCard->issue_date))->format('d.m.Y') ?? '-' }}</p>
                                <p><strong>Кем выдан:</strong> {{ $membershipCard->issuer ?? '-' }}</p>
                            </div>
                        </div>

                        <!-- Судимость -->
                        <div class="card mb-4" id="conviction-section">
                            <div class="card-header bg-light"><h5>6. Судимость</h5></div>
                            <div class="card-body">
                                <p><strong>Статус:</strong> {{ $conviction->status ?? '-' }}</p>
                                @if($conviction && $conviction->status === 'yes')
                                    <p><strong>Описание:</strong> {{ $conviction->description ?? '-' }}</p>
                                @endif
                            </div>
                        </div>

                        <!-- Охотничий билет -->
                        <div class="card mb-4" id="hunting-section">
                            <div class="card-header bg-light"><h5>7. Охотничий билет</h5></div>
                            <div class="card-body">
                                <p><strong>Серия:</strong> {{ $huntingCard->series ?? '-' }}</p>
                                <p><strong>Номер:</strong> {{ $huntingCard->number ?? '-' }}</p>
                                <p><strong>Дата выдачи:</strong> {{ optional(\Carbon\Carbon::parse($huntingCard->issue_date))->format('d.m.Y') ?? '-' }}</p>
                                <p><strong>Аннулирован:</strong> {{ $huntingCard && $huntingCard->is_cancelled ? 'Да' : 'Нет' }}</p>
                                @if($huntingCard && $huntingCard->is_cancelled)
                                    <p><strong>Дата аннулирования:</strong> {{ optional(\Carbon\Carbon::parse($huntingCard->cancellation_date))->format('d.m.Y') ?? '-' }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="container mt-4">
                            <div class="d-flex justify-content-between mb-3">
                                <!-- Назад к списку заявок -->
                                <a href="{{ route('main.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left me-1"></i>Назад к списку заявок
                                </a>

                                <!-- Редактировать заявку -->
                                <a href="{{ route('applications.edit', $application) }}" class="btn btn-primary">
                                    <i class="bi bi-pencil me-1"></i>Редактировать заявку
                                </a>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Плавный скролл -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    const targetId = this.getAttribute('href');
                    if (targetId !== '#') {
                        e.preventDefault();
                        const targetElement = document.querySelector(targetId);
                        if (targetElement) {
                            window.scrollTo({
                                top: targetElement.offsetTop - 20,
                                behavior: 'smooth'
                            });
                        }
                    }
                });
            });
        });
    </script>
@endsection
