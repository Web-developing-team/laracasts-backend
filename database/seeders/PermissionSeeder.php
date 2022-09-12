<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::firstOrCreate(['name' => 'create-role']);
        Permission::firstOrCreate(['name' => 'view-role']);
        Permission::firstOrCreate(['name' => 'view-any-role']);
        Permission::firstOrCreate(['name' => 'update-role']);
        Permission::firstOrCreate(['name' => 'delete-role']);
    }
}
