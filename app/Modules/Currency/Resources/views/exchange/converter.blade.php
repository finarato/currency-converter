@extends('currency::layouts.app')

@section('title', 'Конвертер валют')

@section('content')
    <div class="container py-4">
        <div class="card p-4" style="max-width: 700px; margin: auto;">
            <h2 class="mb-4">Конвертер валют</h2>

            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <form method="POST" action="{{ route('currency.exchange.convert') }}">
                @csrf
                <div class="row g-3 align-items-end">
                    <div class="col-3">
                        <label for="amount" class="form-label">Сумма</label>
                        <input type="number" step="0.01" name="amount" id="amount"
                               class="form-control" placeholder="Сумма"
                               value="{{ old('amount', $amount ?? 1) }}">
                    </div>

                    <div class="col-3">
                        <label for="from" class="form-label">Из</label>
                        <select name="from" id="from" class="form-control">
                            @foreach($currencies as $currency)
                                <option value="{{ $currency->code }}"
                                    @selected(($from ?? old('from')) == $currency->code)>{{ $currency->code }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-3">
                        <label for="to" class="form-label">В</label>
                        <select name="to" id="to" class="form-control">
                            @foreach($currencies as $currency)
                                <option value="{{ $currency->code }}"
                                    @selected(($to ?? old('to')) == $currency->code)>{{ $currency->code }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-3 d-grid">
                        <button type="submit" class="btn btn-primary">Конвертировать</button>
                    </div>
                </div>
            </form>

            @isset($converted)
                <div class="alert alert-success mt-4">
                    {{ $amount ?? old('amount') }} {{ $from ?? old('from') }} = {{ $converted }} {{ $to ?? old('to') }}
                </div>
            @endisset
        </div>
    </div>
@endsection
