<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Coin;

class GeckoController extends Controller
{
    public function saveGeckoData()
    {
        $response = Http::get(env('CRYPTO_API_URL'));

        $geckoDatas = json_decode($response->body()); // API array

        foreach ($geckoDatas as $geckoData) {

            $coin = Coin::updateOrCreate(
                ['gecko_coin_id' => $geckoData->id],
                [
                    'gecko_coin_name' => $geckoData->name,
                    'gecko_coin_symbol' => $geckoData->symbol,
                    'gecko_coin_image' => $geckoData->image,
                    'gecko_coin_market_cap' => $geckoData->market_cap,
                    'gecko_coin_total_volume' => $geckoData->total_volume,
                    'gecko_coin_current_price' => $geckoData->current_price,
                    'gecko_coin_high_24h' => $geckoData->high_24h,
                    'gecko_coin_low_24h' => $geckoData->low_24h,


                ]
            );
        }
        if ($coin) {
            return response()->json(["message" => "Datas succesfly save"], 200);
        } else {
            return response()->json(["message" => "Datas not save"], 500);
        }
    }
}
