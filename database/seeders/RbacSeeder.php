<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Page;
use App\Models\Permission;
use App\Models\Role;
use App\Models\SiteSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RbacSeeder extends Seeder
{
    public function run(): void
    {
        $roleNames = ['super_admin', 'editor', 'support', 'seo'];
        $roles = [];

        foreach ($roleNames as $roleName) {
            $roles[$roleName] = Role::firstOrCreate(
                ['name' => $roleName],
                ['label' => ucfirst(str_replace('_', ' ', $roleName))]
            );
        }

        $permissionNames = [
            'manage_pages',
            'manage_blog',
            'manage_admins',
            'manage_roles',
            'manage_permissions',
        ];
        $permissions = [];

        foreach ($permissionNames as $permissionName) {
            $permissions[$permissionName] = Permission::firstOrCreate(
                ['name' => $permissionName],
                ['label' => ucfirst(str_replace('_', ' ', $permissionName))]
            );
        }

        $roles['super_admin']->permissions()->sync(array_map(
            fn ($permission) => $permission->id,
            $permissions
        ));

        $admin = Admin::firstOrCreate(
            ['email' => 'admin@hekaya.local'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password123'),
                'is_active' => true,
            ]
        );

        $admin->roles()->syncWithoutDetaching([$roles['super_admin']->id]);

        SiteSetting::query()->firstOrCreate([], [
            'site_name_ar' => 'Hekaya',
        ]);

        $defaultPages = ['home', 'about', 'services', 'team', 'why-us', 'faq', 'blog', 'contact'];
        foreach ($defaultPages as $index => $slug) {
            Page::query()->firstOrCreate(
                ['slug' => $slug],
                [
                    'title_ar' => strtoupper($slug),
                    'is_active' => true,
                    'sort_order' => $index,
                ]
            );
        }
    }
}
