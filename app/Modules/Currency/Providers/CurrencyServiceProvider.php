<?php

namespace App\Modules\Currency\Providers;

use App\Modules\Currency\Console\UpdateRatesCommand;
use Illuminate\Support\ServiceProvider;

class CurrencyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                UpdateRatesCommand::class,
            ]);
        }
    }

    public function boot(): void
    {
        // Path to views
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'currency');

        $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');
    }
}
