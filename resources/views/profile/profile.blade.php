@extends('profile_layout')

@section('title', 'Profile')

@section('content2')
    <div class="profile_content2">
        <form id="profileForm" action="{{ route('profile.update') }}" method="POST">
            @csrf
            <div class="myacc">
                <h4>รายละเอียดโปรไฟล์</h4>
                <textarea class="profile-text" name="profile_detail" placeholder="กรอกข้อความที่นี่">{{ old('profile_detail', $user->profile_detail ?? '') }}</textarea>
            </div>
            <div class="edit_profile">
                <div class="input_info">
                    <h4>ชื่อผู้ใช้</h4>
                    <textarea type="text" name="username" placeholder="กรอกชื่อผู้ใช้">{{ old('username', $user->username ?? '') }}</textarea>
                </div>
                <div class="input_info">
                    <h4>อีเมล</h4>
                    <textarea type="text" name="email" placeholder="กรอกอีเมล">{{ old('email', $user->email ?? '') }}</textarea>
                </div>
                <div class="input_info">
                    <h4>ชื่อจริง</h4>
                    <textarea type="text" name="first_name" placeholder="กรอกชื่อจริง">{{ old('first_name', $user->first_name ?? '') }}</textarea>
                </div>
                <div class="input_info">
                    <h4>นามสกุล</h4>
                    <textarea type="text" name="last_name" placeholder="กรอกนามสกุล">{{ old('last_name', $user->last_name ?? '') }}</textarea>
                </div>
                <div class="input_info">
                    <h4>เบอร์โทร</h4>
                    <textarea type="text" name="phone_number" placeholder="กรอกเบอร์โทร" pattern="[0-9]*">{{ old('phone_number', $user->phone_number ?? '') }}</textarea>
                </div>
                <div class="input_info">
                    <h4>Facebook</h4>
                    <textarea type="text" name="facebook" placeholder="url facebook">{{ old('facebook', $user->facebook ?? '') }}</textarea>
                </div>
                <div class="input_info">
                    <h4>Instagram</h4>
                    <textarea type="text" name="instagram" placeholder="url Instagram">{{ old('instagram', $user->instagram ?? '') }}</textarea>
                </div>
                <div class="input_info">
                    <h4>Line</h4>
                    <textarea type="text" name="line" placeholder="url Line">{{ old('line', $user->line ?? '') }}</textarea>
                </div>
            </div>
            <div class="pass_member">
                <div class="change_pass">
                    <button type="button" id="openModalButton">เปลี่ยนรหัสผ่าน</button>
                </div>
                <div class="regis_member">
                    <button>สมัครสมาชิก</button>
                </div>
            </div>

            <div class="save">
                <button type="submit">บันทึก</button>
            </div>
        </form>
    </div>
    <div id="passwordModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>เปลี่ยนรหัสผ่าน</h2>
            <form id="passwordForm">
                <div class="input-group">
                    <label for="old_password">รหัสผ่านเก่า</label>
                    <input type="password" id="old_password" name="old_password" >
                </div>
                <div class="input-group">
                    <label for="new_password">รหัสผ่านใหม่</label>
                    <input type="password" id="new_password" name="new_password" required>
                </div>
                <div class="input-group">
                    <label for="confirm_password">ยืนยันรหัสผ่านใหม่</label>
                    <input type="password" id="confirm_password" name="confirm_password" required>
                    <small class="password-info">อักขระพิเศษที่อนุญาต: !@#$%^&*()_+={}[]|\\:;"'<>,.?/-</small>
                </div>
                <div class="modal-buttons">
                    <button type="button" id="cancelButton" class="btn-cancel">ยกเลิก</button>
                    <button type="submit" class="btn-submit">บันทึก</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('profile_menu')
    <div class="profile_menu">
        <ul>
            <a href="{{ route('profile.edit') }}">
                <li class="active">โปรไฟล์</li>
            </a>
            <a href="{{ route('profile.address') }}">
                <li>ที่อยู่</li>
            </a>
            <a href="{{ route('cart.show') }}">
                <li>ตะกร้า</li>
            </a>
            <a href="{{ route('wishlist.show') }}">
                <li>พระที่ถูกใจ</li>
            </a>
            <a href="{{ route('profile.sell') }}">
                <li>ลงขายพระ</li>
            </a>
            <li>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit"
                        style="background: none; border: none; color: inherit; cursor: pointer; width:100%">ออกจากระบบ</button>
                </form>
            </li>
        </ul>
    </div>
