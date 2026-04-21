<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') | Example App</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        body {
            background-color: #f8f9fa;
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">
    @include('partials.navbar')

    <div class="container mt-4 flex-grow-1">
        <div class="mb-4">
            <h2 class="fw-bold">@yield('page_heading')</h2>
        </div>

        @yield('container')
    </div>

    <footer class="text-center py-4 text-muted mt-5 border-top" style="background-color: #989ca0; font-weight: bold;">
        <small>&copy; {{ date('Y') }} Example App - Pemrograman Web 2 - 4A</small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
