<?php

use Illuminate\Database\Seeder;

class admin_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('admin_tbl')->insert([
            'account_name' => 'Demo Admin',
            'title' => 'Admin for Test',
            'first_name' => 'Admin',
            'last_name' => 'Surname',
            'mobile' => '9800000000',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
    }
}
