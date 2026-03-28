<?php

namespace Database\Seeders;

use App\Models\Media;
use App\Models\TeamDepartment;
use App\Models\TeamMember;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class TeamMemberSeeder extends Seeder
{
    public function run(): void
    {
        $departments = [
            'الطب النفسي' => 1,
            'العلاج النفسي' => 2,
            'الدعم النفسي' => 3,
            'التعافي والإشراف العلاجي' => 4,
            'الاستشارات الأسرية' => 5,
        ];

        $departmentModels = [];
        foreach ($departments as $name => $sortOrder) {
            $departmentModels[$name] = TeamDepartment::query()->firstOrCreate(
                ['name_ar' => $name],
                ['sort_order' => $sortOrder]
            );
        }

        $members = [
            [
                'name_ar' => 'أ. الشيماء الهلالي',
                'title_ar' => 'أخصائي نفسي إكلينيكي',
                'specialty_ar' => 'العلاج السلوكي المعرفي والتحليل السلوكي التطبيقي',
                'bio_ar' => "ماجستير تحليل سلوكي تطبيقي جامعة أريزونا\nدبلومة صعوبات تعلم جامعة القاهرة\nدبلومة إعاقة سمعية جامعة القاهرة\nطرق العلاج: CBT, DBT, ACT",
                'image' => 'images/team/الشيماء-الهلالي.webp',
                'departments' => ['العلاج النفسي'],
                'sort_order' => 1,
            ],
            [
                'name_ar' => 'أ. مارلين صفوت',
                'title_ar' => 'مشيرة نفسية',
                'specialty_ar' => 'مدربة تعافي متخصصة في السلوكيات الإدمانية',
                'bio_ar' => 'مدربة تعافي متخصصة في السلوكيات الإدمانية وتقديم الإرشاد النفسي والدعم المستمر خلال رحلة التعافي.',
                'image' => 'images/team/مارلين-صفوت.webp',
                'departments' => ['التعافي والإشراف العلاجي'],
                'sort_order' => 2,
            ],
            [
                'name_ar' => 'د. كريمة مختار',
                'title_ar' => 'أخصائي نفسي وعلاج إدمان',
                'specialty_ar' => 'الصحة النفسية والعلاج الإكلينيكي',
                'bio_ar' => "ماجستير في الصحة النفسية\nدكتوراه في علم النفس الإكلينيكي",
                'image' => 'images/team/كريمة-مختار.webp',
                'departments' => ['العلاج النفسي'],
                'sort_order' => 3,
            ],
            [
                'name_ar' => 'أ. مكاري نعيم',
                'title_ar' => 'المؤسس والرئيس التنفيذي',
                'specialty_ar' => 'مشير نفسي متخصص في تأهيل السلوكيات الإدمانية',
                'bio_ar' => 'المؤسس والرئيس التنفيذي، ومشير نفسي متخصص في تأهيل السلوكيات الإدمانية ووضع برامج التعافي المتكاملة.',
                'image' => 'images/team/مكاري-نعيم.webp',
                'departments' => ['التعافي والإشراف العلاجي'],
                'sort_order' => 4,
            ],
            [
                'name_ar' => 'أ. أحمد صبري',
                'title_ar' => 'أخصائي نفسي',
                'specialty_ar' => 'علاج السلوكيات الإدمانية والمشورة الأسرية',
                'bio_ar' => "علاج السلوكيات الإدمانية\nجلسات المشورة الأسرية\nجلسات المشورة الزوجية",
                'image' => 'images/team/احمد-صبري.webp',
                'departments' => ['العلاج النفسي', 'الاستشارات الأسرية'],
                'sort_order' => 5,
            ],
            [
                'name_ar' => 'د. شيماء عبد اللطيف',
                'title_ar' => 'استشاري أمراض المخ والأعصاب والطب النفسي وعلاج الإدمان',
                'specialty_ar' => 'العلاقات الزوجية واضطرابات الشخصية في المراهقين',
                'bio_ar' => "استشاري علاقات زوجية\nاستشاري علاج اضطرابات الشخصية في المراهقين",
                'image' => 'images/team/شيما-عبداللطيف.webp',
                'departments' => ['الطب النفسي', 'الاستشارات الأسرية'],
                'sort_order' => 6,
            ],
            [
                'name_ar' => 'أ. لورا سليمان',
                'title_ar' => 'أخصائية دعم نفسي',
                'specialty_ar' => 'الدعم النفسي الفردي والجماعي',
                'bio_ar' => "استشارات متنوعة في الصحة النفسية\nجلسات الدعم النفسي\nمتابعة الحالات في المراحل المختلفة",
                'image' => 'images/team/لورا-سليمان.webp',
                'departments' => ['الدعم النفسي'],
                'sort_order' => 7,
            ],
        ];

        foreach ($members as $memberData) {
            $mediaId = $this->storeMedia($memberData['image'], $memberData['name_ar']);

            $member = TeamMember::query()->updateOrCreate(
                ['name_ar' => $memberData['name_ar']],
                [
                    'title_ar' => $memberData['title_ar'],
                    'specialty_ar' => $memberData['specialty_ar'],
                    'bio_ar' => $memberData['bio_ar'],
                    'photo_media_id' => $mediaId,
                    'sort_order' => $memberData['sort_order'],
                    'is_active' => true,
                ]
            );

            $member->departments()->sync(
                collect($memberData['departments'])
                    ->map(fn (string $name) => $departmentModels[$name]->id)
                    ->all()
            );
        }
    }

    protected function storeMedia(string $publicRelativePath, string $altText): ?int
    {
        $sourcePath = public_path($publicRelativePath);

        if (! File::exists($sourcePath)) {
            return null;
        }

        $filename = basename($publicRelativePath);
        $targetPath = 'team/seeded/'.$filename;

        if (! Storage::disk('public')->exists($targetPath)) {
            Storage::disk('public')->put($targetPath, File::get($sourcePath));
        }

        $media = Media::query()->firstOrCreate(
            ['disk' => 'public', 'path' => $targetPath],
            [
                'filename' => $filename,
                'mime_type' => File::mimeType($sourcePath),
                'size' => File::size($sourcePath),
                'alt_text' => $altText,
            ]
        );

        if (! $media->alt_text) {
            $media->update(['alt_text' => $altText]);
        }

        return $media->id;
    }
}
