<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('meta')
    <title>@yield('title')</title>
    @stack('styles')
</head>
<body>
    @include('layout.header')
    @yield('body')
    @include('layout.footer')
    @stack('scripts')
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>
