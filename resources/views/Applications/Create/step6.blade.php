@extends('layouts.main')

@section('content')
    <div class="container mt-4 d-flex justify-content-center">
        <div class="w-50">
            <h3 class="m-lg-3">Судимость</h3>
            <form action="{{ route('applications.store.step6') }}" method="POST" class="border p-4 rounded">
                @csrf

                <!-- Статус судимости -->
                <div class="mb-4">
                    <label class="form-label fw-bold">Наличие судимости</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status"
                               id="status_unknown" value="unknown"
                            {{ old('status', $data['status'] ?? 'unknown') == 'unknown' ? 'checked' : '' }}>
                        <label class="form-check-label" for="status_unknown">
                            Неизвестно
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status"
                               id="status_yes" value="yes"
                            {{ old('status', $data['status'] ?? '') == 'yes' ? 'checked' : '' }}>
                        <label class="form-check-label" for="status_yes">
                            Есть
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status"
                               id="status_no" value="no"
                            {{ old('status', $data['status'] ?? '') == 'no' ? 'checked' : '' }}>
                        <label class="form-check-label" for="status_no">
                            Нет
                        </label>
                    </div>
                    @error('status') <div class="text-danger">{{ $message }}</div> @enderror
                </div>

                <!-- Описание судимости (показывается только если выбрано "Есть") -->
                <div class="mb-3" id="descriptionSection"
                     style="{{ old('status', $data['status'] ?? '') == 'yes' ? '' : 'display: none;' }}">
                    <label for="description" class="form-label">Описание судимости</label>
                    <textarea class="form-control" id="description" name="description"
                              rows="4" placeholder="Опишите подробности судимости...">{{ old('description', $data['description'] ?? '') }}</textarea>
                    @error('description') <div class="text-danger">{{ $message }}</div> @enderror
                    <div class="form-text">Укажите статью, дату, срок, статус судимости и другие подробности.</div>
                </div>

                <!-- Если выбрано "Нет" - показываем подтверждение -->
                <div class="alert alert-info" id="noConvictionAlert"
                     style="{{ old('status', $data['status'] ?? '') == 'no' ? '' : 'display: none;' }}">
                    <i class="bi bi-info-circle"></i> Вы указали, что судимости нет. Это подтверждается?
                </div>

                <!-- Если выбрано "Неизвестно" -->
                <div class="alert alert-warning" id="unknownAlert"
                     style="{{ old('status', $data['status'] ?? 'unknown') == 'unknown' ? '' : 'display: none;' }}">
                    <i class="bi bi-exclamation-triangle"></i> Информация о судимости неизвестна. Рекомендуется уточнить этот вопрос.
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('applications.create.step5') }}" class="btn btn-secondary">Назад</a>
                    <button type="submit" class="btn btn-primary">Далее</button>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript для переключения видимости полей -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const statusRadios = document.querySelectorAll('input[name="status"]');
            const descriptionSection = document.getElementById('descriptionSection');
            const noConvictionAlert = document.getElementById('noConvictionAlert');
            const unknownAlert = document.getElementById('unknownAlert');
            const descriptionTextarea = document.getElementById('description');

            function toggleSections() {
                const selectedStatus = document.querySelector('input[name="status"]:checked').value;

                // Скрываем все
                descriptionSection.style.display = 'none';
                noConvictionAlert.style.display = 'none';
                unknownAlert.style.display = 'none';

                // Снимаем обязательность описания
                descriptionTextarea.required = false;

                // Показываем нужные элементы
                if (selectedStatus === 'yes') {
                    descriptionSection.style.display = 'block';
                    descriptionTextarea.required = true;
                } else if (selectedStatus === 'no') {
                    noConvictionAlert.style.display = 'block';
                } else if (selectedStatus === 'unknown') {
                    unknownAlert.style.display = 'block';
                }
            }

            // Обработка переключения радиокнопок
            statusRadios.forEach(radio => {
                radio.addEventListener('change', toggleSections);
            });

            // Инициализация
            toggleSections();
        });
    </script>
@endsection