@endsection



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#profileForm').submit(function(e) {
            e.preventDefault(); // Prevent the form from submitting normally

            // Get values
            var username = $('textarea[name="username"]').val();
            var email = $('textarea[name="email"]').val();
            var phoneNumber = $('textarea[name="phone_number"]').val()
                .trim(); // trim to remove whitespace

            // Check if phone number is empty, set to null if so
            if (phoneNumber === '') {
                phoneNumber = null; // ส่งค่า null ไปยังฐานข้อมูล
            } else if (!isValidPhoneNumber(phoneNumber)) {
                alert('เบอร์โทรต้องประกอบด้วยเฉพาะตัวเลขและต้องมีความยาว 10 หลัก');
                return;
            }

            // Validate username and email
            if (!isValidUsername(username)) {
                alert(
                    'ชื่อผู้ใช้สามารถใส่ได้เฉพาะภาษาอังกฤษ ตัวเลข ไม่สามารถเว้นวรรคหรือมีอักขระพิเศษได้'
                    );
                return;
            }
            if (!isValidEmail(email)) {
                alert('อีเมลสามารถใช้ได้เฉพาะภาษาอังกฤษและไม่สามารถเว้นวรรคได้');
                return;
            }

            // Check for username and email availability
            $.ajax({
                type: 'POST',
                url: '{{ route('profile.checkExistingData') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    username: username,
                    email: email,
                    phone_number: phoneNumber, // ส่งค่า phoneNumber ที่อาจเป็น null
                    id: '{{ auth()->id() }}' // Send current user's ID
                },
                success: function(response) {
                    if (response.existsUsername && !response.isSameUsername) {
                        alert('ชื่อผู้ใช้นี้มีอยู่แล้วในระบบ');
                        return;
                    }
                    if (response.existsEmail && !response.isSameEmail) {
                        alert('อีเมลนี้มีอยู่แล้วในระบบ');
                        return;
                    }

                    // Proceed with AJAX submission
                    $.ajax({
                        type: 'POST',
                        url: $('#profileForm').attr('action'),
                        data: $('#profileForm').serialize(),
                        success: function(response) {
                            alert('ข้อมูลได้ถูกบันทึกเรียบร้อยแล้ว');
                        },
                        error: function(error) {
                            console.log(error);
                            alert('เกิดข้อผิดพลาดในการบันทึกข้อมูล');
                        }
                    });
                },
                error: function(error) {
                    console.log(error);
                    alert('เกิดข้อผิดพลาดในการตรวจสอบข้อมูล');
                }
            });
        });



        // Function to validate username
        function isValidUsername(username) {
            var regex = /^[a-zA-Z0-9_]+$/;
            return regex.test(username);
        }

        // Function to validate email
        function isValidEmail(email) {
            var regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            return regex.test(email) && !/\s/.test(email);
        }

        // Function to validate phone number
        function isValidPhoneNumber(phoneNumber) {
            // หากช่องเบอร์โทรว่าง ให้คืนค่า true
            if (phoneNumber.trim() === '') {
                return null; // ส่งค่า true เพื่อไม่ให้มีการแจ้งเตือน
            }
            // ตรวจสอบว่ามีความยาว 10 ตัวและประกอบด้วยเฉพาะตัวเลข
            var regex = /^[0-9]{10}$/;
            return regex.test(phoneNumber);
        }


    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        var modal = document.getElementById("passwordModal");
        var btn = document.querySelector(".change_pass button");
        var span = document.querySelector(".modal .close");
        var cancelButton = document.getElementById("cancelButton");

        // Show the modal
        btn.onclick = function() {
            // Reset input values
            $('#old_password').val('');
            $('#new_password').val('');
            $('#confirm_password').val('');
            modal.style.display = "block";
        }

        // Hide the modal when the user clicks on <span> (x)
        span.onclick = function() {
            modal.style.display = "none";
        }

        // Hide the modal when the user clicks on "Cancel"
        cancelButton.onclick = function() {
            modal.style.display = "none";
        }

        // Hide the modal when the user clicks anywhere outside of the modal
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        // Handle form submission
        $('#passwordForm').submit(function(e) {
            e.preventDefault(); // Prevent the form from submitting normally

            var oldPassword = $('#old_password').val();
            var newPassword = $('#new_password').val();
            var confirmPassword = $('#confirm_password').val();

            if (!/^[a-zA-Z0-9!@#$%^&*()_+={}\[\]|\\:;"'<>,.?/-]*$/.test(oldPassword) ||
                !/^[a-zA-Z0-9!@#$%^&*()_+={}\[\]|\\:;"'<>,.?/-]*$/.test(newPassword) ||
                !/^[a-zA-Z0-9!@#$%^&*()_+={}\[\]|\\:;"'<>,.?/-]*$/.test(confirmPassword)) {
                alert(
                    'รหัสผ่านสามารถใช้ได้เฉพาะภาษาอังกฤษ ตัวเลข และอักขระพิเศษที่ระบุเท่านั้น และห้ามมีการเว้นวรรค'
                );
                return;
            }

            if (newPassword.length < 8 || confirmPassword.length < 8) {
                alert('รหัสผ่านต้องมีความยาวอย่างน้อย 8 ตัวอักษร');
                return;
            }

            // Validate new passwords
            if (newPassword !== confirmPassword) {
                alert('รหัสผ่านใหม่และการยืนยันรหัสผ่านใหม่ไม่ตรงกัน');
                return;
            }

            // Perform AJAX request to check old password
            $.ajax({
                type: 'POST',
                url: '{{ route('profile.check_old_password') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    old_password: oldPassword
                },
                success: function(response) {
                    if (response.success) {
                        // If old password is correct, proceed with updating the new password
                        $.ajax({
                            type: 'POST',
                            url: '{{ route('profile.update_password') }}',
                            data: {
                                _token: '{{ csrf_token() }}',
                                new_password: newPassword
                            },
                            success: function(response) {
                                if (response.success) {
                                    alert('รหัสผ่านได้ถูกเปลี่ยนเรียบร้อยแล้ว');
                                    modal.style.display = 'none';
                                } else {
                                    alert('เกิดข้อผิดพลาดในการเปลี่ยนรหัสผ่าน');
                                }
                            },
                            error: function(error) {
                                alert('เกิดข้อผิดพลาดในการเปลี่ยนรหัสผ่าน');
                            }
                        });
                    } else {
                        alert('รหัสผ่านเก่าที่ป้อนไม่ถูกต้อง');
                    }
                },
                error: function(error) {
                    alert('เกิดข้อผิดพลาดในการตรวจสอบรหัสผ่านเก่า');
                }
            });
        });
    });
</script>
