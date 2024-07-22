<?php

namespace App\Events;

use App\Models\Resources\Catalog;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CatalogCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;



    public $catalog;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Catalog $catalog)
    {

        $this->catalog = $catalog;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
//        return new PrivateChannel('catalog.'.$this->catalog->id);
    }
}
