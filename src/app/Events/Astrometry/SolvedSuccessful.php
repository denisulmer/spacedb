<?php

namespace SpaceDB\Events\Astrometry;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use SpaceDB\AstrometryJob;

class SolvedSuccessful implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var AstrometryJob
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
        return new PrivateChannel('astrometry.' . $this->astrometryJob->image->owner->id);
    }

    public function broadcastWith()
    {
        return [
            'status' => trans('astrometry.' . $this->astrometryJob->status),
            'site_url' => route('image', $this->astrometryJob->image),
            'name' => $this->astrometryJob->image->name,
            'ra' => formatDegrees($this->astrometryJob->ra),
            'dec' => formatDegrees($this->astrometryJob->dec),
            'scale' => formatPixelScale($this->astrometryJob->pixel_scale),
            'toast' => trans('astrometry.solved_successful', ['name' => $this->astrometryJob->image->name])
        ];
    }
}
