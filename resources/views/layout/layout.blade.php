<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('meta')
    <title>@yield('title')</title>
    @stack('styles')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    @php
        $carts = \App\Models\Cart::getAllCartWithUserId(Session::get('user_id'));
        $total = \App\Models\Cart::getTotalCartByUserId(Session::get('user_id'));
    @endphp
    @include('layout.header')
    @yield('body')
    @include('layout.footer')
    <script type="module" src="{{ custom_asset('resources/js/cart.js') }}"></script>
    @stack('scripts')
</body>

</html>
