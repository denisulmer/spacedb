<?php

namespace SpaceDB;

use Illuminate\Database\Eloquent\Model;

class Optics extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function fullName()
    {
        return $this->name;
    }

    public function images()
    {
        return $this->belongsToMany(Image::class, 'image_optics', 'optics_id', 'image_id');
    }
}
