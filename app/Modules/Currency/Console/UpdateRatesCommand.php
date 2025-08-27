<?php
namespace App\Modules\Currency\Console;

use Illuminate\Console\Command;
use App\Modules\Currency\Services\CurrencyUpdater;


class UpdateRatesCommand extends Command
{
    protected $signature = 'currency:update-rates';
    protected $description = 'Update currency rates from freecurrencyapi.com';

    public function handle()
    {
        $updater = new CurrencyUpdater();
        $result = $updater->update();

        $this->info($result);
        return 0;
    }
}
