@vite('resources/js/app.js')

<script>
    var loggedInUserId = parseInt('{{ auth()->check() ? auth()->user()->id : 0 }}', 10);
    var usersMap = @json($users->pluck('username', 'id'));
    let isSending = false;
    let currentUserId = null; // กำหนด currentUserId ที่นี่

    if (loggedInUserId === 0) {
        console.error('User is not authenticated.');
        window.location.href = '/login';
    }

    document.getElementById('message_form').addEventListener('submit', function(e) {
        e.preventDefault();

        if (isSending) return; // ถ้ากำลังส่งอยู่ให้ไม่ทำอะไร

        const message = document.getElementById('message_input').value;
        if (!currentUserId) {
            alert('กรุณาเลือกผู้ใช้ที่ต้องการส่งข้อความก่อน');
            return;
        }

        isSending = true;
        axios.post('/send-message', {
                message: message,
                recipient: currentUserId
            })
            .then(response => {
                isSending = false;
                if (response.data.success) {
                    // appendMessage(message, loggedInUserId); // แสดงข้อความที่ส่งไปแล้ว
                    document.getElementById('message_input').value = '';
                } else {
                    alert('ไม่สามารถส่งข้อความได้');
                }
            })
            .catch(error => {
                isSending = false;
                console.error('Error:', error);
            });
    });

    function selectUser(username) {
        currentUserId = username; // กำหนด currentUserId เป็น username หรือ ID ที่เหมาะสม
        document.getElementById('message_input').placeholder = 'พิมพ์ข้อความถึง ' + username + '...';
        document.getElementById('selected-user').innerText = 'กำลังแชทกับ: ' + username;

        document.getElementById('message_input').disabled = false;
        document.getElementById('message_send').disabled = false;

        getChatHistory(username);
    }

    function appendMessage(message, senderId) {
        let messages = document.getElementById('messages');
        let messageElement = document.createElement('div');

        if (senderId === loggedInUserId) {
            // ถ้า senderId ตรงกับผู้ใช้ที่ล็อกอินอยู่ แสดงข้อความทางฝั่งขวา (sent)
            messageElement.classList.add('message', 'sent');
            messageElement.innerHTML = `<strong>คุณ:</strong> ${message}`;
            console.log(`Message sent: ${message}`); // แสดงข้อความที่ส่ง

        } else {
            // ตรวจสอบว่า username มีค่าหรือไม่
            const username = usersMap[senderId] ? usersMap[senderId] : `User ${senderId}`;
            messageElement.classList.add('message', 'received');
            messageElement.innerHTML = `<strong>${username}:</strong> ${message}`;
            console.log(`Message received from ${username}: ${message}`); // แสดงข้อความที่ได้รับ
        }

        console.log('Appending message...');
        messages.appendChild(messageElement);
        messages.scrollTop = messages.scrollHeight;
    }



    function getChatHistory(username) {
        axios.get('/chat-history/' + username)
            .then(response => {
                let messages = document.getElementById('messages');
                messages.innerHTML = '';

                response.data.forEach(chat => {
                    appendMessage(chat.message, chat.sender);
                });

                messages.scrollTop = messages.scrollHeight;
            })
            .catch(error => {
                console.error(error);
            });
    }
</script>

