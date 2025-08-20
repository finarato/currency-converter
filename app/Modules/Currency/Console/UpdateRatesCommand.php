<?php
namespace App\Modules\Currency\Console;

use Illuminate\Console\Command;
use App\Modules\Currency\Models\ExchangeRate;
use Carbon\Carbon;

class UpdateRatesCommand extends Command
{
    protected $signature = 'currency:update-rates';
    protected $description = 'Update currency rates from freecurrencyapi.com';

    public function handle()
    {
        $apiKey = config('services.currency_api.key');
        $url = "https://api.freecurrencyapi.com/v1/latest?apikey={$apiKey}";

        // Инициализация cURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_CAINFO, 'C:\\Program Files\\php\\extras\\ssl\\cacert.pem');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);

        $response = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);

        if ($error) {
            $this->error("cURL Error: $error");
            return 1;
        }

        $data = json_decode($response, true)['data'] ?? [];

        if (empty($data)) {
            $this->error("No data received from API");
            return 1;
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
        }

        $this->info('Rates updated successfully.');
        return 0;
    }
}
