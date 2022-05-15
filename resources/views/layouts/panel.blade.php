<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HR</title>

    <link rel="stylesheet" href="{{ asset('backend/assets/css/main/app.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/main/app-dark.css') }}">
    <link rel="shortcut icon" href="{{ asset('backend/assets/images/logo/favicon.svg') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('backend/assets/images/logo/favicon.png') }}" type="image/png">

    <link rel="stylesheet" href="{{ asset('backend/assets/css/shared/iconly.css') }}">
</head>

<body>
    <div id="app">
        @include('layouts.sidebar')
        @include('layouts.header')
        @yield('content')
        @include('layouts.footer')
    </div>
    @if (Route::current()->getName() == 'layouts.panel')
        <script src="{{ asset('backend/assets/js/pages/dashboard.js') }}"></script>
    @endif
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
</body>

</html>
