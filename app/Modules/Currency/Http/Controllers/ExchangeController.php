<?php

namespace App\Modules\Currency\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Currency\Models\Currency;
use App\Modules\Currency\Models\ExchangeRate;
use App\Modules\Currency\Services\CurrencyConverter;

class ExchangeController extends Controller
{
    public function index()
    {
        $rates = ExchangeRate::latest('date')->paginate(20);
        return view('currency::exchange.index', compact('rates'));
    }

    public function showConverter()
    {
        $currencies = Currency::all();
        return view('currency::exchange.converter', compact('currencies'));
    }

    public function convert(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'from' => 'required|string|size:3',
            'to' => 'required|string|size:3',
        ]);



        $converter = new CurrencyConverter();
        $converted = $converter->convert($request->amount, $request->from, $request->to);

        $currencies = Currency::all();
        return view('currency::exchange.converter', [
            'currencies' => $currencies,
            'converted' => $converted,
            'amount' => $request->amount,
            'from' => $request->from,
            'to' => $request->to,
        ]);
    }
}
