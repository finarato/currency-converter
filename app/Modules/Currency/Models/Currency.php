<?php

namespace App\Modules\Currency\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $table = 'currencies';

    protected $fillable = [
        'code',
        'name',
    ];

    public function exchangeRates()
    {
        return $this->hasMany(ExchangeRate::class, 'currency_from', 'code');
    }
}
