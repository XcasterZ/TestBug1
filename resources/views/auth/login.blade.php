<!doctype html>
<html lang="en">

<head>
    <title>SADUAKPRA</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/login.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#login-form').on('submit', function(event) {
                event.preventDefault();

                const username = $('input[name="username"]').val();
                const password = $('input[name="password"]').val();

                $.ajax({
                    url: '{{ route('auth.login') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        username: username,
                        password: password
                    },
                    success: function(response) {
                        if (response.success) {
                            window.location.href = '{{ url('/') }}';
                        } else {
                            alert('Invalid username or password.');
                        }
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                        alert('An error occurred. Please try again.');
                    }
                });
            });

            // Forgot Password form submit handler
            $('#forgot-password-form').on('submit', function(event) {
                event.preventDefault();

                const email = $('input[name="email"]').val();

                $.ajax({
                    url: '{{ route('auth.password.email') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        email: email
                    },
                    success: function(response) {
                        alert('Reset password link has been sent to your email.');
                        $('#forgotPasswordModal').modal('hide');
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;
                            const errorMessages = Object.values(errors).flat().join('\n');
                            alert('Error:\n' + errorMessages);
                        } else {
                            alert('An error occurred. Please try again.');
                        }
                    }
                });
            });
        });
    </script>
</head>

<body>
    <div id="stars"></div>
    <div id="stars2"></div>
    <div id="stars3"></div>
    <div class="section">
        <div class="container">
            <div class="row full-height justify-content-center">
                <div class="col-12 text-center align-self-center py-5">
                    <div class="section pb-5 pt-5 pt-sm-2 text-center">
                        <div class="card-3d-wrap mx-auto">
                            <div class="card-3d-wrapper">
                                <div class="card-front">
                                    <div class="center-wrap">
                                        <div class="section text-center">
                                            <h4 class="mb-4 pb-3">Log In</h4>
                                            <form id="login-form" action="{{ route('auth.login') }}" method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <input type="text" name="username" class="form-style"
                                                        placeholder="Username" required>
                                                    <i class="input-icon uil uil-user"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="password" name="password" class="form-style"
                                                        placeholder="Password" required>
                                                    <i class="input-icon uil uil-lock-alt"></i>
                                                </div>
                                                <div>
                                                    <button type="submit" class="btn mt-4">Login</button>
                                                    <br>
                                                    <button type="button" class="btn mt-4 google"
                                                        onclick="window.location.href='{{ route('auth.google.redirect') }}'">Google</button>
                                                    <button type="button" class="btn mt-4 facebook"
                                                        onclick="window.location.href='{{ route('auth.facebook.redirect') }}'">Facebook</button>
                                                </div>
                                            </form>
                                            <p class="mb-0 mt-4 text-center">
                                                <a href="#" class="link" data-toggle="modal"
                                                    data-target="#forgotPasswordModal">Forgot your password?</a>
                                            </p>
                                            <p class="mb-0 mt-4 text-center">
                                                <a href="{{ route('auth.register') }}" class="link">Not have
                                                    account?</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Forgot Password Modal -->
    <div class="modal fade" id="forgotPasswordModal" tabindex="-1" role="dialog"
        aria-labelledby="forgotPasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="forgotPasswordModalLabel">Reset Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="forgot-password-form">
                        <div class="form-group" style="margin-top: -60px">
                            <label for="email">Enter your email address</label>
                            <input type="email" name="email" class="form-control" placeholder="example@example.com"
                                required>
                        </div>
                        <div class="form-group text-center" style="margin-top: 20px">
                            <button type="submit" class="btn btn-primary btn-block">Send Reset Link</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const usernameInput = document.querySelector('input[name="username"]');
        const passwordInput = document.querySelector('input[name="password"]');

        usernameInput.addEventListener('input', function(event) {
            const value = event.target.value;
            // Remove any non-alphanumeric characters
            event.target.value = value.replace(/[^A-Za-z0-9]/g, '');
        });

        passwordInput.addEventListener('input', function(event) {
            const value = event.target.value;
            // Remove spaces
            event.target.value = value.replace(/\s+/g, '');
        });
    });
</script>
<style>
    .facebook {
        background-color: #4267B2;
        color: white;
    }

    .google {
        background-color: #DB4437;
        color: white;
    }

    .modal-content {
        padding: 20px;
        border-radius: 10px;
    }

    .modal-body {
        padding: 20px;
    }

    .btn-block {
        width: 100%;
    }

    .form-control {
        border-radius: 5px;
        padding: 10px;
        font-size: 16px;
    }

    .modal-header {
        border-bottom: none;
    }

    .modal-title {
        font-weight: bold;
    }

    .close {
        font-size: 1.5rem;
    }

    .modal-dialog-centered {
        display: flex;
        justify-content: center;
    }

    .btn-primary {
        background-color: #007BFF;
        border: none;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }
</style>

</html>
