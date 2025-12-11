@extends('layouts.main')

@section('content')
    <div class="container mt-4 d-flex justify-content-center">
        <div class="w-50">
            <h3 class="m-lg-3">Охотничий билет единого федерального образца</h3>
            <form action="{{ route('applications.store.step7') }}" method="POST" class="border p-4 rounded">
                @csrf

                <!-- Серия и номер -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="series" class="form-label">Серия</label>
                        <input type="text" class="form-control" id="series" name="series"
                               value="{{ old('series', $data['series'] ?? '') }}" required>
                        @error('series') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="number" class="form-label">Номер</label>
                        <input type="text" class="form-control" id="number" name="number"
                               value="{{ old('number', $data['number'] ?? '') }}" required>
                        @error('number') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                </div>

                <!-- Дата выдачи -->
                <div class="mb-3">
                    <label for="issue_date" class="form-label">Дата выдачи</label>
                    <input type="date" class="form-control" id="issue_date" name="issue_date"
                           value="{{ old('issue_date', $data['issue_date'] ?? '') }}" required>
                    @error('issue_date') <div class="text-danger">{{ $message }}</div> @enderror
                </div>

                <!-- Чекбокс "Аннулирован" -->
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="is_cancelled"
                               name="is_cancelled" value="1"
                            {{ old('is_cancelled', $data['is_cancelled'] ?? false) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_cancelled">
                            Билет аннулирован
                        </label>
                    </div>
                </div>

                <!-- Поля аннулирования (показываются только если отмечен чекбокс) -->
                <div id="cancellationSection"
                     style="{{ old('is_cancelled', $data['is_cancelled'] ?? false) ? '' : 'display: none;' }}">
                    <div class="mb-3">
                        <label for="cancellation_date" class="form-label">Дата аннулирования</label>
                        <input type="date" class="form-control" id="cancellation_date" name="cancellation_date"
                               value="{{ old('cancellation_date', $data['cancellation_date'] ?? '') }}">
                        @error('cancellation_date') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="cancellation_reason" class="form-label">Причина аннулирования</label>
                        <textarea class="form-control" id="cancellation_reason" name="cancellation_reason"
                                  rows="3">{{ old('cancellation_reason', $data['cancellation_reason'] ?? '') }}</textarea>
                        @error('cancellation_reason') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('applications.create.step6') }}" class="btn btn-secondary">Назад</a>
                    <button type="submit" class="btn btn-primary">Далее</button>
                </div>
            </form>
        </div>
    </div>


    <!-- JavaScript для показа/скрытия полей аннулирования -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkbox = document.getElementById('is_cancelled');
            const section = document.getElementById('cancellationSection');

            checkbox.addEventListener('change', function() {
                if (this.checked) {
                    section.style.display = 'block';
                } else {
                    section.style.display = 'none';
                }
            });
        });
    </script>
@endsection
