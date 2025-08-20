<?php

namespace App\Modules\Currency\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Currency\Models\Currency;
use App\Modules\Currency\Models\ExchangeRate;
use Carbon\Carbon;

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

        $rate = ExchangeRate::whereDate('date', Carbon::today()->toDateString())
            ->where('currency_from', $request->from)
            ->where('currency_to', $request->to)
            ->first();

        if (!$rate) {
            return back()->with('error', 'Курс для выбранных валют не найден');
        }

        $converted = $request->amount * $rate->rate;

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
