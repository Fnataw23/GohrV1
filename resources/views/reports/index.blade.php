@extends('layouts.app')  <!-- или какой у тебя основной макет -->

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Отчеты</h4>
                    </div>
                    <div class="card-body text-center py-5">
                        <h5 class="text-muted mb-4">Раздел находится в разработке</h5>
                        <p>Функционал отчетов будет доступен в ближайшее время.</p>
                        <a href="{{ route('main.index') }}" class="btn btn-primary mt-3">
                            ← Вернуться на главную
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
