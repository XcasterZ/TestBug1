<!doctype html>
<html lang="en">
<head>
    <title>Verify OTP</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h4 class="text-center mt-5">Enter OTP</h4>
        <form method="POST" action="{{ route('auth.login') }}">
            @csrf
            <div class="form-group">
                <input type="text" name="otp" class="form-control" placeholder="Enter OTP" required maxlength="6">
            </div>
            <button type="submit" class="btn btn-primary btn-block">Verify</button>
        </form>
    </div>
</body>
</html>
