@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Список заявок</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="row">
            <!-- Левая колонка с условными обозначениями -->
            <div class="col-md-3">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Условные обозначения</h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex align-items-center">
                                <span class="badge bg-info me-2">Новая</span>
                                <span>Заявка ожидает обработки</span>
                            </li>
                            <li class="list-group-item d-flex align-items-center">
                                <span class="badge bg-warning me-2">В работе</span>
                                <span>Заявка в процессе обработки</span>
                            </li>
                            <li class="list-group-item d-flex align-items-center">
                                <span class="badge bg-success me-2">Завершена</span>
                                <span>Заявка обработана</span>
                            </li>
                            <li class="list-group-item d-flex align-items-center">
                                <span class="badge bg-danger me-2">Отклонена</span>
                                <span>Заявка отклонена</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Правая колонка с таблицей заявок -->
            <div class="col-md-9">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>ФИО</th>
                            <th>Год рождения</th>
                            <th>Телефон</th>
                            <th>Статус</th>
                            <th>Дата</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($applications as $application)
                            <tr>
                                <td>{{ $application->id }}</td>
                                <td>
                                    {{ $application->hunter->last_name ?? '' }}
                                    {{ $application->hunter->first_name ?? '' }}
                                </td>
                                <td>{{ $application->hunter->date_of_birth ? $application->hunter->date_of_birth->format('Y') : '' }}</td>
                                <td>{{ $application->hunter->phone ?? '' }}</td>
                                <td>
                                    @php
                                        $statusBadge = match($application->status) {
                                            'new' => ['bg-info', 'Новая'],
                                            'in_progress' => ['bg-warning', 'В работе'],
                                            'completed' => ['bg-success', 'Завершена'],
                                            'rejected' => ['bg-danger', 'Отклонена'],
                                            default => ['bg-secondary', $application->status]
                                        };
                                    @endphp
                                    <span class="badge {{ $statusBadge[0] }}">
                                        {{ $statusBadge[1] }}
                                    </span>
                                </td>
                                <td>{{ $application->created_at->format('d.m.Y H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Нет заявок</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                {{ $applications->links() }}
            </div>
        </div>
    </div>
@endsection
