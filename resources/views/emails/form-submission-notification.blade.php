<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>{{ $formName }}</title>
</head>
<body style="margin:0; padding:24px; background:#f5f7fb; font-family:Tahoma, Arial, sans-serif; color:#102d57;">
    <div style="max-width:680px; margin:0 auto; background:#ffffff; border:1px solid #dbe4f0; border-radius:16px; overflow:hidden;">
        <div style="background:#102d57; color:#ffffff; padding:20px 24px;">
            <h1 style="margin:0; font-size:24px;">Hekaya</h1>
            <p style="margin:8px 0 0; font-size:15px;">تم استلام إرسال جديد من فورم {{ $formName }}</p>
        </div>

        <div style="padding:24px;">
            <table style="width:100%; border-collapse:collapse;">
                <tbody>
                    @foreach ($fields as $label => $value)
                        <tr>
                            <td style="width:180px; padding:12px 0; font-weight:700; border-bottom:1px solid #eef3f8; vertical-align:top;">{{ $label }}</td>
                            <td style="padding:12px 0; border-bottom:1px solid #eef3f8; color:#334155; white-space:pre-line;">{{ $value !== null && $value !== '' ? $value : '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
