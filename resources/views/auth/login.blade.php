<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - HR</title>
    <link rel="stylesheet" href="{{ asset('backend/assets/css/main/app.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/pages/auth.css') }}">
    <link rel="shortcut icon" href="{{ asset('backend/assets/images/logo/favicon.svg') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('backend/assets/images/logo/favicon.png') }}" type="image/png">
</head>

<body>
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="text-center mb-4">
                        <a href="{{ route('home') }}"><img src="{{ asset('backend/assets/images/logo/asdp.svg') }}"
                                alt="Logo"></a>
                    </div>
                    <h1 class="auth-title">Log in.</h1>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group position-relative has-icon-left mb-4">
                            <input id="nik" type="text"
                                class="form-control form-control-xl @error('nik') is-invalid @enderror"
                                placeholder="NIK" name="nik" value="{{ old('nik') }}" required autocomplete="nik"
                                autofocus>
                            @error('nik')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input id="password" type="password"
                                class="form-control form-control-xl @error('password') is-invalid @enderror"
                                name="password" required autocomplete="current-password" placeholder="Password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <div class="form-check form-check-lg d-flex align-items-end">
                            <input class="form-check-input me-2" type="checkbox" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label text-gray-600" for="remember">
                                Keep me logged in
                            </label>
                        </div>
                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
                    </form>
                    {{-- <div class="text-center mt-5 text-lg fs-4">
                        @if (Route::has('password.request'))
                            <p><a class="font-bold" href="{{ route('password.request') }}">Forgot password?</a>.
                            </p>
                        @endif
                    </div> --}}
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right" style="max-height: 100vh; overflow:hidden; filter: brightness(50%);">
                    <img src="{{ asset('/backend/assets/images/asdp.jpg') }}">
                </div>
            </div>
        </div>

    </div>
</body>

</html>
