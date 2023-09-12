<?php

namespace App\Listeners;

use App\Events\ArtistDiscovered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateRecordLabelAboutArtist
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ArtistDiscovered $event): void
    {
        info('Labels were informed');
    }
}
