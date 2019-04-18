<?php

namespace SpaceDB;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer id
 * @property Image image
 * @property int status
 * @property int submission_id
 */
class AstrometryJob extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function image()
    {
        return $this->belongsTo(Image::class, 'image_id');
    }

    public function scopeRunning($query)
    {
        return $query->whereIn('status', [
            'pending_submission', 'submission_successful', 'job_found', 'processing', 'solving'
        ]);
    }

    public function getUrl()
    {
        return 'http://nova.astrometry.net/status/' . $this->attributes['submission_id'];
    }
}
