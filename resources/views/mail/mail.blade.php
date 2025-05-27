@php
    $surveyName = $type === 'alumni' ? 'Survey Alumni' : 'Survey Pengguna Alumni';
@endphp

<div style="font-family: Arial, sans-serif; padding: 20px; background-color: #f9f9f9; color: #333;">
    <h2 style="color: #2c3e50;">Halo 👋</h2>

    <p>
        Anda menerima email ini karena Anda ingin mengisi <strong>{{ $surveyName }}</strong>.
    </p>

    <p>
        Silakan klik tombol di bawah ini untuk memulai pengisian survei:
    </p>

    <div style="text-align: center; margin: 30px 0;">
        <a href="{{ $unique_url }}" style="
            background-color: #3498db;
            color: #fff;
            padding: 12px 20px;
            text-decoration: none;
            border-radius: 6px;
            display: inline-block;
            font-weight: bold;
        ">
            Mulai {{ $surveyName }}
        </a>
    </div>

    <p>Atau salin dan tempel tautan berikut di browser Anda:</p>
    <p style="word-break: break-all;">
        <a href="{{ $unique_url }}" style="color: #3498db;">{{ $unique_url }}</a>
    </p>

    <hr style="margin-top: 40px;">

    <p style="font-size: 13px; color: #999;">
        Jika Anda tidak meminta tautan ini, Anda dapat mengabaikan email ini.
    </p>
</div>
