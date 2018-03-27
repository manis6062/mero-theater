<?php

use Illuminate\Database\Seeder;

class admin_company_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('company_tbl')->insert([
            'admin_id' => 1,
            'company_name' => 'Demo Company',
            'vat_number' => '1234567890',
            'company_display_name' => 'Demo Company Pvt. Ltd.',
            'country' => 'Nepal',
            'timezone' => 'Asia/Kathmandu',
            'address1' => 'Ratopul, Kathmandu',
            'address2' => 'Gyaneshwor, Kathmandu',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
    }
}
