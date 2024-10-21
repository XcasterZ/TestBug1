<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chat Application</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <!-- นำเข้าฟอนต์ Kanit จาก Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        /* ใช้ฟอนต์ Kanit ทั่วทั้งหน้าเว็บ */
        body,
        h1,
        h5,
        h4,
        .list-group-item,
        .alert {
            font-family: 'Kanit', sans-serif;
        }

        body {
            background-color: #f8f9fa;
            /* height: 100vh; */
            overflow-y: auto;
            /* เพิ่ม scrollbar เมื่อเนื้อหาเกินความสูง */
        }

        #recipient_input {
            display: none;
        }

        .app {

            display: flex;
            flex-direction: column;
            height: 100%;
            max-width: 800px;
            margin: auto;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-top: 10px;
        }

        header {
            background-color: #007bff;
            padding: 1rem;
        }

        #messages {
            flex: 1;
            overflow-y: auto;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #ffffff;
            margin: 15px;
            margin-right: 0px;
            padding: 10px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            height: 400px;
        }

        .flex-fill {
            padding: 10px;
        }

        .message {
            display: block;
            /* ข้อความแต่ละข้อความจะอยู่คนละบรรทัด */
            padding: 8px;
            border-radius: 5px;
            word-wrap: break-word;
            width: fit-content;
            /* ให้พื้นหลังมีขนาดตามความยาวของข้อความ */
            max-width: 80%;
            /* จำกัดความกว้างสูงสุดของข้อความ */
            margin-bottom: 10px;
        }

        .message.sent {
            text-align: right;
            margin-left: auto;
            background-color: #d4edda;
        }

        .message.received {
            text-align: left;
            margin-right: auto;
            background-color: #f1f1f1;
        }


        .input-group {
            margin: 15px;
            display: flex;
        }

        #message_input {
            flex-grow: 0.97;
            width: 0;
        }

        #attach_image {
            min-width: 40px;
            /* กำหนดขนาดขั้นต่ำของปุ่มแนบรูปภาพ */
        }

        .users-list {
            border-right: 1px solid #ccc;
        }

        .users-list h4 {
            padding: 10px;
            text-align: center;
        }

        .list-group-item {
            cursor: pointer;
            margin-right: 10px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .list-group-item:hover {
            background-color: #e9ecef;
        }

        #selected-user {
            margin: 15px;
            margin-right: 0;
            text-align: center;
        }

        .input-group-append {
            display: flex;
        }

        #message_send {
            height: 100%;
            min-width: 40px;
            max-width: 60px;
        }

        .users-list h4 {
            font-size: 1.5rem;
        }

        #back_button {
            /* position: absolute; ทำให้ปุ่มอยู่ที่ตำแหน่งแน่นอน */
            width: calc(100% - 10px);
            /* ลดความกว้างของปุ่มลง 10px */
            top: 50%;
            /* แนวนอนตรงกลาง */
            transform: translateY(-50%);
            /* ปรับตำแหน่งให้กลางแนวนอน */
            background-color: #1e00ff;
            /* พื้นหลัง */
            border: none;
            /* ไม่มีขอบ */
            color: rgb(255, 255, 255);
            /* เปลี่ยนสีตัวอักษรเป็นขาว */
            font-size: 1rem;
            /* ขนาดฟอนต์ */
            cursor: pointer;
            /* แสดงเป็น pointer เมื่อ hover */
            border-radius: 50px;
            /* ทำให้ขอบมน */
            padding: 10px;
            /* เพิ่ม padding รอบๆ ปุ่ม */
            transition: background-color 0.3s ease;
            /* เพิ่มการเปลี่ยนแปลงของสีพื้นหลังเมื่อ hover */
            margin-right: 10px;
            /* เว้นขอบด้านขวา 10px */
            margin-bottom: -20px;
            margin-top: 30px;
        }


        #back_button:hover {
            background-color: rgba(30, 0, 255, 0.7);
            /* ทำให้สีจางลงเมื่อ hover */
            text-decoration: none;
            /* ไม่ต้องการเส้นใต้เมื่อ hover */
        }

        .product-info {
            background-color: #e9ecef;
            /* สีพื้นหลัง */
            border-radius: 5px;
            /* ขอบมน */
            padding: 10px;
            /* เพิ่ม padding */
            margin-bottom: 15px;
            /* เพิ่มระยะห่างจากข้อความก่อนหน้า */
        }


        @media (max-width: 768px) {
            .users-list h4 {
                font-size: 1.2rem;
            }
        }

        @media (max-width: 576px) {
            .users-list h4 {
                font-size: 1rem;
            }
        }
    </style>
</head>

