@extends('currency::layouts.app')

@section('content')
    <div class="container">
        <h1>Список валют</h1>

        <a href="{{ route('currency.currencies.create') }}" class="btn btn-primary mb-3">Добавить валюту</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Код</th>
                <th>Название</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($currencies as $currency)
                <tr>
                    <td>{{ $currency->id }}</td>
                    <td>{{ $currency->code }}</td>
                    <td>{{ $currency->name }}</td>
                    <td>
                        <form action="{{ route('currency.currencies.destroy', $currency->id) }}" method="POST" onsubmit="return confirm('Удалить валюту?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $currencies->links() }}
    </div>
@endsection
