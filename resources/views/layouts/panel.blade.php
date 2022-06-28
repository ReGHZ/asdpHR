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
    <link rel="stylesheet" href="{{ asset('backend/assets/css/pages/simple-datatables.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/pages/fontawesome.css') }}">
    @yield('css')
    <style>
        .upload {
            width: 100px;
            position: relative;
            margin: auto;
        }

        .upload img {
            border-radius: 50%;
            border: 6px solid rgb(217, 215, 210);
        }

        .upload .round {
            position: absolute;
            bottom: 0;
            right: 0;
            background: grey;
            width: 32px;
            height: 32px;
            line-height: 33px;
            text-align: center;
            border-radius: 50%;
            overflow: hidden;
        }

        .upload .round input[type='file'] {
            position: absolute;
            transform: scale(2);
            opacity: 0;
        }

        input[type='file']::-webkit-file-upload-button {
            cursor: pointer;
        }

        .feather-16 {
            width: 16px;
            height: 16px;
        }
    </style>
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    @if (Route::current()->getName() == 'employee' || Route::current()->getName() == 'divisi' || Route::current()->getName() == 'jabatan' || Route::current()->getName() == 'pengajuan-cuti' || Route::current()->getName() == 'persetujuan-cuti' || Route::current()->getName() == 'perjalanan-dinas' || Route::current()->getName() == 'pengajuan-cuti' || Route::current()->getName() == 'persetujuan-cuti')
        <script src="{{ asset('backend/assets/js/extensions/simple-datatables.js') }}"></script>
    @endif

    @stack('scripts')

</body>

</html>
