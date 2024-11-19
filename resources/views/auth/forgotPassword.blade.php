{{-- <!DOCTYPE html>
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
                <h2>Forgot Password</h2>
            </div>
            <div class="container mt-5">
                <form method="POST" action="{{ route('verifyEmail') }}" class="login-form">
                    @csrf
                    <div class="form-group">
                        <label for="email" class="mt-2">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Enter your email"
                            required>
                    </div>
                    <button id="signin-btn" class="btn btn-lg btn-success btn-block mt-4" type="submit"
                        style="border-radius: 30px; background:#02b07b;">Send OTP</button>
                </form>
            </div>
        </div>
        <div class="login-footer"></div>
    </div>
</body>

</html> --}}

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
</style>

<body class="app"
    style="background-image: url('{{ asset('user/assets/images/register.png') }}'); background-repeat:no-repeat;background-size: cover;background-position: center; height: 100vh; margin: 0;">
    <div class="login-container">
        <div class="login-content">
            <x-session-message />
            <div class="login-content_header">
                <h2>Forgot Password</h2>
            </div>
            <div class="container mt-5">
                <form class="login-form" id="email-form">
                    @csrf
                    <div class="form-group">
                        <label for="email" class="mt-2">Email</label>
                        <input type="email" class="form-control" name="email" id="email"
                            placeholder="Enter your email" required>
                    </div>
                    <button id="send-otp-btn" class="btn btn-lg btn-success btn-block mt-4" type="button"
                        onclick="emailVerify()" style="border-radius: 30px; background:#02b07b;">Send OTP</button>
                </form>
                <form method="POST" action="{{ route('emailVerifyOtp') }}" class="login-form" id="otp-form"
                    style="display: none;">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="email" id="emailId">
                        <label for="otp" class="mt-2">OTP</label>
                        <input type="text" class="form-control" name="otp" placeholder="Enter OTP" required>
                    </div>
                    <button class="btn btn-lg btn-success btn-block mt-4" type="submit"
                        style="border-radius: 30px; background:#02b07b;">Verify OTP</button>
                </form>
            </div>
        </div>
        <div class="login-footer"></div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function emailVerify() {
            var email = document.getElementById('email').value;
            $.ajax({
                url: "{{ route('verifyEmail') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "email": email
                },
                success: function(resp) {
                    if (resp.error) {
                        alert(resp.error);
                    } else {
                        $("#test").html(resp);
                        document.getElementById('emailId').value = resp.email;
                        $('#email-form').hide();
                        $('#otp-form').show();
                        // window.location.reload();
                    }
                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.responseJSON.error;
                    alert(errorMessage);
                }
            });
        }
    </script>
</body>

</html>
