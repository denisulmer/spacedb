<?php

namespace SpaceDB\Events\Image;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use SpaceDB\AstrometryJob;

class ImageUploaded
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /*
     * The uploaded image.
     *
     * @var Image
     */
    public $astrometryJob;

    /**
     * Create a new event instance.
     * @param AstrometryJob $astrometryJob
     */
    public function __construct(AstrometryJob $astrometryJob)
    {
        $this->astrometryJob = $astrometryJob;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
