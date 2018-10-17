<?php

use Illuminate\Database\Seeder;

class TouristsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Tourist::class, 30)->create();
    }
}
