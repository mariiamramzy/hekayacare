<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RbacSeeder::class,
            MacaryAdminSeeder::class,
            ServiceSeeder::class,
            FaqSeeder::class,
            BlogPostSeeder::class,
            GalleryImageSeeder::class,
            PortfolioCaseSeeder::class,
            TeamDepartmentSeeder::class,
            TeamMemberSeeder::class,
            WebsiteSeoMetaSeeder::class,
        ]);
    }
}
