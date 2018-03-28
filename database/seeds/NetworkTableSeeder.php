<?php

use Illuminate\Database\Seeder;

class NetworkTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('networks')->insert([
            [
                'name' => "Ncell",
                'number' => "980,981,982",
                'cost' => 1
            ],
            [
                'name' => "Ntc",
                'number' => "984,985,986",
                'cost' => 1
            ]
        ]);
    }
}
