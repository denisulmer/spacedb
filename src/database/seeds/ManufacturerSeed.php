<?php

use Illuminate\Database\Seeder;
use SpaceDB\Manufacturer;

class ManufacturerSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(json_decode(file_get_contents('resources/manufacturers.json'), true) as $name) {
            Manufacturer::create(array_merge(['name' => $name]));
        }
    }
}
