@extends('admin.layout')

@section('title', $title)

@php
    $values = [
        'meta_title_ar' => old('meta_title_ar', $seoMeta?->meta_title_ar),
        'meta_description_ar' => old('meta_description_ar', $seoMeta?->meta_description_ar),
        'meta_keywords_ar' => old('meta_keywords_ar', $seoMeta?->meta_keywords_ar),
        'canonical_url' => old('canonical_url', $seoMeta?->canonical_url),
        'robots' => old('robots', $seoMeta?->robots),
        'og_title_ar' => old('og_title_ar', $seoMeta?->og_title_ar),
        'og_description_ar' => old('og_description_ar', $seoMeta?->og_description_ar),
        'og_type' => old('og_type', $seoMeta?->og_type),
        'og_url' => old('og_url', $seoMeta?->og_url),
        'og_site_name' => old('og_site_name', $seoMeta?->og_site_name),
        'twitter_card' => old('twitter_card', $seoMeta?->twitter_card),
        'twitter_title_ar' => old('twitter_title_ar', $seoMeta?->twitter_title_ar),
        'twitter_description_ar' => old('twitter_description_ar', $seoMeta?->twitter_description_ar),
        'schema_json_text' => old('schema_json_text', $seoMeta && $seoMeta->schema_json ? json_encode($seoMeta->schema_json, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) : ''),
    ];

    $scoreField = function (string $field, mixed $value) use ($seoMeta) {
        $text = is_string($value) ? trim($value) : $value;
        $length = is_string($text) ? mb_strlen($text) : 0;

        return match ($field) {
            'meta_title_ar', 'og_title_ar', 'twitter_title_ar' => match (true) {
                $length === 0 => ['score' => 0, 'label' => 'Missing', 'tone' => 'danger', 'hint' => 'Recommended 50-60 chars'],
                $length >= 50 && $length <= 60 => ['score' => 100, 'label' => 'Excellent', 'tone' => 'success', 'hint' => 'Ideal title length'],
                $length >= 35 && $length <= 70 => ['score' => 75, 'label' => 'Good', 'tone' => 'warning', 'hint' => 'Acceptable but can be optimized'],
                default => ['score' => 45, 'label' => 'Weak', 'tone' => 'danger', 'hint' => 'Too short or too long'],
            },
            'meta_description_ar', 'og_description_ar', 'twitter_description_ar' => match (true) {
                $length === 0 => ['score' => 0, 'label' => 'Missing', 'tone' => 'danger', 'hint' => 'Recommended 120-160 chars'],
                $length >= 120 && $length <= 160 => ['score' => 100, 'label' => 'Excellent', 'tone' => 'success', 'hint' => 'Ideal description length'],
                $length >= 90 && $length <= 180 => ['score' => 75, 'label' => 'Good', 'tone' => 'warning', 'hint' => 'Usable but can be tightened'],
                default => ['score' => 45, 'label' => 'Weak', 'tone' => 'danger', 'hint' => 'Too short or too long'],
            },
            'meta_keywords_ar' => match (true) {
                empty($text) => ['score' => 0, 'label' => 'مفقود', 'tone' => 'danger', 'hint' => 'أضف كلمات مفتاحية مفصولة بفواصل'],
                str_contains((string) $text, ',') => ['score' => 80, 'label' => 'جيد', 'tone' => 'success', 'hint' => 'الكلمات المفتاحية تبدو منظمة'],
                default => ['score' => 50, 'label' => 'ضعيف', 'tone' => 'warning', 'hint' => 'استخدم فواصل بين الكلمات المفتاحية'],
            },
            'canonical_url', 'og_url' => filter_var($text, FILTER_VALIDATE_URL)
                ? ['score' => 100, 'label' => 'Valid', 'tone' => 'success', 'hint' => 'URL is valid']
                : ['score' => empty($text) ? 0 : 40, 'label' => empty($text) ? 'Missing' : 'Invalid', 'tone' => empty($text) ? 'danger' : 'warning', 'hint' => 'Use a full valid URL'],
            'robots' => match (true) {
                empty($text) => ['score' => 0, 'label' => 'Missing', 'tone' => 'danger', 'hint' => 'Example: index,follow'],
                in_array(strtolower((string) $text), ['index,follow', 'noindex,nofollow', 'index,nofollow', 'noindex,follow'], true)
                    => ['score' => 100, 'label' => 'Valid', 'tone' => 'success', 'hint' => 'Common robots format'],
                default => ['score' => 55, 'label' => 'Custom', 'tone' => 'warning', 'hint' => 'Check robots syntax'],
            },
            'og_type' => match (true) {
                empty($text) => ['score' => 0, 'label' => 'Missing', 'tone' => 'danger', 'hint' => 'Usually website or article'],
                in_array(strtolower((string) $text), ['website', 'article'], true)
                    => ['score' => 100, 'label' => 'Valid', 'tone' => 'success', 'hint' => 'Common OG type'],
                default => ['score' => 65, 'label' => 'Custom', 'tone' => 'warning', 'hint' => 'Make sure the type is intentional'],
            },
            'og_site_name' => empty($text)
                ? ['score' => 0, 'label' => 'مفقود', 'tone' => 'danger', 'hint' => 'أضف اسم الموقع أو العلامة'],
                : ['score' => 90, 'label' => 'جيد', 'tone' => 'success', 'hint' => 'اسم العلامة موجود'],
            'twitter_card' => match (true) {
                empty($text) => ['score' => 0, 'label' => 'Missing', 'tone' => 'danger', 'hint' => 'Usually summary_large_image'],
                in_array(strtolower((string) $text), ['summary', 'summary_large_image'], true)
                    => ['score' => 100, 'label' => 'Valid', 'tone' => 'success', 'hint' => 'Recommended Twitter card'],
                default => ['score' => 60, 'label' => 'Custom', 'tone' => 'warning', 'hint' => 'Verify supported card type'],
            },
            'schema_json_text' => match (true) {
                empty($text) => ['score' => 0, 'label' => 'مفقود', 'tone' => 'danger', 'hint' => 'أضف Schema بصيغة JSON-LD'],
                json_decode((string) $text, true) !== null => ['score' => 100, 'label' => 'صالح', 'tone' => 'success', 'hint' => 'بنية JSON صحيحة'],
                default => ['score' => 30, 'label' => 'غير صالح', 'tone' => 'danger', 'hint' => 'تنسيق JSON-LD غير صحيح'],
            },
            'og_image' => $seoMeta?->ogImageMedia?->path
                ? ['score' => 100, 'label' => 'Ready', 'tone' => 'success', 'hint' => 'Open Graph image exists']
                : ['score' => 0, 'label' => 'Missing', 'tone' => 'danger', 'hint' => 'Upload an OG image'],
            'twitter_image' => $seoMeta?->twitterImageMedia?->path
                ? ['score' => 100, 'label' => 'Ready', 'tone' => 'success', 'hint' => 'Twitter image exists']
                : ['score' => 0, 'label' => 'Missing', 'tone' => 'danger', 'hint' => 'Upload a Twitter image'],
            default => ['score' => 0, 'label' => 'N/A', 'tone' => 'warning', 'hint' => ''],
        };
    };

    $fieldScores = [
        'meta_title_ar' => $scoreField('meta_title_ar', $values['meta_title_ar']),
        'meta_description_ar' => $scoreField('meta_description_ar', $values['meta_description_ar']),
        'meta_keywords_ar' => $scoreField('meta_keywords_ar', $values['meta_keywords_ar']),
        'canonical_url' => $scoreField('canonical_url', $values['canonical_url']),
        'robots' => $scoreField('robots', $values['robots']),
        'og_title_ar' => $scoreField('og_title_ar', $values['og_title_ar']),
        'og_description_ar' => $scoreField('og_description_ar', $values['og_description_ar']),
        'og_type' => $scoreField('og_type', $values['og_type']),
        'og_url' => $scoreField('og_url', $values['og_url']),
        'og_site_name' => $scoreField('og_site_name', $values['og_site_name']),
        'og_image' => $scoreField('og_image', null),
        'twitter_card' => $scoreField('twitter_card', $values['twitter_card']),
        'twitter_title_ar' => $scoreField('twitter_title_ar', $values['twitter_title_ar']),
        'twitter_description_ar' => $scoreField('twitter_description_ar', $values['twitter_description_ar']),
        'twitter_image' => $scoreField('twitter_image', null),
        'schema_json_text' => $scoreField('schema_json_text', $values['schema_json_text']),
    ];

    $overallSeoScore = (int) round(collect($fieldScores)->avg('score'));
    $overallTone = $overallSeoScore >= 80 ? 'success' : ($overallSeoScore >= 55 ? 'warning' : 'danger');
