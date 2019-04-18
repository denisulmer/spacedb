<?php

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ManufacturerSeed::class);
        $this->call(MountSeed::class);
        $this->call(OpticsSeeder::class);
        $this->call(CameraSeeder::class);
    }
}
