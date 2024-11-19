{{-- @extends('layouts.app')

@section('content')
    <div class="container">
        <x-session-message />
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">

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
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
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

    html,
    body {
        height: 100%;
        margin: 0;
        padding: 0;
    }

    body {
        background-image: url('{{ asset('user/assets/images/register.png') }}');
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        font-family: "Bricolage Grotesque", sans-serif;
        font-style: normal;
        font-size: 1.4rem;
        background-image: none;
        transition-property: margin;
        transition-duration: 1s;
        transition-timing-function: linear;
        transition: background-image 2s smooth;
    }

    /* body {
        font-family: "Bricolage Grotesque", sans-serif;
        font-style: normal;
        font-size: 1.4rem;
        background-image: none;
        transition-property: margin;
        transition-duration: 1s;
        transition-timing-function: linear;
        transition: background-image 2s smooth;
    } */

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
            height: 80%;
            top: 80px;
        }
    }

    /*  */
</style>

<body class="app"
    style="background-image: url('{{ asset('user/assets/images/register.png') }}'); background-repeat:no-repeat;background-size: cover;background-position: center;
           height: 100vh;
           margin: 0;">
    <div class="login-container">
        <div class="login-content">
            <x-session-message />
            <div class="login-content_header">
                <h2>Register</h2>
            </div>
            <div>
                <form method="POST" action="{{ route('register') }}" class="login-form">
                    @csrf
                    <label for="name" class="mt-2">Name</label>
                    <input type="text" name="name" placeholder="Enter your name" required>
                    <label for="email" class="mt-2">Email Address</label>
                    <input type="email" name="email" placeholder="Enter your email address" required>
                    <label for="school" class="mt-2">School</label>
                    <select name="school_id" class="mt-2 form-control"
                        style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 18px;" required>
                        <option value="">Select a school</option>
                        @foreach ($schools as $school)
                            <option value="{{ $school->id }}">{{ $school->school_name }}</option>
                        @endforeach
                    </select>
                    {{-- <label for="" class="mt-2">Contact Number</label>
                    <input type="text" placeholder="+91 0000000000"> --}}
                    <label for="password" class="mt-4">Password</label>
                    <input type="password" name="password" placeholder="password" required>
                    <label for="password" class="mt-2">Confirm Password</label>
                    <input type="password" name="password_confirmation" placeholder="password" required>
                    <button type="submit">Register</button>
                    <a href="{{ route('login') }}" class="mb-2">Already Register</a>
                </form>
            </div>
        </div>
        <div class="login-footer"></div>
    </div>
</body>

</html>
