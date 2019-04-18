<?php

namespace SpaceDB;

use Illuminate\Database\Eloquent\Model;

/**
 * @property User owner
 * @property string name
 */
class Image extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function astrometryJobs()
    {
        return $this->hasMany(AstrometryJob::class, 'image_id');
    }

    public function objects()
    {
        return $this->belongsToMany(Object::class, 'image_object', 'image_id', 'object_id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function cameras()
    {
        return $this->belongsToMany(Camera::class, 'image_camera', 'image_id', 'camera_id');
    }

    public function mounts()
    {
        return $this->belongsToMany(Mount::class, 'image_mount', 'image_id', 'mount_id');
    }

    public function optics()
    {
        return $this->belongsToMany(Optics::class, 'image_optics', 'image_id', 'optics_id');
    }

    public function getAspectRatioAttribute()
    {
        return $this->attributes['height'] / $this->attributes['width'];
    }

    public function getUrl($filter)
    {
        if ($this->name == 'import_from_astrobin') {
            return $this->filename;
        } else {
            return config('app.url') . '/' . config('imagecache.route') . '/'. $filter . '/' . $this->attributes['filename'];
        }
    }

    public function plateSolveUrl()
    {
        if (env('APP_ENV') === 'local') {
            return 'https://i.redd.it/l8945i2nb77z.jpg';
        }
        return config('app.url') . '/' . config('imagecache.route') . '/'. config('astrometry.imagecache.filter') . '/' . $this->attributes['filename'];
    }
}
