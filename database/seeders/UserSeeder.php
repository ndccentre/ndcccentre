<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure roles exist
        Role::firstOrCreate(['name' => 'super_admin']);
        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'pastor']);
        Role::firstOrCreate(['name' => 'editor']);

        // Super Admin
        $superAdmin = User::updateOrCreate(
            ['email' => 'admin@ndpccenter.co.tz'],
            ['name' => 'Super Admin', 'password' => Hash::make('#Ndpcc@2026')]
        );
        $superAdmin->syncRoles(['super_admin']);

        // Normal Admin
        $admin = User::updateOrCreate(
            ['email' => 'info@ndpccenter.co.tz'],
            ['name' => 'Admin', 'password' => Hash::make('#Ndpcc@2026')]
        );
        $admin->syncRoles(['admin']);

        $this->command->info('Users created: admin@ndpccenter.co.tz (super_admin) & info@ndpccenter.co.tz (admin)');
    }
}
