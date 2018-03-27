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
         $this->call(admin_table_seeder::class);
         $this->call(admin_company_table_seeder::class);
    }
}
