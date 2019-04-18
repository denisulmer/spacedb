<?php

namespace SpaceDB;

use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    protected $guarded = ['id'];

    public $timestamps = false;

    public function mounts()
    {
        return $this->hasMany(Mount::class, 'manufacturer_id');
    }
}
