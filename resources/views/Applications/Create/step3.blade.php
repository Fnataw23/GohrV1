@extends('layouts.main')

@section('content')
    <div class="container mt-4 d-flex justify-content-center">
        <div class="w-50">
            <h3 class="m-lg-3 text-center">Паспортные данные</h3>
            <form action="{{ route('applications.store.step3') }}" method="POST" class="border p-4 rounded">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="series" class="form-label">Серия</label>
                        <input type="text" class="form-control" name="series"
                               value="{{ old('series', $passport['series'] ?? '') }}"
                               placeholder="____" required>
                    </div>
                    <div class="col-md-6">
                        <label for="number" class="form-label">Номер</label>
                        <input type="text" class="form-control" name="number"
                               value="{{ old('number', $passport['number'] ?? '') }}"
                               placeholder="______" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="unit_code" class="form-label">Код подразделения</label>
                        <input type="text" class="form-control" name="unit_code"
                               value="{{ old('unit_code', $passport['unit_code'] ?? '') }}"
                               placeholder="___-___" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="issue_date" class="form-label">Дата выдачи</label>
                    <input type="date" class="form-control" id="issue_date" name="issue_date"
                           value="{{ old('issue_date', $data['issue_date'] ?? '') }}"
                           required max="{{ date('Y-m-d') }}">
                    @error('issue_date') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <label for="issuer" class="form-label">Кем выдан</label>
                    <input type="text" class="form-control" id="issuer" name="issuer"
                           value="{{ old('issuer', $data['issuer'] ?? '') }}" required>
                    @error('issuer') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="d-flex justify-content-between">
                    <a href="{{ route('applications.create.step2') }}" class="btn btn-secondary">Назад</a>
                    <button type="submit" class="btn btn-primary">Далее</button>
                </div>
            </form>
        </div>
    </div>
@endsection
