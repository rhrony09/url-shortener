<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMBD URL Shortener</title>
    <link rel="shortcut icon" href="{{ asset('icon.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding-top: 2rem;
            background: #efefef;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }

        .brand-color {
            background-color: #ea1d22 !important;
            color: white !important;
        }

        .brand-btn {
            background-color: #ea1d22 !important;
            border-color: #ea1d22 !important;
            color: #fff;
        }

        .brand-btn:hover {
            background-color: #c0171b !important;
            border-color: #c0171b !important;
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="container">
        <main>
            @yield('content')
        </main>

        <footer class="mt-5 text-center text-muted">
            <p>IMBD URL Shortener &copy; {{ date('Y') }}</p>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
