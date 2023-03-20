<?php

namespace App\Events;

use App\Models\Delivery;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DeliveryLocationUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $lat;
    public $lng;
    protected $delivery;
    public function __construct(Delivery $delivery , $lat  , $lng )
    {
        $this->delivery = $delivery;
        $this->lat = $lat;
        $this->lng = $lng;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        //Public Channel
        // return new Channel('deliveries');
        //Private Channel
        return new PrivateChannel('deliveries.'.$this->delivery->order_id);
    }
    //Send Data to Send
    public function broadcastWith(){
        return [
            'lat' => $this->lat,
            'lng' => $this->lng,
        ];
    }
    public function broadcastAs(){
        return 'location-updated';
    }
}
