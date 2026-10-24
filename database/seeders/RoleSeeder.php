<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::updateOrCreate(['name' => 'user']);
        Role::updateOrCreate(['name' => 'personnel']);
        Role::updateOrCreate(['name' => 'admin']);
        Role::updateOrCreate(['name' => 'superadmin']);
    }
}