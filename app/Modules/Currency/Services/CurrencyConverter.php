<?php
namespace App\Modules\Currency\Services;

use App\Modules\Currency\Models\ExchangeRate;
use App\Modules\Currency\Models\Currency;
use Carbon\Carbon;

class CurrencyConverter
{
    /**
     *
     * @param float $amount
     * @param string $from
     * @param string $to
     * @return float
     * @throws \Exception
     */
    public function convert(float $amount, string $from, string $to): float
    {
        if ($from === $to) {
            return $amount;
        }

        $fromCurrency = Currency::where('code', $from)->first();
        $toCurrency = Currency::where('code', $to)->first();

        if (!$fromCurrency || !$toCurrency) {
            throw new \Exception("Currency {$from} or {$to} is not registered in the system");
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
