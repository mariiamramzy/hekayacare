<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MacaryAdminSeeder extends Seeder
{
    public function run(): void
    {
        $superAdminRole = Role::query()->firstWhere('name', 'super_admin');

        $admin = Admin::query()->updateOrCreate(
            ['email' => 'macary@hekayacare.com'],
            [
                'name' => 'Macary',
                'password' => Hash::make('password123'),
                'is_active' => true,
            ]
        );

        if ($superAdminRole) {
            $admin->roles()->syncWithoutDetaching([$superAdminRole->id]);
        }
    }
}
