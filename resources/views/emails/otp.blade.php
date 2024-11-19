<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DECODING ME</title>
</head>

<body>
    {{-- <h2>Dear {{ $mailData['name'] }},</h2> --}}
    <h3>Your One-Time Password (OTP) for accessing your Decoding Me account is <b>{{ $otp }}</b>. This code
        is valid
        for 10 minutes and is meant to ensure the security of your account.
    </h3>
    <p><br><br><br>
        Regards,<br>
        Team Decoding Me
    </p>
</body>

</html>
