<?php
namespace App\Modules\Currency\Services;

use App\Modules\Currency\Models\ExchangeRate;
use App\Modules\Currency\Models\Currency;
use Carbon\Carbon;

class CurrencyUpdater
{
    /**
     *
     */
    public function update() : string
    {
        $apiKey = config('services.currency_api.key');
        $url = "https://api.freecurrencyapi.com/v1/latest?apikey={$apiKey}";

        // Инициализация cURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_CAINFO, config('services.currency_api.cert'));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);

        $response = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);

        if ($error) {
            return "cURL Error: $error";
        }

        $data = json_decode($response, true)['data'] ?? [];

        if (empty($data)) {
            return "No data received from API";
        }

        foreach ($data as $currency => $rate) {
            ExchangeRate::updateOrCreate(
                [
                    'currency_from' => 'USD',
                    'currency_to'   => $currency,
                    'date'          => Carbon::today(),
                ],
                ['rate' => $rate]
            );
            return "Updated successfully";
        }
    }
}
