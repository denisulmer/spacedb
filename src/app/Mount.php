<?php

namespace SpaceDB;

use Illuminate\Database\Eloquent\Model;

class Mount extends Model
{
    protected $guarded = ['id'];

    public $timestamps = false;

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class, 'manufacturer_id');
    }

    public function fullName()
    {
        return $this->manufacturer->name . ' ' . $this->name;
    }

    public function images()
    {
        return $this->belongsToMany(Image::class, 'image_mount', 'mount_id', 'image_id');
    }
}
