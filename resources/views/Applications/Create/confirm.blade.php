@extends('layouts.main')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0"><i class="bi bi-check-circle me-2"></i>Подтверждение данных</h4>
                    </div>
                    <div class="card-body">

                        <!-- Информационное сообщение -->
                        <div class="alert alert-info mb-4">
                            <h5><i class="bi bi-info-circle me-2"></i>Проверьте данные перед отправкой</h5>
                            <p class="mb-0">Все данные сохранены в черновике. После подтверждения они будут сохранены в базу данных.</p>
                        </div>

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

                        <!-- Личные данные -->
                        <div class="card mb-4" id="hunter-section">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">1. Личные данные</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <p><strong>Фамилия:</strong><br>{{ $data['hunter']['last_name'] ?? '-' }}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <p><strong>Имя:</strong><br>{{ $data['hunter']['first_name'] ?? '-' }}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <p><strong>Отчество:</strong><br>{{ $data['hunter']['middle_name'] ?? '-' }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <p><strong>Дата рождения:</strong><br>{{ $data['hunter']['date_of_birth'] ?? '-' }}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <p><strong>Телефон:</strong><br>{{ $data['hunter']['phone'] ?? '-' }}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <p><strong>Email:</strong><br>{{ $data['hunter']['email'] ?? '-' }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <p><strong>СНИЛС:</strong><br>{{ $data['hunter']['snils'] ?? '-' }}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <p><strong>Малый народ:</strong><br>
                                            {{ ($data['hunter']['mn'] ?? false) ? 'Да' : 'Нет' }}
                                        </p>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="{{ route('applications.create.step1') }}" class="btn btn-sm btn-outline-secondary">Изменить</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Адрес -->
                        <div class="card mb-4" id="address-section">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">2. Адрес</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Индекс:</strong> {{ $data['address']['postal_code'] ?? '-' }}</p>
                                        <p><strong>Регион:</strong> {{ $data['address']['region'] ?? '-' }}</p>
                                        <p><strong>Город:</strong> {{ $data['address']['city'] ?? '-' }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Улица:</strong> {{ $data['address']['street'] ?? '-' }}</p>
                                        <p><strong>Дом:</strong> {{ $data['address']['house'] ?? '-' }}</p>
                                        <p><strong>Квартира:</strong> {{ $data['address']['apartment'] ?? '-' }}</p>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <a href="{{ route('applications.create.step2') }}" class="btn btn-sm btn-outline-secondary">Изменить</a>
                                </div>
                            </div>
                        </div>

                        <!-- Паспорт -->
                        <div class="card mb-4" id="passport-section">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">3. Паспортные данные</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <p><strong>Серия:</strong> {{ $data['passport']['series'] ?? '-' }}</p>
                                    </div>
                                    <div class="col-md-3">
                                        <p><strong>Номер:</strong> {{ $data['passport']['number'] ?? '-' }}</p>
                                    </div>
                                    <div class="col-md-3">
                                        <p><strong>Дата выдачи:</strong><br>{{ $data['passport']['issue_date'] ?? '-' }}</p>
                                    </div>
                                    <div class="col-md-3">
                                        <p><strong>Код подразделения:</strong><br>{{ $data['passport']['unit_code'] ?? '-' }}</p>
                                    </div>
                                </div>
                                <p><strong>Кем выдан:</strong> {{ $data['passport']['issuer'] ?? '-' }}</p>
                                <div class="text-end">
                                    <a href="{{ route('applications.create.step3') }}" class="btn btn-sm btn-outline-secondary">Изменить</a>
                                </div>
                            </div>
                        </div>

                        <!-- Социальный статус -->
                        <div class="card mb-4" id="social-section">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">4. Социальный статус</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <p><strong>Должность:</strong><br>{{ $data['socialStatus']['job_title'] ?? '-' }}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <p><strong>Пенсионер:</strong><br>
                                            {{ ($data['socialStatus']['retiree'] ?? false) ? 'Да' : 'Нет' }}
                                        </p>
                                    </div>
                                    <div class="col-md-4">
                                        <p><strong>Нетрудоспособный:</strong><br>
                                            {{ ($data['socialStatus']['disabled'] ?? false) ? 'Да' : 'Нет' }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Организация -->
                                @if(($data['socialStatus']['organization_option'] ?? 'none') !== 'none')
                                    <hr>
                                    <h6>Организация</h6>
                                    @if($data['socialStatus']['organization_option'] === 'existing' && isset($data['organization']))
                                        <p><strong>Название:</strong> {{ $data['organization']->name ?? '-' }}</p>
                                        <p><strong>Форма:</strong> {{ $data['organization']->legal_form ?? '-' }}</p>
                                        <p><strong>Телефон:</strong> {{ $data['organization']->phone ?? '-' }}</p>
                                    @elseif($data['socialStatus']['organization_option'] === 'new')
                                        <p><strong>Название:</strong> {{ $data['socialStatus']['organization']['name'] ?? '-' }}</p>
                                        <p><strong>Форма:</strong> {{ $data['socialStatus']['organization']['legal_form'] ?? '-' }}</p>
                                        <p><strong>Телефон:</strong> {{ $data['socialStatus']['organization']['phone'] ?? '-' }}</p>
                                    @endif
                                @else
                                    <p class="text-muted">Организация не указана</p>
                                @endif

                                <div class="text-end">
                                    <a href="{{ route('applications.create.step4') }}" class="btn btn-sm btn-outline-secondary">Изменить</a>
                                </div>
                            </div>
                        </div>

                        <!-- Членский билет -->
                        <div class="card mb-4" id="membership-section">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">5. Членский билет</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <p><strong>Серия:</strong> {{ $data['membershipCard']['series'] ?? '-' }}</p>
                                    </div>
                                    <div class="col-md-3">
                                        <p><strong>Номер:</strong> {{ $data['membershipCard']['number'] ?? '-' }}</p>
                                    </div>
                                    <div class="col-md-3">
                                        <p><strong>Дата выдачи:</strong><br>{{ $data['membershipCard']['issue_date'] ?? '-' }}</p>
                                    </div>
                                    <div class="col-md-3">
                                        <p><strong>Кем выдан:</strong><br>{{ $data['membershipCard']['issuer'] ?? '-' }}</p>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <a href="{{ route('applications.create.step5') }}" class="btn btn-sm btn-outline-secondary">Изменить</a>
                                </div>
                            </div>
                        </div>

                        <!-- Судимость -->
                        <div class="card mb-4" id="conviction-section">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">6. Судимость</h5>
                            </div>
                            <div class="card-body">
                                @php
                                    $statusLabels = [
                                        'unknown' => 'Неизвестно',
                                        'yes' => 'Есть',
                                        'no' => 'Нет'
                                    ];
                                    $status = $data['conviction']['status'] ?? 'unknown';
                                @endphp
                                <p><strong>Статус:</strong> {{ $statusLabels[$status] ?? '-' }}</p>

                                @if($status === 'yes' && !empty($data['conviction']['description']))
                                    <p><strong>Описание:</strong><br>{{ $data['conviction']['description'] }}</p>
                                @endif

                                <div class="text-end">
                                    <a href="{{ route('applications.create.step6') }}" class="btn btn-sm btn-outline-secondary">Изменить</a>
                                </div>
                            </div>
                        </div>

                        <!-- Охотничий билет -->
                        <div class="card mb-4" id="hunting-section">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">7. Охотничий билет ЕГФО</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <p><strong>Серия:</strong> {{ $data['huntingCard']['series'] ?? '-' }}</p>
                                    </div>
                                    <div class="col-md-3">
                                        <p><strong>Номер:</strong> {{ $data['huntingCard']['number'] ?? '-' }}</p>
                                    </div>
                                    <div class="col-md-3">
                                        <p><strong>Дата выдачи:</strong><br>{{ $data['huntingCard']['issue_date'] ?? '-' }}</p>
                                    </div>
                                    <div class="col-md-3">
                                        <p><strong>Аннулирован:</strong><br>
                                            {{ ($data['huntingCard']['is_cancelled'] ?? false) ? 'Да' : 'Нет' }}
                                        </p>
                                    </div>
                                </div>

                                @if(($data['huntingCard']['is_cancelled'] ?? false))
                                    <hr>
                                    <p><strong>Дата аннулирования:</strong> {{ $data['huntingCard']['cancellation_date'] ?? '-' }}</p>
                                    <p><strong>Причина:</strong> {{ $data['huntingCard']['cancellation_reason'] ?? '-' }}</p>
                                @endif

                                <div class="text-end">
                                    <a href="{{ route('applications.create.step7') }}" class="btn btn-sm btn-outline-secondary">Изменить</a>
                                </div>
                            </div>
                        </div>

                        <!-- Кнопки действий -->
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('applications.create.step7') }}" class="btn btn-secondary">
                                        <i class="bi bi-arrow-left me-2"></i>Назад к редактированию
                                    </a>

                                    <form action="{{ route('applications.store.finish') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-lg">
                                            <i class="bi bi-check-circle me-2"></i>Подтвердить и отправить заявку
                                        </button>
                                    </form>
                                </div>

                                <div class="mt-3 text-center text-muted">
                                    <small>После подтверждения данные будут сохранены в базу данных и отправлены на рассмотрение</small>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Скрипт для плавной прокрутки -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Плавная прокрутка к разделам
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
