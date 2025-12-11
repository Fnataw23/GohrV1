@extends('layouts.main')
@section('content')
    <div>
        <h2>Принять заявление</h2>

            @csrf
            <div class="mb-3">
                <label for="application_date" class="form-label">Дата подачи</label>
                <input type="date" class="form-control" id="application_date" name="application_date" required>
            </div>
            <div class="mb-3">
                <label for="file" class="form-label">Заявление</label>
                <input type="file" class="form-control" id="file" name="file" required>
            </div>
            <div class="mb-3">
                <label for="additional_file" class="form-label">Заявление(Доп)</label>
                <input type="file" class="form-control" id="additional_file" name="additional_file">
            </div>
            <div class="mb-3">
                <label for="consent_file" class="form-label">Согласие</label>
                <input type="file" class="form-control" id="consent_file" name="consent_file">
            </div>
            <div class="mb-3">
                <label for="source" class="form-label">Источник заявления</label>
                <select class="form-select" id="source" name="source" aria-label="Выберите источник" required>
                    <option value="" selected disabled>Выберите источник</option>
                    <option value="1">Лично</option>
                    <option value="2">Почта</option>
                    <option value="3">МФЦ</option>
                    <option value="4">Госуслуги</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Подать заявление</button>
        </form>

        <!-- Кнопка для перехода к следующему этапу -->
        <a href="{{ route('personal_data.create') }}" class="btn btn-secondary mt-3">Далее</a>
    </div>
@endsection
