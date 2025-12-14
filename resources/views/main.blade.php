@extends('layouts.main')

@section('content')
    <div class="container mt-4">
        <h3>Список заявок</h3>

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
                @php $hunter = $application->hunter; @endphp
                <tr style="cursor:pointer;" onclick="window.location='{{ route('applications.show', $application) }}'">
                    <td>{{ $application->id }}</td>
                    <td>{{ $hunter->last_name ?? '' }} {{ $hunter->first_name ?? '' }}</td>
                    <td>{{ $hunter->date_of_birth ? \Carbon\Carbon::parse($hunter->date_of_birth)->format('Y') : '' }}</td>
                    <td>{{ $hunter->phone ?? '' }}</td>
                    <td><span class="badge bg-info">{{ $application->status === 'new' ? 'Новая' : $application->status }}</span></td>
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
