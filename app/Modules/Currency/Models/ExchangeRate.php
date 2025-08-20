<?php

namespace App\Modules\Currency\Models;

use Illuminate\Database\Eloquent\Model;

class ExchangeRate extends Model
{
    protected $table = 'exchange_rates';

    protected $fillable = [
        'currency_from',
        'currency_to',
        'rate',
        'date',
    ];

    protected $dates = [
        'date',
    ];

    public function fromCurrency()
    {
        return $this->belongsTo(Currency::class, 'currency_from', 'code');
    }

    public function toCurrency()
    {
        return $this->belongsTo(Currency::class, 'currency_to', 'code');
    }
}
