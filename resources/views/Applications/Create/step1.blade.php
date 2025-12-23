@extends('layouts.main')

@section('content')
    <div class="container mt-4">
        <h3 class="m-lg-3">Общие данные</h3>

        <form action="{{ route('applications.store.step1') }}" method="POST" class="border p-4 rounded">
            @csrf

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Фамилия</label>
                    <input type="text" class="form-control" name="last_name"
                           value="{{ old('last_name', $data['last_name'] ?? '') }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Имя</label>
                    <input type="text" class="form-control" name="first_name"
                           value="{{ old('first_name', $data['first_name'] ?? '') }}" required>
                </div>
            </div>


            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Отчество</label>
                    <input type="text" class="form-control" name="middle_name"
                           value="{{ old('middle_name', $data['middle_name'] ?? '') }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Дата рождения</label>
                    <input type="date" class="form-control" name="date_of_birth"
                           value="{{ old('date_of_birth', $data['date_of_birth'] ?? '') }}" required>
                </div>
            </div>


            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Место рождения</label>
                    <input type="text" class="form-control" name="place_of_birth"
                           value="{{ old('place_of_birth', $data['place_of_birth'] ?? '') }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Телефон</label>
                    <input type="tel" class="form-control" name="phone"
                           value="{{ old('phone', $data['phone'] ?? '') }}"
                           placeholder="+7 (___) ___-__-__" required>
                </div>
            </div>


            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email"
                           value="{{ old('email', $data['email'] ?? '') }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">СНИЛС</label>
                    <input type="text" class="form-control" name="snils"
                           value="{{ old('snils', $data['snils'] ?? '') }}"
                           placeholder="___-___-___ __" required>
                </div>
            </div>


            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" name="mn"
                    {{ old('mn', $data['mn'] ?? false) ? 'checked' : '' }}>
                <label class="form-check-label">Малочисленный народ</label>
            </div>


            <div class="mb-3">
                <label class="form-label">Комментарий</label>
                <textarea name="comment" class="form-control" rows="3">{{ old('comment', $data['comment'] ?? '') }}</textarea>
            </div>

            <div class="d-flex justify-content-end">
                <button class="btn btn-primary">Далее</button>
            </div>
        </form>
    </div>
@endsection
