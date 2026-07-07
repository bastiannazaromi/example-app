<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #333;
            line-height: 1.6;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .header h2 {
            margin: 0;
            text-transform: uppercase;
            color: #1a1a1a;
        }

        .meta {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 20px;
        }

        .badge {
            background-color: #6c757d;
            color: white;
            padding: 3px 8px;
            font-size: 0.8rem;
            border-radius: 3px;
            font-weight: bold;
        }

        .content {
            font-size: 1.1rem;
            text-align: justify;
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 0.8rem;
            color: #aaa;
            border-top: 1px solid #ddd;
            padding-top: 5px;
        }
    </style>
</head>

<body>

    <div class="header">
        <h2>{{ $post->title }}</h2>
    </div>

    <div class="meta">
        Kategori: <span class="badge">{{ $post->category->name }}</span> |
        Tanggal Rilis: {{ $post->created_at->format('d M Y H:i') }} WIB
    </div>

    @if ($post->image)
        <div style="margin-bottom: 20px; text-align: center;">
            <img src="{{ public_path('storage/' . $post->image) }}"
                style="width: 100%; max-height: 250px; border-radius: 5px;">
        </div>
    @endif

    <div class="content">
        {!! nl2br(e($post->content)) !!}
    </div>

    <div class="footer">
        Copyright &copy; {{ date('Y') }} example-app.
    </div>

</body>

</html>
