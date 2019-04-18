<?php

namespace SpaceDB;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property integer id
 * @property Builder images
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'admin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function astrometryJobs()
    {
        return $this->hasManyThrough(AstrometryJob::class, Image::class, 'user_id', 'image_id');
    }

    public function runningAstrometryJobs()
    {
        return $this->astrometryJobs()
            ->where('status', 'solving')->orWhere('status', 'processing');
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'user_id');
    }

    public function cameras()
    {
        return $this->belongsToMany(Camera::class, 'user_camera', 'user_id', 'camera_id')->withPivot('is_standard');
    }

    public function mounts()
    {
        return $this->belongsToMany(Mount::class, 'user_mount', 'user_id', 'mount_id')->withPivot('is_standard');
    }

    public function optics()
    {
        return $this->belongsToMany(Optics::class, 'user_optics', 'user_id', 'optics_id')->withPivot('is_standard');
    }

    public function hasStandardEquipment()
    {
        return $this->hasStandardCamera()
            && $this->hasStandardOptics();
    }

    public function hasStandardCamera()
    {
        return $this->cameras()->whereIsStandard(true)->count() > 0;
    }

    public function hasStandardOptics()
    {
        return $this->optics()->whereIsStandard(true)->count() > 0;
    }
}
