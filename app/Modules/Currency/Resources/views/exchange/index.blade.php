@extends('currency::layouts.app')

@section('content')
    <div class="container">
        <h1>Курсы валют</h1>
        <a href="{{ route('currency.exchange.converter') }}" class="btn btn-primary mb-3">Конвертировать</a>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Из</th>
                <th>В</th>
                <th>Курс</th>
                <th>Дата</th>
            </tr>
            </thead>
            <tbody>
            @foreach($rates as $rate)
                <tr>
                    <td>{{ $rate->currency_from }}</td>
                    <td>{{ $rate->currency_to }}</td>
                    <td>{{ $rate->rate }}</td>
                    <td>{{ $rate->date }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $rates->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
