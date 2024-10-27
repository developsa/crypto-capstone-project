<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coin extends Model
{
    use HasFactory;

    protected $fillable=[
        'gecko_coin_id',
        'gecko_coin_name',
        'gecko_coin_current_price',
        'gecko_coin_image',
        'gecko_coin_symbol',
        'gecko_coin_market_cap',
        'gecko_coin_total_volume',
        'gecko_coin_high_24h',
        'gecko_coin_low_24h'
    ];

}
