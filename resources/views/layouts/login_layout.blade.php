<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Private Area</title>
    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/bootstrap.min.css') }}">
</head>
<body>

    @yield('conteudo')

    {{-- SCRIPTS JQUERY/JS --}}
    <script src="{{ asset('assets/bootstrap/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('assets/bootstrap/bootstrap.bundle.min.js') }}"></script>
</body>
</html>