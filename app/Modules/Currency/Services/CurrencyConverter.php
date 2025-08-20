<?php
namespace App\Modules\Currency\Services;

use App\Modules\Currency\Models\ExchangeRate;
use Carbon\Carbon;

class CurrencyConverter
{
    public function convert(float $amount, string $from, string $to): float
    {
        if ($from === $to) {
            return $amount;
        }

        $rate = ExchangeRate::where('currency_from', $from)
            ->where('currency_to', $to)
            ->whereDate('date', Carbon::today()) // Rates must be fetched today, use ->orderByDesc('date') for last available
            ->first();

        if (!$rate) {
            throw new \Exception("No rate found for {$from} → {$to}");
        }

        return $amount * $rate->rate;
    }
}