@endphp

@section('css')
    <style>
        .seo-score-summary {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            flex-wrap: wrap;
            margin-bottom: 18px;
            padding: 18px;
            border: 1px solid var(--admin-border);
            border-radius: 16px;
            background: linear-gradient(135deg, rgba(72, 190, 206, 0.08), rgba(166, 204, 52, 0.08));
        }

        .seo-score-summary__value {
            font-size: 34px;
            font-weight: 800;
            color: #102d57;
            line-height: 1;
        }

        .seo-field-label {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 6px;
        }

        .seo-score-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
            line-height: 1;
        }

        .seo-score-badge--success {
            color: #166534;
            background: #dcfce7;
        }

        .seo-score-badge--warning {
            color: #92400e;
            background: #fef3c7;
        }

        .seo-score-badge--danger {
            color: #991b1b;
            background: #fee2e2;
        }

        .seo-field-hint {
            margin-top: 6px;
            font-size: 12px;
            color: #6b7280;
        }
    </style>
@endsection

@section('content')
    <section class="card card-body-soft">
        <div class="page-toolbar">
            <h2 class="page-title page-toolbar__title">{{ $title }}</h2>
            <div class="page-toolbar__actions">
                <a class="btn btn-secondary" href="{{ $backRoute }}">رجوع</a>
            </div>
        </div>

        <div class="seo-score-summary">
            <div>
                <div class="seo-score-summary__value">{{ $overallSeoScore }}/100</div>
                <div class="muted">التقييم العام لـ SEO</div>
            </div>
            <span class="seo-score-badge seo-score-badge--{{ $overallTone }}">
                {{ $overallSeoScore >= 80 ? 'إعداد SEO قوي' : ($overallSeoScore >= 55 ? 'يحتاج تحسينًا' : 'إعداد SEO ضعيف') }}
            </span>
        </div>

        <form method="POST" action="{{ $saveRoute }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="field">
                <div class="seo-field-label">
                    <label for="meta_title_ar">عنوان الميتا</label>
                    <span class="seo-score-badge seo-score-badge--{{ $fieldScores['meta_title_ar']['tone'] }}">{{ $fieldScores['meta_title_ar']['score'] }}/100 {{ $fieldScores['meta_title_ar']['label'] }}</span>
                </div>
                <input id="meta_title_ar" type="text" name="meta_title_ar" value="{{ old('meta_title_ar', $seoMeta?->meta_title_ar) }}">
                <div class="seo-field-hint">{{ $fieldScores['meta_title_ar']['hint'] }}</div>
            </div>

            <div class="field">
                <div class="seo-field-label">
                    <label for="meta_description_ar">وصف الميتا</label>
                    <span class="seo-score-badge seo-score-badge--{{ $fieldScores['meta_description_ar']['tone'] }}">{{ $fieldScores['meta_description_ar']['score'] }}/100 {{ $fieldScores['meta_description_ar']['label'] }}</span>
                </div>
                <textarea id="meta_description_ar" name="meta_description_ar">{{ old('meta_description_ar', $seoMeta?->meta_description_ar) }}</textarea>
                <div class="seo-field-hint">{{ $fieldScores['meta_description_ar']['hint'] }}</div>
            </div>

            <div class="field">
                <div class="seo-field-label">
                    <label for="meta_keywords_ar">الكلمات المفتاحية</label>
                    <span class="seo-score-badge seo-score-badge--{{ $fieldScores['meta_keywords_ar']['tone'] }}">{{ $fieldScores['meta_keywords_ar']['score'] }}/100 {{ $fieldScores['meta_keywords_ar']['label'] }}</span>
                </div>
                <input id="meta_keywords_ar" type="text" name="meta_keywords_ar" value="{{ old('meta_keywords_ar', $seoMeta?->meta_keywords_ar) }}" placeholder="كلمة1, كلمة2">
                <div class="seo-field-hint">{{ $fieldScores['meta_keywords_ar']['hint'] }}</div>
            </div>

            <div class="field">
                <div class="seo-field-label">
                    <label for="canonical_url">الرابط الأساسي</label>
                    <span class="seo-score-badge seo-score-badge--{{ $fieldScores['canonical_url']['tone'] }}">{{ $fieldScores['canonical_url']['score'] }}/100 {{ $fieldScores['canonical_url']['label'] }}</span>
                </div>
                <input id="canonical_url" type="url" name="canonical_url" value="{{ old('canonical_url', $seoMeta?->canonical_url) }}">
                <div class="seo-field-hint">{{ $fieldScores['canonical_url']['hint'] }}</div>
            </div>

            <div class="field">
                <div class="seo-field-label">
                    <label for="robots">Robots</label>
                    <span class="seo-score-badge seo-score-badge--{{ $fieldScores['robots']['tone'] }}">{{ $fieldScores['robots']['score'] }}/100 {{ $fieldScores['robots']['label'] }}</span>
                </div>
                <input id="robots" type="text" name="robots" value="{{ old('robots', $seoMeta?->robots) }}" placeholder="index,follow">
                <div class="seo-field-hint">{{ $fieldScores['robots']['hint'] }}</div>
            </div>

            <div class="field">
                <div class="seo-field-label">
                    <label for="og_title_ar">عنوان Open Graph</label>
                    <span class="seo-score-badge seo-score-badge--{{ $fieldScores['og_title_ar']['tone'] }}">{{ $fieldScores['og_title_ar']['score'] }}/100 {{ $fieldScores['og_title_ar']['label'] }}</span>
                </div>
                <input id="og_title_ar" type="text" name="og_title_ar" value="{{ old('og_title_ar', $seoMeta?->og_title_ar) }}">
                <div class="seo-field-hint">{{ $fieldScores['og_title_ar']['hint'] }}</div>
            </div>

            <div class="field">
                <div class="seo-field-label">
                    <label for="og_description_ar">وصف Open Graph</label>
                    <span class="seo-score-badge seo-score-badge--{{ $fieldScores['og_description_ar']['tone'] }}">{{ $fieldScores['og_description_ar']['score'] }}/100 {{ $fieldScores['og_description_ar']['label'] }}</span>
                </div>
                <textarea id="og_description_ar" name="og_description_ar">{{ old('og_description_ar', $seoMeta?->og_description_ar) }}</textarea>
                <div class="seo-field-hint">{{ $fieldScores['og_description_ar']['hint'] }}</div>
            </div>

            <div class="field">
                <div class="seo-field-label">
                    <label for="og_type">نوع Open Graph</label>
                    <span class="seo-score-badge seo-score-badge--{{ $fieldScores['og_type']['tone'] }}">{{ $fieldScores['og_type']['score'] }}/100 {{ $fieldScores['og_type']['label'] }}</span>
                </div>
                <input id="og_type" type="text" name="og_type" value="{{ old('og_type', $seoMeta?->og_type) }}" placeholder="website / article">
                <div class="seo-field-hint">{{ $fieldScores['og_type']['hint'] }}</div>
            </div>

            <div class="field">
                <div class="seo-field-label">
                    <label for="og_url">رابط Open Graph</label>
                    <span class="seo-score-badge seo-score-badge--{{ $fieldScores['og_url']['tone'] }}">{{ $fieldScores['og_url']['score'] }}/100 {{ $fieldScores['og_url']['label'] }}</span>
                </div>
                <input id="og_url" type="url" name="og_url" value="{{ old('og_url', $seoMeta?->og_url) }}">
                <div class="seo-field-hint">{{ $fieldScores['og_url']['hint'] }}</div>
            </div>

            <div class="field">
                <div class="seo-field-label">
                    <label for="og_site_name">اسم الموقع في Open Graph</label>
                    <span class="seo-score-badge seo-score-badge--{{ $fieldScores['og_site_name']['tone'] }}">{{ $fieldScores['og_site_name']['score'] }}/100 {{ $fieldScores['og_site_name']['label'] }}</span>
                </div>
                <input id="og_site_name" type="text" name="og_site_name" value="{{ old('og_site_name', $seoMeta?->og_site_name) }}">
                <div class="seo-field-hint">{{ $fieldScores['og_site_name']['hint'] }}</div>
            </div>

            <div class="field">
                <div class="seo-field-label">
                    <label for="og_image">صورة Open Graph</label>
                    <span class="seo-score-badge seo-score-badge--{{ $fieldScores['og_image']['tone'] }}">{{ $fieldScores['og_image']['score'] }}/100 {{ $fieldScores['og_image']['label'] }}</span>
                </div>
                <input id="og_image" type="file" name="og_image" accept="image/*">
                @if($seoMeta?->ogImageMedia?->path)
                    <div class="muted inline-link-note">الحالية: <a href="{{ asset('storage/'.$seoMeta->ogImageMedia->path) }}" target="_blank">عرض صورة Open Graph</a></div>
                @endif
                <div class="seo-field-hint">{{ $fieldScores['og_image']['hint'] }}</div>
            </div>

            <div class="field">
                <div class="seo-field-label">
                    <label for="twitter_card">Twitter Card</label>
                    <span class="seo-score-badge seo-score-badge--{{ $fieldScores['twitter_card']['tone'] }}">{{ $fieldScores['twitter_card']['score'] }}/100 {{ $fieldScores['twitter_card']['label'] }}</span>
                </div>
                <input id="twitter_card" type="text" name="twitter_card" value="{{ old('twitter_card', $seoMeta?->twitter_card) }}" placeholder="summary_large_image">
                <div class="seo-field-hint">{{ $fieldScores['twitter_card']['hint'] }}</div>
            </div>

            <div class="field">
                <div class="seo-field-label">
                    <label for="twitter_title_ar">عنوان Twitter</label>
                    <span class="seo-score-badge seo-score-badge--{{ $fieldScores['twitter_title_ar']['tone'] }}">{{ $fieldScores['twitter_title_ar']['score'] }}/100 {{ $fieldScores['twitter_title_ar']['label'] }}</span>
                </div>
                <input id="twitter_title_ar" type="text" name="twitter_title_ar" value="{{ old('twitter_title_ar', $seoMeta?->twitter_title_ar) }}">
                <div class="seo-field-hint">{{ $fieldScores['twitter_title_ar']['hint'] }}</div>
            </div>

            <div class="field">
                <div class="seo-field-label">
                    <label for="twitter_description_ar">وصف Twitter</label>
                    <span class="seo-score-badge seo-score-badge--{{ $fieldScores['twitter_description_ar']['tone'] }}">{{ $fieldScores['twitter_description_ar']['score'] }}/100 {{ $fieldScores['twitter_description_ar']['label'] }}</span>
                </div>
                <textarea id="twitter_description_ar" name="twitter_description_ar">{{ old('twitter_description_ar', $seoMeta?->twitter_description_ar) }}</textarea>
                <div class="seo-field-hint">{{ $fieldScores['twitter_description_ar']['hint'] }}</div>
            </div>

            <div class="field">
                <div class="seo-field-label">
                    <label for="twitter_image">صورة Twitter</label>
                    <span class="seo-score-badge seo-score-badge--{{ $fieldScores['twitter_image']['tone'] }}">{{ $fieldScores['twitter_image']['score'] }}/100 {{ $fieldScores['twitter_image']['label'] }}</span>
                </div>
                <input id="twitter_image" type="file" name="twitter_image" accept="image/*">
                @if($seoMeta?->twitterImageMedia?->path)
                    <div class="muted inline-link-note">الحالية: <a href="{{ asset('storage/'.$seoMeta->twitterImageMedia->path) }}" target="_blank">عرض صورة Twitter</a></div>
                @endif
                <div class="seo-field-hint">{{ $fieldScores['twitter_image']['hint'] }}</div>
            </div>

            <div class="field">
                <div class="seo-field-label">
                    <label for="schema_json_text">Schema JSON-LD</label>
                    <span class="seo-score-badge seo-score-badge--{{ $fieldScores['schema_json_text']['tone'] }}">{{ $fieldScores['schema_json_text']['score'] }}/100 {{ $fieldScores['schema_json_text']['label'] }}</span>
                </div>
                <textarea id="schema_json_text" name="schema_json_text">{{ old('schema_json_text', $seoMeta && $seoMeta->schema_json ? json_encode($seoMeta->schema_json, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) : '') }}</textarea>
                <div class="seo-field-hint">{{ $fieldScores['schema_json_text']['hint'] }}</div>
            </div>

            <div class="actions">
                <button class="btn btn-primary" type="submit">حفظ SEO</button>
                <a class="btn btn-secondary" href="{{ $backRoute }}">إلغاء</a>
            </div>
        </form>
    </section>
@endsection
