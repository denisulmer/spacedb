<?php

namespace SpaceDB;

use Illuminate\Database\Eloquent\Model;

class Camera extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_camera', 'camera_id', 'user_id');
    }

    public function fullName()
    {
        return $this->name;
    }
    public function images()
    {
        return $this->belongsToMany(Image::class, 'image_camera', 'camera_id', 'image_id');
    }
}
