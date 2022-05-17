<?php

namespace App\Providers;

use App\Models\Favorite;
use App\Models\Game;
use App\Models\Order;
use App\Observers\GameObserver;
use App\Observers\OrderObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Game::observe(GameObserver::class);
        Order::observe(OrderObserver::class);
    }
}
