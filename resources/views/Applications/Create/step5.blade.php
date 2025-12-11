@extends('layouts.main')

@section('content')
    <div class="container mt-4 d-flex justify-content-center">
        <div class="w-50">
            <h3 class="m-lg-3 text-center">Членский билет</h3>
            <form action="{{ route('applications.store.step5') }}" method="POST" class="border p-4 rounded">
                @csrf

                <div class="mb-3">
                    <label for="series" class="form-label">Серия</label>
                    <input type="text" class="form-control" id="series" name="series"
                           value="{{ old('series', $data['series'] ?? '') }}" required>
                    @error('series') <div class="text-danger">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="number" class="form-label">Номер</label>
                    <input type="text" class="form-control" id="number" name="number"
                           value="{{ old('number', $data['number'] ?? '') }}" required>
                    @error('number') <div class="text-danger">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="issue_date" class="form-label">Дата выдачи</label>
                    <input type="date" class="form-control" id="issue_date" name="issue_date"
                           value="{{ old('issue_date', $data['issue_date'] ?? '') }}" required>
                    @error('issue_date') <div class="text-danger">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="issuer" class="form-label">Кем выдан</label>
                    <input type="text" class="form-control" id="issuer" name="issuer"
                           value="{{ old('issuer', $data['issuer'] ?? '') }}" required>
                    @error('issuer') <div class="text-danger">{{ $message }}</div> @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('applications.create.step4') }}" class="btn btn-secondary">Назад</a>
                    <button type="submit" class="btn btn-primary">Далее</button>
                </div>
            </form>
        </div>
    </div>
@endsection
