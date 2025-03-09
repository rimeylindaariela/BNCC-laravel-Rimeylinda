<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Admin;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
            Admin::create([
                'admin_id'=> '1',
                'full_name' => 'Admin Name',
                'email' => 'admin@example.com',
                'password' => bcrypt('adminpassword'),
                'handphone' => '08',

            ]);
        }
        //
    
}

