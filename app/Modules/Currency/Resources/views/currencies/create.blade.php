@extends('currency::layouts.app')

@section('content')
    <div class="container py-4">
        <h1 class="mb-4">Добавить валюту</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('currency.currencies.store') }}" class="p-4 border rounded" style="max-width: 500px;">
            @csrf

            <div class="mb-3">
                <label for="code" class="form-label">Код валюты</label>
                <input type="text" class="form-control" id="code" name="code" value="{{ old('code') }}" maxlength="3" placeholder="USD" required>
                {{-- @error('code') <small class="text-danger">{{ $message }}</small> @enderror --}}
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Название валюты</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Доллар США" required>
                {{-- @error('name') <small class="text-danger">{{ $message }}</small> @enderror --}}
            </div>

            <button type="submit" class="btn btn-primary w-100">Сохранить</button>
        </form>
    </div>
@endsection
