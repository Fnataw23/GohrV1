@extends('layouts.main')

@section('content')
    <div class="container mt-4">
        <h3>Список заявок</h3>

        <!-- Форма фильтров + таблица -->
        <form method="GET" action="{{ route('main.index') }}" id="filterForm">
            <table class="table table-hover align-middle shadow-sm">
                <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th style="width: 160px;">
                        Дата
                        <div class="mt-2 row g-1">
                            <div class="col-6">
                                <input type="date" name="date_from" class="form-control form-control-sm"
                                       value="{{ $filters['date_from'] ?? '' }}" title="С">
                            </div>
                            <div class="col-6">
                                <input type="date" name="date_to" class="form-control form-control-sm"
                                       value="{{ $filters['date_to'] ?? '' }}" title="По">
                            </div>
                        </div>
                    </th>
                    <th>
                        ФИО
                        <div class="mt-2">
                            <input type="text" name="fio" class="form-control form-control-sm"
                                   value="{{ $filters['fio'] ?? '' }}"
                                   placeholder="Фамилия Имя Отчество">
                        </div>
                    </th>
                    <th>Год рождения</th>
                    <th>Билет</th>
                    <th>Статус</th>
                    <th>Примечания</th>
                    <th>Пользователь</th>
                </tr>
                </thead>
                <tbody>
                @forelse($applications as $application)
                    @php $hunter = $application->hunter; @endphp
                    <tr style="cursor: pointer;"
                        onclick="window.location='{{ route('applications.show', $application) }}'">
                        <td>{{ $application->id }}</td>
                        <td>{{ $application->created_at->format('d.m.Y H:i') }}</td>
                        <td>{{ trim(($hunter->last_name ?? '') . ' ' . ($hunter->first_name ?? '') . ' ' . ($hunter->middle_name ?? '')) }}</td>
                        <td>{{ $hunter->date_of_birth ? \Carbon\Carbon::parse($hunter->date_of_birth)->format('Y') : '-' }}</td>
                        <td>
                            <span class="badge bg-info">
                                {{ $application->status === 'new' ? 'Новая' : $application->status }}
                            </span>
                        </td>
                        <td>-</td>
                        <td>-</td>
                        <td>{{ $application->user->short_name ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-5 text-muted">Нет заявок</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </form>

        <!-- Кнопка "Найти" и "Сбросить" под таблицей -->
        <div class="d-flex justify-content-between align-items-center mt-3">
            <button type="submit" form="filterForm" class="btn btn-primary">Применить фильтры</button>

            @if(request()->hasAny(['fio', 'date_from', 'date_to']))
                <a href="{{ route('main.index') }}" class="text-decoration-none text-muted">
                    ✕ Сбросить все фильтры
                </a>
            @else
                <span class="text-muted">Всего заявок: {{ $applications->total() }}</span>
            @endif
        </div>

        <!-- Пагинация с сохранением фильтров -->
        {{ $applications->appends(request()->query())->links() }}
    </div>
@endsection
