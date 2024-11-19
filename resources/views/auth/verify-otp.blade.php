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
                <h2>Enter the OTP sent to</h2>
            </div>
            <div>
                <form method="POST" action="{{ route('verify.otp') }}" class="login-form">
                    @csrf
                    <input type="hidden" name="email" value="{{ $email }}">
                    <label for="otp" class="mt-2">OTP</label>
                    <input type="text" name="otp" placeholder="Enter the OTP sent to your email" required>
                    <button type="submit">Verify OTP</button>
                </form>
            </div>
        </div>
        <div class="login-footer"></div>
    </div>
</body>

</html>
