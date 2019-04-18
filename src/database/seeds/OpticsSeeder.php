<?php

use Illuminate\Database\Seeder;
use SpaceDB\Optics;

class OpticsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(json_decode(file_get_contents('resources/optics.json'), true) as $name => $details) {
            Optics::create(array_merge(['name' => $name], $details));
        }
    }
}
