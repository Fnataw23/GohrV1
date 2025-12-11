@extends('layouts.main')

@section('content')
    <div class="container mt-4">
        <h3 class="m-lg-3">Адрес</h3>
        <form action="{{ route('applications.store.step2') }}" method="POST" class="border p-4 rounded">
            @csrf

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="postal_code" class="form-label">Почтовый индекс</label>
                    <input type="text" class="form-control" id="postal_code" name="postal_code" value="{{ old('postal_code', $address['postal_code'] ?? '') }}" required maxlength="6">
                    @error('postal_code') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label for="region" class="form-label">Регион</label>
                    <input type="text" class="form-control" id="region" name="region" value="{{ old('region', $address['region'] ?? '') }}" required>
                    @error('region') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="city" class="form-label">Населенный пункт</label>
                    <input type="text" class="form-control" id="city" name="city" value="{{ old('city', $address['city'] ?? '') }}">
                    @error('city') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label for="street" class="form-label">Улица</label>
                    <input type="text" class="form-control" id="street" name="street" value="{{ old('street', $address['street'] ?? '') }}" required>
                    @error('street') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="house" class="form-label">Номер дома</label>
                    <input type="text" class="form-control" id="house" name="house" value="{{ old('house', $address['house'] ?? '') }}" required>
                    @error('house') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label for="building" class="form-label">Номер корпуса (При наличии)</label>
                    <input type="text" class="form-control" id="building" name="building" value="{{ old('building', $address['building'] ?? '') }}">
                    @error('building') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="apartment" class="form-label">Номер квартиры (При наличии)</label>
                    <input type="text" class="form-control" id="apartment" name="apartment" value="{{ old('apartment', $address['apartment'] ?? '') }}">
                    @error('apartment') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('applications.create.step1') }}" class="btn btn-secondary">Назад</a>
                <button class="btn btn-primary">Далее</button>
            </div>
        </form>
    </div>
@endsection
