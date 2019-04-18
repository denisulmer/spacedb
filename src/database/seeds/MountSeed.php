<?php

use Illuminate\Database\Seeder;
use SpaceDB\Mount;

class MountSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(json_decode(file_get_contents('resources/mounts.json'), true) as $name => $details) {
            Mount::create(array_merge(['name' => $name], $details));
        }
    }
}
