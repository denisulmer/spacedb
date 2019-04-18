<?php

use Illuminate\Database\Seeder;
use SpaceDB\Camera;

class CameraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(json_decode(file_get_contents('resources/cameras.json'), true) as $name => $details) {
            Camera::create(array_merge(['name' => $name], $details));
        }
    }
}
