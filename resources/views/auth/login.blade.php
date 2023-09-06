    <!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Preskool - Login</title>

    <link rel="shortcut icon" href="{{asset('theme')}}/assets/img/favicon.png">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('theme')}}/assets/plugins/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" href="{{asset('theme')}}/assets/plugins/feather/feather.css">

    <link rel="stylesheet" href="{{asset('theme')}}/assets/plugins/icons/flags/flags.css">

    <link rel="stylesheet" href="{{asset('theme')}}/assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="{{asset('theme')}}/assets/plugins/fontawesome/css/all.min.css">

    <link rel="stylesheet" href="{{asset('theme')}}/assets/css/style.css">
    </head>
    <body>

    <div class="main-wrapper login-body">
    <div class="login-wrapper">
    <div class="container">
    <div class="loginbox">
    <div class="login-left">
    <img class="img-fluid" src="{{asset('theme')}}/assets/img/login.png" alt="Logo">
    </div>
    <div class="login-right">
    <div class="login-right-wrap">
    <h1>Welcome to Preskool</h1>
    <p class="account-subtitle">Need an account? <a href="register.html">Sign Up</a></p>
    <h2>Sign in</h2>

    <form method="POST" action="{{ route('login') }}">
        @csrf
    <div class="form-group">
    <label>Email <span class="login-danger">*</span></label>
    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
    <span class="profile-views"><i class="fas fa-user-circle"></i></span>
    </div>
    <div class="form-group">
    <label>Password <span class="login-danger">*</span></label>
    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
    <span class="profile-views feather-eye toggle-password"></span>
    </div>
    <div class="forgotpass">
    <div class="remember-me">
    <label class="custom_check mr-2 mb-0 d-inline-flex remember-me">
        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

        <label class="form-check-label" for="remember">
            {{ __('Remember Me') }}
        </label>
    <span class="checkmark"></span>
    </label>
    </div>
    @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
    {{-- <a href="forgot-password.html">Forgot Password?</a> --}}
    </div>
    <div class="form-group">
    <button class="btn btn-primary btn-block" type="submit">Login</button>
    </div>
    </form>


    </div>
    </div>
    </div>
    </div>
    </div>
    </div>


    <script src="{{asset('theme')}}/assets/js/jquery-3.6.0.min.js"></script>

    <script src="{{asset('theme')}}/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="{{asset('theme')}}/assets/js/feather.min.js"></script>

    <script src="{{asset('theme')}}/assets/js/script.js"></script>
    </body>
    </html>