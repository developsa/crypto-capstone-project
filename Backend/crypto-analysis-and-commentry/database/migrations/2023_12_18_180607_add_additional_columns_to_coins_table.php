<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdditionalColumnsToCoinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('coins', function (Blueprint $table) {
            $table->string('gecko_coin_symbol')->after("gecko_coin_id");
            $table->string('gecko_coin_image')->after("gecko_coin_symbol");
            $table->double('gecko_coin_market_cap')->after('gecko_coin_name');
            $table->double('gecko_coin_total_volume')->after('gecko_coin_market_cap');
            $table->double('gecko_coin_high_24h')->after('gecko_coin_current_price');
            $table->double('gecko_coin_low_24h')->after('gecko_coin_high_24h');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('coins', function (Blueprint $table) {
            $table->dropColumn([
                'gecko_coin_image',
                'gecko_coin_symbol',
                'gecko_coin_market_cap',
                'gecko_coin_total_volume',
                'gecko_coin_high_24h',
                'gecko_coin_low_24h'
            ]);
        });
    }
}
