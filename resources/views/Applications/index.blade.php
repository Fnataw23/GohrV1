@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Список заявок</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table">
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
                        <span class="badge bg-info">
                            {{ $application->status === 'new' ? 'Новая' : $application->status }}
                        </span>
                    </td>
                    <td>{{ $application->created_at->format('d.m.Y H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Нет заявок</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        {{ $applications->links() }}
    </div>
@endsection
