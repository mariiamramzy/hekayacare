<?php

namespace Database\Seeders;

use App\Models\Media;
use App\Models\PortfolioCase;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PortfolioCaseSeeder extends Seeder
{
    public function run(): void
    {
        $cases = [
            [
                'title_ar' => 'أسس التعافي والشفاء',
                'card_sub_title' => 'أسس التعافي والشفاء',
                'excerpt_ar' => 'رحلة تعافٍ اعتمدت على الرعاية الشخصية والدعم المستمر والالتزام طويل الأمد.',
                'cover_image' => 'images/project/portfolio-2-3.webp',
                'main_image' => 'images/services/services-1-3.webp',
                'intro_heading' => 'رعاية شخصية، دعم مستمر، والتزام طويل الأمد',
                'intro_text' => 'التغلب على الإدمان ليس رحلة موحدة؛ بل يتطلب رعاية شخصية، ودعمًا متواصلًا، وبيئة آمنة وواعية. صُممت برامج التعافي لمعالجة التحديات الجسدية والعاطفية والنفسية الفريدة التي يواجهها كل فرد. في مركزنا نؤمن بمعالجة الشخص بأكمله وليس مجرد الإدمان.'."\n\n".'تجمع برامجنا بين الإرشاد الفردي، العلاج الجماعي، تخطيط نمط الحياة الصحي، ودعم الرعاية اللاحقة لضمان النجاح على المدى الطويل وبناء حياة أكثر استقرارًا.',
                'secondary_image' => 'images/services/services-2-1.webp',
                'points_heading' => 'الرعاية الشمولية المتكاملة',
                'points_text' => 'نؤمن بأن الشفاء الحقيقي يتجاوز مجرد التعافي الجسدي، لذلك ندمج الدعم النفسي والاجتماعي مع الخطة العلاجية.',
                'point_one_ar' => 'نهج شفاء شامل يدمج الصحة النفسية مع خطة العلاج.',
                'point_two_ar' => 'إرشاد مستمر ومتابعة مهنية احترافية على مدار المراحل المختلفة.',
                'point_three_ar' => 'خطط رعاية شخصية مصاغة لتناسب الاحتياج الفعلي لكل حالة.',
                'closing_text' => 'الرعاية طويلة الأمد تتجاوز فترة العلاج الأساسية؛ إنها التزام بالصحة والتعافي المستمر. نوفر دعمًا متواصلًا ومتابعات منتظمة وموارد تساعد على الحفاظ على التقدم ومنع الانتكاس.',
                'case_label' => 'أسس التعافي..',
                'started_at' => '2025-04-10',
                'location_ar' => 'القاهرة',
                'client_name_ar' => 'حسين . م',
                'duration_ar' => '8 أشهر',
                'sidebar_image' => 'images/project/portfolio-2-3.webp',
                'sort_order' => 1,
            ],
            [
                'title_ar' => 'رحلة استعادة التوازن النفسي',
                'card_sub_title' => 'رحلة استعادة التوازن النفسي',
                'excerpt_ar' => 'حالة تعافٍ ركزت على استعادة الهدوء النفسي والقدرة على إدارة الضغوط اليومية.',
                'cover_image' => 'images/project/portfolio-2-1.webp',
                'main_image' => 'images/services/services-1-1.webp',
                'intro_heading' => 'من التوتر المستمر إلى الهدوء والثبات',
                'intro_text' => 'بدأت الرحلة مع شعور متكرر بالضغط والتشتت وعدم القدرة على تنظيم الحياة اليومية. من خلال برنامج علاجي متدرج وجلسات دعم منتظمة، تم بناء مسار واضح يساعد على الفهم الأعمق للمشاعر وتغيير أنماط الاستجابة السلبية.'."\n\n".'اعتمدت الخطة على التوازن بين الدعم النفسي والروتين الصحي والالتزام بالمتابعة، ما ساعد على استعادة الشعور بالأمان الداخلي والثقة بالنفس.',
                'secondary_image' => 'images/services/services-2-2.webp',
                'points_heading' => 'خطوات استعادة الاتزان',
                'points_text' => 'الهدف لم يكن فقط تجاوز الأزمة، بل بناء أدوات عملية للاستمرار بشكل صحي بعد انتهاء المرحلة المكثفة.',
                'point_one_ar' => 'جلسات علاج منتظمة لفهم المحفزات النفسية وإدارتها.',
                'point_two_ar' => 'روتين يومي مرن يدعم النوم والهدوء والتنظيم.',
                'point_three_ar' => 'متابعة لاحقة للحفاظ على التقدم وتقليل فرص الانتكاس.',
                'closing_text' => 'مع الوقت أصبح التعامل مع الضغوط أكثر وعيًا وهدوءًا، وتحولت الرحلة إلى تجربة تعافٍ متوازنة تدعم الاستقرار طويل المدى.',
                'case_label' => 'استعادة التوازن',
                'started_at' => '2025-02-18',
                'location_ar' => 'الجيزة',
                'client_name_ar' => 'محمود . س',
                'duration_ar' => '6 أشهر',
                'sidebar_image' => 'images/project/portfolio-2-1.webp',
                'sort_order' => 2,
            ],
            [
                'title_ar' => 'خطوات الثبات بعد العلاج',
                'card_sub_title' => 'خطوات الثبات بعد العلاج',
                'excerpt_ar' => 'قصة تُبرز أهمية المتابعة والرعاية اللاحقة بعد انتهاء البرنامج العلاجي الأساسي.',
                'cover_image' => 'images/project/portfolio-2-2.webp',
                'main_image' => 'images/services/services-1-2.webp',
                'intro_heading' => 'ما بعد العلاج هو بداية الثبات الحقيقي',
                'intro_text' => 'بعد انتهاء المرحلة الأساسية من العلاج، يبدأ التحدي الحقيقي في الحفاظ على النتائج والعودة للحياة اليومية بثبات. لذلك تم تصميم خطة متابعة تركز على الاستمرارية، وإدارة التحديات الجديدة، وتثبيت المهارات المكتسبة أثناء العلاج.'."\n\n".'ساهمت الجلسات الدورية والدعم الأسري وتخطيط الأهداف الصغيرة في تحويل التعافي إلى أسلوب حياة وليس مجرد مرحلة مؤقتة.',
                'secondary_image' => 'images/services/services-2-3.webp',
                'points_heading' => 'عوامل الثبات المستمر',
                'points_text' => 'الثبات يحتاج إلى رؤية واضحة وأدوات عملية، وليس فقط إلى الإرادة وحدها.',
                'point_one_ar' => 'خطة متابعة دورية ومراجعة مستمرة للتقدم.',
                'point_two_ar' => 'إشراك الأسرة في الدعم بطريقة صحية ومتوازنة.',
                'point_three_ar' => 'التركيز على بناء عادات يومية تساعد على الاستقرار.',
                'closing_text' => 'المتابعة بعد العلاج منحت هذه الحالة مساحة آمنة للاستمرار والنمو، وأكدت أن التعافي رحلة تحتاج إلى رعاية ممتدة وليست خطوة واحدة.',
                'case_label' => 'الثبات بعد العلاج',
                'started_at' => '2025-01-22',
                'location_ar' => 'أكتوبر',
                'client_name_ar' => 'أحمد . ع',
                'duration_ar' => '7 أشهر',
                'sidebar_image' => 'images/project/portfolio-2-2.webp',
                'sort_order' => 3,
            ],
            [
                'title_ar' => 'دعم الأسرة في رحلة التعافي',
                'card_sub_title' => 'دعم الأسرة في رحلة التعافي',
                'excerpt_ar' => 'رحلة تعافٍ كان فيها إشراك الأسرة عنصرًا أساسيًا في نجاح الخطة العلاجية.',
                'cover_image' => 'images/project/portfolio-2-4.webp',
                'main_image' => 'images/services/services-1-3.webp',
                'intro_heading' => 'حين تصبح الأسرة جزءًا من الحل',
                'intro_text' => 'في هذه الحالة كان للدعم الأسري المنظم أثر كبير في تعزيز الاستقرار وإعادة بناء الثقة. لم يقتصر الأمر على دعم عاطفي فقط، بل شمل فهمًا أعمق لطبيعة الحالة وكيفية التعامل معها يوميًا بطريقة صحية.'."\n\n".'من خلال جلسات الإرشاد الأسري وخطة واضحة للتواصل وحدود الدعم، أصبحت الأسرة عنصر مساندة فعّالًا بدلًا من أن تكون جزءًا من التوتر أو الضغط.',
                'secondary_image' => 'images/services/services-2-1.webp',
                'points_heading' => 'الأسرة كعامل حماية',
                'points_text' => 'الإشراك الصحيح للأسرة يساعد على ترسيخ الشعور بالأمان والانتماء ويقوي القدرة على الاستمرار.',
                'point_one_ar' => 'جلسات توعية للأسرة حول طبيعة الحالة واحتياجاتها.',
                'point_two_ar' => 'بناء أساليب تواصل صحية داخل المنزل.',
                'point_three_ar' => 'تقليل الصراعات اليومية التي كانت تعرقل التعافي.',
                'closing_text' => 'بمرور الوقت تحولت العلاقة الأسرية إلى مساحة أكثر دعمًا واحتواءً، ما انعكس مباشرة على ثبات الحالة وتحسنها المستمر.',
                'case_label' => 'دعم الأسرة',
                'started_at' => '2025-03-05',
                'location_ar' => 'القاهرة الجديدة',
                'client_name_ar' => 'سارة . ن',
                'duration_ar' => '5 أشهر',
                'sidebar_image' => 'images/project/portfolio-2-4.webp',
                'sort_order' => 4,
            ],
            [
                'title_ar' => 'بداية جديدة أكثر أمانًا',
                'card_sub_title' => 'بداية جديدة أكثر أمانًا',
                'excerpt_ar' => 'قصة تعافٍ ركزت على بناء نمط حياة جديد أكثر أمانًا واستقرارًا بعد المرور بأزمة حادة.',
                'cover_image' => 'images/project/portfolio-2-5.webp',
                'main_image' => 'images/services/services-1-1.webp',
                'intro_heading' => 'إعادة بناء الحياة بخطوات ثابتة',
                'intro_text' => 'بعد المرور بفترة صعبة، احتاجت الحالة إلى بداية جديدة تعتمد على الأمان والاستقرار أكثر من أي شيء آخر. تم العمل على إعادة تنظيم الحياة اليومية وبناء أهداف بسيطة قابلة للتحقق، مع توفير دعم نفسي مستمر يواكب كل مرحلة.'."\n\n".'هذا النهج ساعد على استعادة الإحساس بالقدرة والسيطرة، وخلق مساحة آمنة للبدء من جديد دون ضغط أو توقعات غير واقعية.',
                'secondary_image' => 'images/services/services-2-2.webp',
                'points_heading' => 'مرتكزات البداية الجديدة',
                'points_text' => 'كل خطوة صغيرة كانت جزءًا من بناء أوسع يهدف إلى حياة أكثر أمانًا واتزانًا.',
                'point_one_ar' => 'إعادة تنظيم الروتين اليومي بشكل يناسب الحالة.',
                'point_two_ar' => 'التركيز على أهداف قصيرة المدى قابلة للتحقق.',
                'point_three_ar' => 'دعم مهني مستمر لتثبيت الشعور بالأمان والثقة.',
                'closing_text' => 'النتيجة كانت بداية أكثر هدوءًا ونضجًا، مع قدرة أكبر على الاستمرار واتخاذ قرارات صحية تدعم التعافي طويل الأجل.',
                'case_label' => 'بداية جديدة',
                'started_at' => '2025-05-14',
                'location_ar' => 'المعادي',
                'client_name_ar' => 'ندى . ر',
                'duration_ar' => '4 أشهر',
                'sidebar_image' => 'images/project/portfolio-2-5.webp',
                'sort_order' => 5,
            ],
        ];

        foreach ($cases as $case) {
            $slug = Str::slug($case['title_ar']);
            if ($slug === '') {
                $slug = 'portfolio-case-'.($case['sort_order'] ?? 0);
            }

            PortfolioCase::query()->updateOrCreate(
                ['slug' => $slug],
                [
                    'title_ar' => $case['title_ar'],
                    'card_sub_title' => $case['card_sub_title'],
                    'excerpt_ar' => $case['excerpt_ar'],
                    'cover_media_id' => $this->storeMedia($case['cover_image'], $case['title_ar'].' cover'),
                    'main_media_id' => $this->storeMedia($case['main_image'], $case['title_ar'].' main'),
                    'intro_heading' => $case['intro_heading'],
                    'intro_text' => $case['intro_text'],
                    'secondary_media_id' => $this->storeMedia($case['secondary_image'], $case['title_ar'].' secondary'),
                    'points_heading' => $case['points_heading'],
                    'points_text' => $case['points_text'],
                    'point_one_ar' => $case['point_one_ar'],
                    'point_two_ar' => $case['point_two_ar'],
                    'point_three_ar' => $case['point_three_ar'],
                    'closing_text' => $case['closing_text'],
                    'case_label' => $case['case_label'],
                    'started_at' => $case['started_at'],
                    'location_ar' => $case['location_ar'],
                    'client_name_ar' => $case['client_name_ar'],
                    'duration_ar' => $case['duration_ar'],
                    'sidebar_media_id' => $this->storeMedia($case['sidebar_image'], $case['title_ar'].' sidebar'),
                    'sort_order' => $case['sort_order'],
                    'is_active' => true,
                ]
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
        $targetPath = 'portfolio/seeded/'.$filename;

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
