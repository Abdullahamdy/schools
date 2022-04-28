<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(BloodTypeSedder::class);
        $this->call(NationaltySeeder::class);
        $this->call(ReligionSeeder::class);
        $this->call(Specailization::class);
        $this->call(Gender::class);
    }
}
