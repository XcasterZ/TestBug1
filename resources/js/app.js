import './bootstrap';

const messages_el = document.getElementById("messages");
const message_input = document.getElementById("message_input");
const message_form = document.getElementById("message_form");

const recipientInput = document.getElementById("recipient_input");
var loggedInUserId = window.loggedInUserId;
// var currentUserId = window.currentUserId;
message_form.addEventListener('submit', function (e) {
    e.preventDefault();

    let has_errors = false;

    if (message_input.value === "") {
        alert("Please enter a message");
        has_errors = true;
    }

    if (has_errors) {
        return;
    }

    const options = {
        method: 'post',
        url: '/send-message2',
        data: {
            recipient: recipientInput.value, // ส่งชื่อผู้รับ
            message: message_input.value // ส่งเฉพาะข้อความ
        }
    }

    axios(options)
        .then(response => {
            console.log(response.data);
            // appendMessage(response.data.message, loggedInUserId); // เพิ่มข้อความที่ส่งไป
            message_input.value = '';  // ล้างข้อความหลังจากส่งแล้ว
        })
        .catch(error => {
            console.error('Error sending message:', error);
        });
});

// ฟังข้อความที่ถูกส่ง
window.Echo.leave('chat'); // ออกจาก channel ก่อนเพื่อป้องกันการฟังซ้ำ
window.Echo.channel('chat')
    .listen('.message', (e) => {
        console.log("Received message from Pusher:", e);
        console.log("username received:", e.username);
        
        // ตรวจสอบว่า senderId หรือ recipientId ตรงกับ loggedInUserId และ currentUserId ต้องตรงกับ loggedInUserId
        if (e.senderId === loggedInUserId || (e.recipientId === loggedInUserId && e.username === currentUserId) )  {
            const recipientUsername = e.recipientUsername || 'Unknown User'; // เช็ค recipientUsername
            appendMessage(e.message, e.senderId, false, recipientUsername, e.recipientId); // เรียกใช้ appendMessage
            console.log("CurrentUserId:", currentUserId); // แสดงค่า LoggedInUserId ในคอนโซล
            updateChatUI(e);
        } else {
            console.log('Message ignored: conditions not met');
        }
    });



document.addEventListener('DOMContentLoaded', function () {

        // console.log("LoggedInUserId:", loggedInUserId);

    if (currentUserId) {
        getChatHistory(currentUserId); // เรียกเมื่อรีเฟรชหน้าเพื่อดึงข้อมูลแชท
    }
});

document.addEventListener('userSelected', function(event) {
    const currentUserId = event.detail; // รับค่าจาก event
    // console.log("Current User ID updated:", currentUserId);
    getChatHistory(currentUserId); // เรียกใช้ฟังก์ชันเมื่อมีการอัปเดต currentUserId
});