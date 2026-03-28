<?php

namespace Database\Seeders;

use App\Models\Faq;
use App\Models\FaqCategory;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $psychologicalTherapyCategory = FaqCategory::query()->firstOrCreate(
            ['name_ar' => 'العلاج النفسي'],
            ['sort_order' => 1]
        );

        $faqs = [
            [
                'question_ar' => 'ما هو العلاج النفسي؟',
                'answer_ar' => 'العلاج النفسي هو جلسات منتظمة مع أخصائي تساعد الشخص على فهم مشاعره وأفكاره وسلوكياته، والتعامل مع القلق أو الاكتئاب أو الضغوط أو الصدمات بطريقة صحية وآمنة.',
            ],
            [
                'question_ar' => 'متى أحتاج إلى بدء العلاج النفسي؟',
                'answer_ar' => 'يُنصح ببدء العلاج النفسي عندما تؤثر المشاعر أو الأفكار أو الضغوط على النوم أو العلاقات أو العمل أو الدراسة، أو عندما يشعر الشخص بأنه غير قادر على التعامل مع مشكلاته وحده.',
            ],
            [
                'question_ar' => 'هل العلاج النفسي يعني أنني أعاني من مرض خطير؟',
                'answer_ar' => 'لا، العلاج النفسي لا يعني بالضرورة وجود مرض خطير. كثير من الناس يلجؤون إليه لتحسين جودة حياتهم، وتنظيم مشاعرهم، وتجاوز الأزمات، واكتساب مهارات أفضل في التعامل مع التحديات.',
            ],
            [
                'question_ar' => 'كم تستغرق جلسات العلاج النفسي؟',
                'answer_ar' => 'مدة الجلسة غالبًا تكون بين 45 و60 دقيقة، أما عدد الجلسات فيختلف من شخص لآخر حسب طبيعة المشكلة والأهداف العلاجية ومدى الاستجابة للخطة العلاجية.',
            ],
            [
                'question_ar' => 'هل ما أقوله في الجلسات يظل سريًا؟',
                'answer_ar' => 'نعم، السرية جزء أساسي من العلاج النفسي. كل ما يُذكر داخل الجلسات يظل محفوظًا بسرية تامة وفق الأصول المهنية، ما لم توجد حالة تستدعي التدخل لحماية الشخص أو الآخرين.',
            ],
        ];

        foreach ($faqs as $index => $faqData) {
            $faq = Faq::query()->firstOrCreate(
                ['question_ar' => $faqData['question_ar']],
                [
                    'answer_ar' => $faqData['answer_ar'],
                    'sort_order' => $index + 1,
                    'is_active' => true,
                    'is_featured' => $index < 3,
                ]
            );

            $faq->update([
                'answer_ar' => $faqData['answer_ar'],
                'sort_order' => $index + 1,
                'is_active' => true,
                'is_featured' => $index < 3,
            ]);

            $faq->categories()->syncWithoutDetaching([$psychologicalTherapyCategory->id]);
        }
    }
}
