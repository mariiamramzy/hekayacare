<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نسيت كلمة المرور</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@100..900&display=swap" rel="stylesheet">
    <style>
        body{font-family:"Noto Kufi Arabic",sans-serif;background:#eef3f9;margin:0;display:flex;min-height:100vh;align-items:center;justify-content:center;padding:16px}
        .wrap{width:min(460px,100%);background:#fff;border:1px solid #e6ebf2;border-radius:24px;padding:26px;box-shadow:0 24px 60px rgba(16,45,87,.12)}
        h1{margin:0 0 8px;font-size:26px;color:#102d57}
        p{margin:0 0 18px;color:#6c7b92;font-size:14px;line-height:1.9}
        label{display:block;margin:12px 0 8px;font-weight:700;color:#102d57}
        input{width:100%;height:52px;border:1px solid #d8e0ec;border-radius:16px;padding:0 14px;box-sizing:border-box;font-family:inherit}
        button{width:100%;margin-top:14px;border:0;border-radius:16px;padding:14px;background:linear-gradient(90deg,#e5bf62 0 3%,#1f8b82 3% 68%,#66aba7 68% 100%);color:#fff;font-family:inherit;font-weight:800;cursor:pointer}
        .error,.ok{border-radius:14px;padding:12px 14px;margin-bottom:12px;font-size:13px;line-height:1.9}
        .error{background:#fef2f2;border:1px solid #fecaca;color:#991b1b}
        .ok{background:#ecfdf5;border:1px solid #a7f3d0;color:#065f46}
        a{color:#1f8b82;text-decoration:none;font-size:14px;font-weight:700}
    </style>
</head>
<body>
    <div class="wrap">
        <h1>نسيت كلمة المرور</h1>
        <p>أدخل البريد الإلكتروني الخاص بحساب الأدمن وسنرسل لك رابط إعادة تعيين كلمة المرور.</p>

        @if ($errors->any())
            <div class="error">{{ $errors->first() }}</div>
        @endif
        @if (session('status'))
            <div class="ok">{{ session('status') }}</div>
        @endif
        @if (session('reset_url'))
            <div class="ok">
                رابط إعادة التعيين:
                <div style="margin-top:8px; word-break: break-all;">
                    <a href="{{ session('reset_url') }}">{{ session('reset_url') }}</a>
                </div>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.password.email') }}">
            @csrf
            <label for="email">البريد الإلكتروني</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus>
            <button type="submit">إرسال رابط إعادة التعيين</button>
        </form>

        <div style="margin-top:14px;"><a href="{{ route('admin.login') }}">العودة إلى تسجيل الدخول</a></div>
    </div>
</body>
</html>
