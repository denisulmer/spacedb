<?php

namespace SpaceDB;

use Illuminate\Database\Eloquent\Model;

class Object extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function getRouteKey()
    {
        return str_slug($this->attributes['name']);
    }

    public function images()
    {
        return $this->belongsToMany(Image::class, 'image_object', 'object_id', 'image_id');
    }
}