<body>
    <div class="app d-flex">
        <header class="text-white text-center w-100">
            <h1>Chat Application</h1>
            <h5>Welcome, {{ $currentUser }}</h5>
        </header>

        <div class="d-flex flex-fill">
            <div class="users-list mt-3 w-25">
                <button id="back_button" onclick="goBack()"> ⬅ back</button> <!-- ปุ่มย้อนกลับ -->
                <h4>ผู้ใช้งานทั้งหมด</h4>
                <ul class="list-group">
                    @foreach ($users as $user)
                        <li class="list-group-item"
                            onclick="selectUser('{{ $user->username }}', '{{ $user->id }}')">
                            {{ $user->username }}
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="flex-fill">
                <div id="selected-user" class="alert alert-info">กำลังแชทกับ: <strong>ไม่มีการเลือกผู้ใช้</strong></div>
                <div id="messages" class="mb-3"></div>

                <form action="" id="message_form" class="input-group">
                    <div class="input-group-prepend">
                        <button type="button" id="attach_image" class="btn btn-secondary">📎</button>
                    </div>
                    <input type="text" name="message" id="message_input" class="form-control"
                        placeholder="Message...." disabled>
                    <input type="text" id="recipient_input" placeholder="Recipient Username" required>
                    <div class="input-group-append">
                        <button type="submit" id="message_send" class="btn btn-success" disabled>Send</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    @vite('resources/js/app.js')

    <script>
        var loggedInUserId = parseInt('{{ auth()->check() ? auth()->user()->id : 0 }}', 10);
        window.loggedInUserId = {{ auth()->check() ? auth()->user()->id : 0 }};
        var usersMap = @json($users->pluck('username', 'id'));
        const loggedInUserName = '{{ Auth::user()->username }}'; // สมมติว่าคุณใช้ Laravel และ Auth
        let isSending = false;
        let currentUserId = null; // กำหนด currentUserId ที่นี่

        if (loggedInUserId === 0 || loggedInUserName === null) {
            console.error('User is not authenticated.');
            window.location.href = '/login';
        }


        // ภายใน event listener ของการส่งข้อความ
        document.getElementById('message_form').addEventListener('submit', function(e) {
            e.preventDefault();

            if (isSending) return; // ถ้ากำลังส่งอยู่ให้ไม่ทำอะไร
            const recipientInput = document.getElementById("recipient_input");

            const message = document.getElementById('message_input').value;

            if (!currentUserId) {
                alert('กรุณาเลือกผู้ใช้ที่ต้องการส่งข้อความก่อน');
                return;
            }

            if (message.trim() === '') {
                alert('กรุณากรอกข้อความ');
                return; // หยุดการทำงานหากข้อความว่าง
            }

            isSending = true;
            axios.post('/send-message', {
                    message: message,
                    recipient: recipientInput.value, // ส่งชื่อผู้รับ
                })
                .then(response => {
                    isSending = false;
                    if (response.data.success) {
                        // appendMessage(message, loggedInUserId, false); // แสดงข้อความที่ส่งไปแล้ว
                        document.getElementById('message_input').value = ''; // ส่งข้อมูลผลิตภัณฑ์
                    } else {
                        alert('ไม่สามารถส่งข้อความได้');
                    }
                })
                .catch(error => {
                    isSending = false;
                    console.error('Error:', error);
                });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const username_login = loggedInUserName;
            const urlParams = new URLSearchParams(window.location.search);
            const sellerId = urlParams.get('seller_id'); // รับค่าจาก URL
            const productId = urlParams.get('product_id');
            const productImage = urlParams.get('image');
            const productName = urlParams.get('name');
            const productPrice = urlParams.get('price');
            const productQuantity = urlParams.get('quantity');
            const currentUrl = urlParams.get('current_url');

            // ตรวจสอบว่ามี seller_id ใน URL และ seller_id ไม่ตรงกับ loggedInUserName
            if (sellerId && sellerId !== loggedInUserName) {
                selectUser(sellerId); // เรียกใช้ฟังก์ชัน selectUser ทันที
            }

            // ถ้ามีข้อมูลสินค้าที่ส่งมาจาก shop.blade
            if (productId && productImage && productName && productPrice && productQuantity) {
                // สร้าง object เพื่อเก็บข้อมูลสินค้า
                const productMessage = {
                    productId: productId,
                    productImage: productImage,
                    productName: productName,
                    productPrice: productPrice,
                    productQuantity: productQuantity,
                    urlParams: urlParams,
                    sellerId: sellerId,
                    currentUrl: currentUrl,
                };

                // เรียกใช้ฟังก์ชัน appendMessage เพื่อแสดงสินค้าทันทีในช่องแชท
                appendMessage('', loggedInUserId, false, null, null, productMessage);
            }

        });

        function smoothScrollToBottom(element) {
            const targetPosition = element.scrollHeight;
            let currentPosition = element.scrollTop;
            const scrollStep = 10; // ความเร็วในการเลื่อน
            const scrollInterval = 15; // ความถี่ในการเลื่อน (หน่วยมิลลิวินาที)

            function scroll() {
                if (currentPosition < targetPosition) {
                    currentPosition += scrollStep;
                    element.scrollTop = currentPosition;
                    requestAnimationFrame(scroll); // เรียกใช้ฟังก์ชันนี้ใหม่
                } else {
                    element.scrollTop = targetPosition; // ตั้งค่าตำแหน่งสุดท้าย
                }
            }

            scroll(); // เริ่มการเลื่อน
        }

        function getChatHistory(username) {
            if (!username) return;

            axios.get('/chat-history/' + username)
                .then(response => {
                    let messages = document.getElementById('messages');
                    messages.innerHTML = ''; // ล้างข้อมูลเก่าก่อน

                    response.data.forEach(chat => {

                        console.log('sender', chat.sender_username); // แสดงชื่อผู้ส่ง
                        console.log('currentUserId', currentUserId);
                        console.log('recipient', chat.recipient); // ID ของผู้รับ
                        console.log('loggedInUserId', loggedInUserId); // ID ของผู้ใช้ที่ล็อกอิน
                        // ถ้ามีข้อมูลสินค้า
                        if (chat.product_name) {
                            appendMessage(null, chat.sender, false, null, null, {
                                productName: chat.product_name,
                                productImage: chat.product_image,
                                productPrice: chat.product_price,
                                productQuantity: chat.product_quantity,
                                sellerId: chat.seller_id,
                                currentUrl: chat.current_url
                            });
                        } else if (chat.image_url) {
                            appendMessage(chat.image_url, chat.sender, true); // รูปภาพ
                        } else {
                            appendMessage(chat.message, chat.sender, false); // ข้อความปกติ
                        }
                    });

                    setTimeout(() => {
                        smoothScrollToBottom(messages);
                    }, 100);

                })
                .catch(error => {
                    // แสดงข้อผิดพลาดใน console log
                    console.error('Error retrieving chat history:', error);

                    // ถ้า error มาจาก response (เช่น 404 หรือ 500)
                    if (error.response) {
                        console.log('Response data:', error.response.data);
                        console.log('Response status:', error.response.status);
                        console.log('Response headers:', error.response.headers);
                    } else if (error.request) {
                        // ถ้า request ถูกส่งแต่ไม่ได้รับ response
                        console.log('Request error:', error.request);
                    } else {
                        // ถ้าเป็น error อื่น ๆ ที่เกี่ยวกับการตั้งค่า
                        console.log('Error message:', error.message);
                    }

                    console.log('Error config:', error.config);
                });

        }

        function appendMessage(message, senderId, isImage = false, recipientUsername, recipientId, productMessage) {
            if (!currentUserId) return;

            let messages = document.getElementById('messages');
            let messageElement = document.createElement('div');
            const fullImageUrl = message && message.startsWith('/') ? `http://localhost:8000${message}` : message;
            const username = senderId === loggedInUserId ? 'คุณ' : (usersMap[senderId] ? usersMap[senderId] :
                `User ${senderId}`);

            // ตรวจสอบและแสดงรูปภาพ
            if (isImage) {
                messageElement.classList.add('message', senderId === loggedInUserId ? 'sent' : 'received');
                messageElement.innerHTML = `<strong>${username}:</strong><br>
            <img src="${fullImageUrl}" alt="Image" style="max-width: 100%; height: auto;">`;
                console.log(`Image ${senderId === loggedInUserId ? 'sent' : 'received'}: ${fullImageUrl}`);
            }
            // ตรวจสอบข้อความปกติ
            else if (message) {
                messageElement.classList.add('message', senderId === loggedInUserId ? 'sent' : 'received');

                if (message.startsWith('/Chat_pic/')) {
                    messageElement.innerHTML = `<strong>${username}:</strong><br>
            <img src="${fullImageUrl}" alt="Image" style="max-width: 100%; height: auto;">`;
                    console.log(`Image received from ${username}: ${fullImageUrl}`);
                } else {
                    messageElement.innerHTML = `<strong>${username}:</strong> ${message}`;
                    console.log(`Message received from ${username}: ${message}`);
                }
            }
            // กรณีที่มีข้อมูลสินค้า
            else if (productMessage) {
                messageElement.classList.add('message', senderId === loggedInUserId ? 'sent' : 'received');

                // ตรวจสอบว่าสินค้าเป็นวิดีโอหรือรูปภาพ
                const isVideo = productMessage.productImage.endsWith('.mp4') || productMessage.productImage.endsWith(
                    '.webm');
                let productMedia = '';

                if (isVideo) {
                    // ถ้าเป็นวิดีโอ
                    productMedia = `<video width="150px" height="auto" autoplay="false">
                        <source src="${productMessage.productImage}" type="video/mp4">
                        Your browser does not support the video tag.</video>`;
                    console.log(`Video received from ${username}: ${productMessage.productImage}`);
                } else {
                    // ถ้าเป็นรูปภาพ
                    productMedia =
                        `<img src="${productMessage.productImage}" alt="Product Image" style="max-width: 150px; height: auto;">`;
                    console.log(`Image received from ${username}: ${productMessage.productImage}`);
                }

                // แสดงข้อมูลสินค้า
                messageElement.innerHTML = `
            <strong>${username} ส่งสินค้า:</strong>
            <div class="product">
                ${productMedia}
                <div>ชื่อสินค้า: ${productMessage.productName}</div>
                <div>ราคา: ${productMessage.productPrice} บาท</div>
                <div>จำนวน: ${productMessage.productQuantity}</div>
                <a href="${productMessage.currentUrl}" target="_blank">ดูรายละเอียดเพิ่มเติม</a>
            </div>`;
            }

            // เพิ่มข้อความใหม่ลงใน element messages
            console.log('Appending message...');
            messages.appendChild(messageElement);
            messages.scrollTop = messages.scrollHeight;
        }

        function selectUser(userId) {
            // console.log('User Id:', userId);
            const urlParams = new URLSearchParams(window.location.search);
            const sellerId = urlParams.get('seller_id'); // รับค่าจาก URL
            const username_login = loggedInUserName;
            // console.log('sellerId = ', sellerId);
            // console.log('userId = ', userId);
            // console.log('username_login = ', username_login);

            // เช็คเงื่อนไขที่ต้องการ
            if (sellerId === userId && sellerId !== username_login) {
                // console.log('Seller ID matches userId:', sellerId);
                currentUserId = sellerId; // กำหนด currentUserId เป็น sellerId
            } else {
                // console.log('Seller ID does not match userId');
                currentUserId = userId; // หากไม่ตรงกัน กำหนด currentUserId เป็น userId
            }
            window.currentUserId = currentUserId; // ให้ currentUserId อยู่ใน scope ของ window
            // console.log('Current user', currentUserId);
            document.getElementById('recipient_input').value = currentUserId; // ตั้งค่าชื่อผู้รับใน input
            // console.log('Recipient username', usersMap[currentUserId]);
            document.getElementById('message_input').placeholder = 'พิมพ์ข้อความถึง ' + userId + '...';
            document.getElementById('selected-user').innerText = 'กำลังแชทกับ: ' + userId;
            // console.log('currentUserId:', currentUserId);

            document.getElementById('message_input').disabled = false;
            document.getElementById('message_send').disabled = false;

            const event = new CustomEvent('userSelected', {
                detail: currentUserId
            });
            document.dispatchEvent(event);

            getChatHistory(currentUserId);

            // setInterval(() => {
            //     if (currentUserId && loggedInUserId) {
            //         getChatHistory(currentUserId);
            //     }
            // }, 5000);
        }

        document.getElementById('attach_image').addEventListener('click', function() {
            if (!currentUserId) {
                alert('กรุณาเลือกผู้ใช้ที่ต้องการส่งข้อความก่อน');
                return;
            }
            const fileInput = document.createElement('input');
            fileInput.type = 'file';
            fileInput.accept = 'image/jpeg, image/png, image/jpg, image/gif';

            fileInput.onchange = function(event) {
                const file = event.target.files[0];
                if (file) {
                    const formData = new FormData();
                    formData.append('image', file);
                    formData.append('recipient', currentUserId);

                    console.log('FormData:', formData); // Log ข้อมูลของ FormData

                    axios.post('/upload-image', formData, {
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            }
                        })
                        .then(response => {
                            if (response.data.success) {
                                // สร้าง URL สำหรับรูปภาพที่อัปโหลด
                                const imageUrl = response.data.imageUrl;

                                // ส่งข้อความไปยังผู้รับเพื่อให้เห็นภาพที่ส่ง
                                axios.post('/send-message2', {
                                        message: imageUrl, // ใช้ URL ของภาพที่อัปโหลด
                                        recipient: currentUserId
                                        // })
                                        // .then(() => {
                                        //     // เรียกใช้ฟังก์ชัน appendMessage ที่ฝั่งผู้ส่ง
                                        //     appendMessage(imageUrl, loggedInUserId, true);
                                    })
                                    .catch(error => {
                                        console.error('Error sending image message:', error);
                                    });
                            } else {
                                alert('ไม่สามารถอัปโหลดรูปภาพได้');
                            }
                        })
                        .catch(error => {
                            console.error('Error uploading image:', error);
                        });
                }
            };

            fileInput.click(); // เปิดกล่องเลือกไฟล์
        });

        function goBack() {
            window.history.back(); // ใช้ประวัติการเข้าชมกลับไปยังหน้าก่อนหน้า
        }

    </script>


</body>

</html>
