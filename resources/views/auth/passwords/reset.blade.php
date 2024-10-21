<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            font-weight: 300;
            line-height: 1.7;
            color: #ffffff;
            background-color: #1f2029;
            overflow: hidden;
            height: 100vh;
            background: radial-gradient(ellipse at bottom, #1B1A55 0%, #12141d 100%);
        }

        .form-control {
            background-color: #333;
            color: white;
        }

        .form-control::placeholder {
            color: #aaa;
        }

        .form-control:focus {
            background-color: #444;
            color: white;
            border-color: #007bff;
        }

        .error-message {
            color: #ff4d4d; /* สีแดงสำหรับข้อความผิดพลาด */
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Reset Password</h1>
        <form id="reset-password-form" class="mt-4">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label for="password">New Password:</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Enter new password" required>
                <small class="form-text error-message">Minimum 8 digits and Supported characters: a-z, A-Z, 0-9, !@#$%^&*()_+={}\[\]|\\:;"'<>,.?/-</small>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirm Password:</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm new password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
        </form>
        <div class="text-center mt-3">
            <a href="{{ route('login') }}" class="text-white">Back to Login</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#reset-password-form').on('submit', function(e) {
                e.preventDefault(); // หยุดการส่งฟอร์มแบบปกติ

                const email = $('#email').val();
                const password = $('#password').val();
                const passwordConfirmation = $('#password_confirmation').val();
                const token = $('input[name="token"]').val();

                const allowedPattern = /^[a-zA-Z0-9!@#$%^&*()_+={}\[\]|\\:;"'<>,.?/-]*$/;

                // ตรวจสอบรหัสผ่านให้ตรงกันและมีเงื่อนไข
                if (password !== passwordConfirmation) {
                    alert('รหัสผ่านไม่ตรงกัน');
                    return; // หยุดการส่งฟอร์ม
                }

                if (password.length < 8 || !allowedPattern.test(password)) {
                    alert('รหัสผ่านต้องมีอย่างน้อย 8 หลักและใช้ตัวอักษรที่รองรับ');
                    return; // หยุดการส่งฟอร์ม
                }

                $.ajax({
                    url: '{{ route('password.update') }}',
                    method: 'POST',
                    data: {
                        email: email,
                        password: password,
                        password_confirmation: passwordConfirmation,
                        token: token,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        alert('รีเซ็ตรหัสผ่านสำเร็จ');
                        window.location.href = '{{ route('login') }}'; // Redirect to login
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) { // ตรวจสอบว่าเป็นข้อผิดพลาดการตรวจสอบ
                            const errors = xhr.responseJSON;
                            if (errors.error) {
                                alert('อีเมลไม่ตรง'); // แสดงข้อความที่ส่งจากเซิร์ฟเวอร์
                            } else {
                                alert('เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้ง');
                            }
                        } else {
                            alert('เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้ง');
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>
