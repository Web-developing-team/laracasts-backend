<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::firstOrCreate([
            'username' => 'super_admin',
            'password' => 'password',
            'email' => 'admin@admin.com'
        ]);

        Admin::factory()->count(10000)->create();
    }
}
