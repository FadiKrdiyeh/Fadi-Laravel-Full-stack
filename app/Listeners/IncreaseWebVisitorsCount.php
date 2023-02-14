<?php

namespace App\Listeners;

use App\Events\WebVisitors;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class IncreaseWebVisitorsCount
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
     * @param  object  $event
     * @return void
     */
    public function handle(WebVisitors $event)
    {
        if(!session() -> has('webIsVisited')){
            $this -> updateVisitors($event -> visitors);
        }
    }

    function updateVisitors($visitors) {
        $visitors -> total_visitors += 1;
        $visitors -> save();
        session() -> put('webIsVisited', true);
    }
}
