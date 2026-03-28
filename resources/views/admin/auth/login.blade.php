<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="تسجيل دخول لوحة تحكم مركز حكاية لإدارة المحتوى والمقالات والأسئلة الشائعة وطلبات التواصل والحجوزات.">
    <meta name="keywords" content="تسجيل دخول الأدمن, لوحة تحكم حكاية, Hekaya Admin Login">
    <meta name="robots" content="noindex, nofollow">
    <meta name="author" content="Hekaya">
    <meta name="theme-color" content="#102d57">
    <link rel="icon" href="{{ asset('images/backgrounds/favicon.svg') }}" type="image/svg+xml">
    <link rel="shortcut icon" href="{{ asset('images/backgrounds/favicon.svg') }}" type="image/svg+xml">
    <link rel="apple-touch-icon" href="{{ asset('images/backgrounds/favicon.svg') }}">
    <title>تسجيل دخول الأدمن | Hekaya Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@100..900&display=swap" rel="stylesheet">
    <style>
        :root {
            --hekaya-navy: #102d57;
            --hekaya-navy-soft: #173d72;
            --hekaya-teal: #1f8b82;
            --hekaya-gold: #e5bf62;
            --hekaya-border: rgba(16, 45, 87, 0.12);
            --hekaya-text: #17304f;
            --hekaya-muted: #6c7b92;
            --hekaya-surface: #ffffff;
            --hekaya-bg: #eef3f9;
            --hekaya-shadow: 0 28px 60px rgba(16, 45, 87, 0.12);
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: "Noto Kufi Arabic", sans-serif;
            color: var(--hekaya-text);
            background:
                radial-gradient(circle at top right, rgba(31, 139, 130, 0.16), transparent 28%),
                radial-gradient(circle at bottom left, rgba(229, 191, 98, 0.18), transparent 24%),
                linear-gradient(135deg, #f6f8fc 0%, #eaf0f8 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 28px 16px;
        }

        .login-shell {
            width: min(1040px, 100%);
            display: grid;
            grid-template-columns: minmax(320px, 430px) minmax(320px, 1fr);
            background: rgba(255, 255, 255, 0.66);
            border: 1px solid rgba(255, 255, 255, 0.72);
            border-radius: 30px;
            overflow: hidden;
            box-shadow: var(--hekaya-shadow);
            backdrop-filter: blur(10px);
        }

        .login-brand {
            position: relative;
            background:
                linear-gradient(180deg, rgba(16, 45, 87, 0.96), rgba(19, 61, 114, 0.94)),
                linear-gradient(135deg, rgba(31, 139, 130, 0.28), transparent 55%);
            color: #fff;
            padding: 42px 34px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            gap: 30px;
        }

        .login-brand::before,
        .login-brand::after {
            content: "";
            position: absolute;
            border-radius: 999px;
            pointer-events: none;
        }

        .login-brand::before {
            width: 220px;
            height: 220px;
            top: -80px;
            left: -70px;
            background: rgba(229, 191, 98, 0.15);
        }

        .login-brand::after {
            width: 180px;
            height: 180px;
            bottom: -70px;
            right: -50px;
            background: rgba(31, 139, 130, 0.16);
        }

        .login-brand__logo {
            position: relative;
            z-index: 1;
            display: inline-flex;
            align-items: center;
            gap: 14px;
            text-decoration: none;
            color: inherit;
        }

        .login-brand__logo-mark {
            width: 72px;
            height: 72px;
            border-radius: 22px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.14);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(8px);
        }

        .login-brand__logo-mark img {
            width: 52px;
            height: 52px;
            object-fit: contain;
        }

        .login-brand__logo-text strong {
            display: block;
            font-size: 28px;
            line-height: 1.1;
            font-weight: 800;
        }

        .login-brand__logo-text span {
            display: block;
            margin-top: 6px;
            font-size: 12px;
            color: rgba(255, 255, 255, 0.78);
        }

        .login-brand__content {
            position: relative;
            z-index: 1;
        }

        .login-brand__eyebrow {
            display: inline-block;
            margin-bottom: 12px;
            padding: 8px 14px;
            border-radius: 999px;
            background: rgba(229, 191, 98, 0.18);
            color: #f5d282;
            font-size: 12px;
            font-weight: 700;
        }

        .login-brand h1 {
            margin: 0 0 14px;
            font-size: clamp(28px, 4vw, 40px);
            line-height: 1.35;
        }

        .login-brand p {
            margin: 0;
            color: rgba(255, 255, 255, 0.8);
            font-size: 14px;
            line-height: 2;
        }

        .login-brand__footer {
            position: relative;
            z-index: 1;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            color: rgba(255, 255, 255, 0.75);
            font-size: 12px;
        }

        .login-card {
            padding: 46px 38px;
            background: rgba(255, 255, 255, 0.92);
        }

        .login-card__header {
            margin-bottom: 22px;
        }

        .login-card__header h2 {
            margin: 0 0 8px;
            font-size: 30px;
            line-height: 1.35;
            color: var(--hekaya-navy);
        }

        .login-card__header p {
            margin: 0;
            color: var(--hekaya-muted);
            font-size: 14px;
            line-height: 1.9;
        }

        .notice,
        .error {
            border-radius: 16px;
            padding: 14px 16px;
            margin-bottom: 16px;
            font-size: 13px;
            line-height: 1.9;
        }

        .notice {
            background: #ecfdf5;
            border: 1px solid #a7f3d0;
            color: #065f46;
        }

        .error {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
        }

        .field {
            margin-bottom: 16px;
        }

        .field label {
            display: block;
            margin-bottom: 8px;
            font-size: 13px;
            font-weight: 700;
            color: var(--hekaya-navy);
        }

        .field input {
            width: 100%;
            height: 54px;
            border: 1px solid var(--hekaya-border);
            border-radius: 16px;
            background: #fff;
            color: var(--hekaya-text);
            padding: 0 16px;
            font-size: 14px;
            outline: none;
            transition: border-color .2s ease, box-shadow .2s ease, background-color .2s ease;
        }

        .field input:focus {
            border-color: rgba(31, 139, 130, 0.5);
            box-shadow: 0 0 0 4px rgba(31, 139, 130, 0.10);
            background: #fff;
        }

        .login-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin: 6px 0 18px;
            flex-wrap: wrap;
        }

        .remember-me {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: var(--hekaya-muted);
        }

        .remember-me input {
            width: 16px;
            height: 16px;
            accent-color: var(--hekaya-teal);
        }

        .forgot-link {
            color: var(--hekaya-teal);
            text-decoration: none;
            font-size: 13px;
            font-weight: 700;
        }

        .forgot-link:hover {
            color: var(--hekaya-navy);
        }

        .login-button {
            width: 100%;
            border: 0;
            border-radius: 18px;
            padding: 15px 18px;
            background: linear-gradient(90deg, var(--hekaya-gold) 0 3%, var(--hekaya-teal) 3% 68%, #66aba7 68% 100%);
            color: #fff;
            font-size: 15px;
            font-weight: 800;
            font-family: inherit;
            cursor: pointer;
            transition: transform .2s ease, box-shadow .2s ease;
            box-shadow: 0 16px 30px rgba(31, 139, 130, 0.22);
        }

        .login-button:hover {
            transform: translateY(-1px);
            box-shadow: 0 18px 34px rgba(31, 139, 130, 0.28);
        }

        .login-help {
            margin-top: 18px;
            padding-top: 18px;
            border-top: 1px solid rgba(16, 45, 87, 0.08);
            color: var(--hekaya-muted);
            font-size: 12px;
            line-height: 2;
        }

        @media (max-width: 920px) {
            .login-shell {
                grid-template-columns: 1fr;
            }

            .login-brand {
                padding: 32px 24px;
            }

            .login-card {
                padding: 30px 22px;
            }
        }

        @media (max-width: 575px) {
            body {
                padding: 16px 12px;
            }

            .login-shell {
                border-radius: 22px;
            }

            .login-card__header h2 {
                font-size: 24px;
            }

            .login-brand__logo-text strong {
                font-size: 24px;
            }

            .field input {
                height: 50px;
            }
        }
    </style>
</head>
<body>
    <div class="login-shell">
        <aside class="login-brand">
            <a href="{{ url('/') }}" class="login-brand__logo">
                <span class="login-brand__logo-mark">
                    <img src="{{ asset('images/backgrounds/logo-1.svg') }}" alt="Hekaya">
                </span>
                <span class="login-brand__logo-text">
                    <strong>حكاية</strong>
                    <span>مركز للصحة النفسية والتعافي</span>
                </span>
            </a>

            <div class="login-brand__content">
                <span class="login-brand__eyebrow">لوحة تحكم المركز</span>
                <h1>إدارة المحتوى والطلبات من مكان واحد</h1>
                <p>يمكنك من هنا متابعة المقالات والأسئلة الشائعة والجاليري والفريق وطلبات التواصل والحجز من خلال لوحة تحكم موحدة.</p>
            </div>

            <div class="login-brand__footer">
                <span>Hekaya Admin</span>
                <span>{{ now()->year }}</span>
            </div>
        </aside>

        <section class="login-card">
            <div class="login-card__header">
                <h2>تسجيل دخول الأدمن</h2>
                <p>سجّل الدخول للوصول إلى لوحة التحكم الخاصة بمركز حكاية.</p>
            </div>

            @if ($errors->any())
                <div class="error">{{ $errors->first() }}</div>
            @endif

            @if (session('status'))
                <div class="notice">{{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ route('admin.login.store') }}">
                @csrf

                <div class="field">
                    <label for="email">البريد الإلكتروني</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus placeholder="أدخل البريد الإلكتروني">
                </div>

                <div class="field">
                    <label for="password">كلمة المرور</label>
                    <input id="password" name="password" type="password" required placeholder="أدخل كلمة المرور">
                </div>

                <div class="login-actions">
                    <label class="remember-me" for="remember">
                        <input id="remember" type="checkbox" name="remember" value="1">
                        <span>تذكرني</span>
                    </label>

                    <a class="forgot-link" href="{{ route('admin.password.request') }}">نسيت كلمة المرور؟</a>
                </div>

                <button type="submit" class="login-button">دخول إلى لوحة التحكم</button>
            </form>

            <div class="login-help">
                للوصول للموقع الرئيسي:
                <a class="forgot-link" href="{{ url('/') }}">hekayacare.com</a>
            </div>
        </section>
    </div>
</body>
</html>
