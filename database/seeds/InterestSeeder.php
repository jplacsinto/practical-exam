<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InterestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('interests')->insert([
            ['name' => 'Reading'],
            ['name' => 'Cooking'],
            ['name' => 'Watching TV'],
            ['name' => 'Basketball']
        ]);
    }
}
