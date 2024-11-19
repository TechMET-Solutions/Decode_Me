{{-- @extends('layouts.app')
@section('content')
    <div class="container">
        <x-session-message />
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Login') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Decode Me</title>
</head>
<style>
    @import url("https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,200..800&display=swap");

    :root {
        --remReset: 62.5%;
    }

    html {
        font-size: var(--remReset);
    }

    body {
        font-family: "Bricolage Grotesque", sans-serif;
        font-style: normal;
        font-size: 1.4rem;
        /* background-color: #00a47b; */
        background-image: none;
        transition-property: margin;
        transition-duration: 1s;
        transition-timing-function: linear;
        transition: background-image 2s smooth;
    }

    .login-container {
        background-color: #fff;
        width: 100%;
        height: 100vh;
        transition-property: border-radius, height;
        transition-duration: 1s;
        transition-timing-function: linear;
    }

    .login-content {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 42px 20px;
        max-width: 310px;
        margin: 0 auto;
        /* text-align: center; */
    }

    .login-content p {
        font-size: 1.1rem;
        margin-top: 5rem;
    }

    .login-content p strong {
        color: #87a922;
    }

    .login-content_header {
        text-align: center;
    }

    .login-content_header span#logo {
        font-size: 1.8rem;
        font-weight: 800;
    }

    .login-content_header h2 {
        font-size: 3.5rem;
        line-height: 1;
        margin: 25px 0;
    }

    form {
        display: flex;
        flex-direction: column;
        width: 250px;
        height: 30px;
        line-height: 30px;
    }

    .login-form input {
        padding: 8px 16px;
        border-radius: 50px;
    }

    .login-form button {
        padding: 8px 16px;
        border-radius: 50px;
    }

    input {
        border: 1px solid #ccc;
        margin: 8px 0;
    }

    button {
        border: 1px solid #ccc;
        margin: 8px 0;
    }

    button[type="submit"] {
        border: none;
        background-color: #87a922;
        color: #fffacd;
        font-weight: 800;
        letter-spacing: 1.3px;
    }

    .login-netoworks {
        margin-top: 2rem;
    }

    .login-icons {
        display: flex;
        flex-direction: row;
        justify-content: space-around;
        margin: 20px;
    }

    ul.login-icons li {
        background-color: #cadd91;
        padding: 8px 10px;
        border-radius: 8px;
    }

    @media screen and (min-width: 400px) {
        body {
            margin: 20px;
        }

        .login-container {
            border-radius: 1.6rem;
        }
    }

    @media screen and (min-width: 700px) {
        body {
            /* background-color: #00a47b; */
            /* background-image: url("https://images.pexels.com/photos/338936/pexels-photo-338936.jpeg"); */
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            height: 100vh;
        }

        .login-container {
            position: absolute;
            left: 80px;
            width: 550px;
            height: 90%;
            top: 110px;
        }
    }

    /* CSS for styling */
    .password-container {
        position: relative;
    }

    .password-container input[type="password"],
    .password-container input[type="text"] {
        width: 77%;
        padding-right: 40px;
        /* space for the icon */
    }

    .password-container i {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 18px;
        color: #787878;
    }
</style>

<body class="app"
    style="background-image: url('{{ asset('user/assets/images/login.png') }}'); background-repeat:no-repeat;background-size: cover;">
    <div class="login-container">
        <div class="login-content">
            <x-session-message />
            <div class="login-content_header">
                <h2>Login</h2>
            </div>
            <div>
                <form method="POST" action="{{ route('login') }}" class="login-form">
                    @csrf
                    <label for="email" class="mt-2">Email Address</label>
                    <input type="email" name="email" placeholder="Enter your email address" required>
                    {{-- <label for="" class="mt-2">Contact Number</label>
                    <input type="text" placeholder="+91 0000000000"> --}}
                    {{--  <label for="password" class="mt-2">Password</label>
                    <input type="password" name="password" placeholder="Password" required>  --}}
                    <label for="password" class="mt-2">Password</label>
                    <div class="password-container">
                        <input type="password" name="password" placeholder="Password" required id="password">
                        <i class="fa fa-eye" id="togglePassword" style="cursor: pointer;"></i>
                    </div>
                    <button type="submit">Login</button>
                    <div class="row">
                        <div class="col-6">
                            <a href="{{ route('register') }}" style="margin-left: 10px;">Register</a>
                            <span style="color: #787878; margin-left: 30px;">|</span>
                            <a href="{{ route('forgotPassword') }}" style="color: #787878; margin-left: 20px;">Forgot
                                password?</a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
        <div class="login-footer"></div>
    </div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script>
        document.getElementById('togglePassword').addEventListener('click', function(e) {
            const password = document.getElementById('password');
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
        });
    </script>
</body>

</html>
