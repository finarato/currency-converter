<?php

namespace App\Modules\Currency\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Modules\Currency\Models\Currency;

class CurrencyController extends Controller
{
    public function index()
    {
        $currencies = Currency::paginate(10);
        return view('currency::currencies.index', compact('currencies'));
    }

    public function create()
    {
        return view('currency::currencies.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:3|unique:currencies,code',
            'name' => 'required|string|max:100',
        ]);

        Currency::create($validated);

        return redirect()->route('currency.currencies.index')->with('success', 'Валюта добавлена.');
    }

    public function destroy($id)
    {
        $currency = Currency::findOrFail($id);
        $currency->delete();

        return redirect()->route('currency.currencies.index')->with('success', 'Валюта удалена.');
    }
}
