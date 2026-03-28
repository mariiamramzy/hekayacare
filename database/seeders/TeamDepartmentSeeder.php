<?php

namespace Database\Seeders;

use App\Models\TeamDepartment;
use Illuminate\Database\Seeder;

class TeamDepartmentSeeder extends Seeder
{
    public function run(): void
    {
        $departments = [
            'الطب النفسي',
            'العلاج النفسي',
            'الدعم النفسي',
            'التعافي والإشراف العلاجي',
            'الاستشارات الأسرية',
        ];

        foreach ($departments as $index => $name) {
            TeamDepartment::query()->updateOrCreate(
                ['name_ar' => $name],
                ['sort_order' => $index + 1]
            );
        }
    }
}
