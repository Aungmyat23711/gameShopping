<?php

namespace App\Listeners;

use App\Events\Orderplaced;
use App\Models\Game;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Route;

class UpdateInventoryAboutOrder
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\Orderplaced  $event
     * @return void
     */
    public function handle(Orderplaced $event)
    {
        $game = Game::where('id', $event->order['id']);
        $game->update(['qty' => $event->order['qoh']]);
    }
}
