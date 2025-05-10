<!DOCTYPE html>
<html lang="en">
<head>

  @include('fontend.component.head')
  <style>
       #chat-box {
            height: 300px;
            overflow-y: auto;
            border: 1px solid #e0e0e0;
            margin-bottom: 10px;
            padding: 10px;
            display: flex;
            flex-direction: column; /* Hiển thị tin nhắn từ trên xuống */
            scrollbar-width: thin; /* Cho scrollbar mỏng hơn */
            scrollbar-color: #aab5be #cfd8dc; /* Màu cho scrollbar */
        }

        #chat-box::-webkit-scrollbar {
            width: 8px;
        }

        #chat-box::-webkit-scrollbar-track {
            background: #cfd8dc;
            border-radius: 4px;
        }

        #chat-box::-webkit-scrollbar-thumb {
            background-color: #aab5be;
            border-radius: 4px;
        }

        .message {
            padding: 8px 12px;
            border-radius: 8px;
            margin-bottom: 6px;
            clear: both;
            white-space: pre-wrap; /* Giữ khoảng trắng và xuống dòng */
            overflow-wrap: break-word; /* Tự xuống dòng khi từ quá dài */
            word-break: break-word; /* Hỗ trợ trình duyệt cũ */
        }

        .message.sent {
            background-color: #e1f5fe; /* Màu nền tin nhắn gửi đi */
            color: #1a237e; /* Màu chữ tin nhắn gửi đi */
            align-self: flex-end; /* Căn phải tin nhắn gửi đi */
            border-bottom-right-radius: 16px;
            border-top-right-radius: 16px;
            border-bottom-left-radius: 8px;
            border-top-left-radius: 8px;
            white-space: normal;
            overflow-wrap: break-word;
        }

        .message.received {
            background-color: #f5f5f5; /* Màu nền tin nhắn nhận được */
            color: #212121; /* Màu chữ tin nhắn nhận được */
            align-self: flex-start; /* Căn trái tin nhắn nhận được */
            border-bottom-left-radius: 16px;
            border-top-left-radius: 16px;
            border-bottom-right-radius: 8px;
            border-top-right-radius: 8px;
            white-space: normal;
            overflow-wrap: break-word;
        }

        .message b {
            font-weight: bold;
            margin-right: 5px;
            white-space: normal;
            overflow-wrap: break-word;
        }

        #chat-input {
            display: flex;
            gap: 10px;
            background: #f5f5f5;
            border-top: 1px solid #e0e0e0;
            padding: 10px;
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
        }

        #chat-input input[type="text"] {
            flex: 1;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        #chat-input button {
            padding: 8px 15px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        #chat-toggle-logo {
            position: fixed !important;
            bottom: 40px !important;
            right: 25px !important;
            width: 70px !important;
            height: 70px !important;
            cursor: pointer !important;
            z-index: 1000 !important;
            border-radius: 50% !important;
            animation: glow 1.5s infinite ease-in-out !important;
        }


        @keyframes glow {
            0% {
                box-shadow: 0 0 5px 2px rgba(0, 123, 255, 0.7); /* Ánh sáng ban đầu */
            }
            50% {
                box-shadow: 0 0 20px 10px rgba(0, 123, 255, 0.7); /* Ánh sáng mạnh nhất */
            }
            100% {
                box-shadow: 0 0 5px 2px rgba(0, 123, 255, 0.7); /* Ánh sáng trở lại ban đầu */
            }
        }


    </style>
</head>
<body>
  <!--================ Start Header Menu Area =================-->
	@include('fontend.component.nav')
	<!--================ End Header Menu Area =================-->

    <main class="site-main">
    @if(session('success'))
    <div class="alert alert-success mt-3 text-center">
        {{ session('success') }}
    </div>
    @endif
    @include($template, ['tokens' => $tokens ?? [], 'token' => $token ?? null])
    </main>



  <!--================ Start footer Area  =================-->	
  @include('fontend.component.footer')
	<!--================ End footer Area  =================-->

  @include('fontend.component.script')

</body>


<img id="chat-toggle-logo"
         src="{{ asset('public/fontend/img/chat_logo.png') }}"
         style="position: fixed; bottom: 20px; right: 20px; width: 60px; height: 60px; cursor: pointer; z-index: 1000;"
         onclick="toggleChat()">

    <div id="chat-wrapper" style="position: fixed; bottom: 90px; right: 20px; width: 300px; height: 400px; background: #fff; border: 1px solid #ccc; border-radius: 8px; display: none; z-index: 1000; box-shadow: 0 0 10px rgba(0,0,0,0.2); overflow: hidden;">
        <div id="chat-header" onclick="toggleChat()" style="background: #384aeb; color: white; padding: 10px; text-align: center; font-weight: bold; cursor: pointer;">Trung tâm hỗ trợ</div>
        <div id="chat-content">
            {{-- Nội dung chat sẽ được load ở đây --}}
        </div>
    </div>

    

    <script>
        function toggleChat() {
            const chat = document.getElementById("chat-wrapper");
            if (chat.style.display === "block") {
                chat.style.opacity = 1;
                chat.style.transition = "opacity 0.3s";
                chat.style.opacity = 0;
                setTimeout(() => {
                    chat.style.display = "none";
                    document.getElementById('chat-content').innerHTML = ''; // Xóa nội dung chat khi ẩn
                }, 300);
            } else {
                chat.style.display = "block";
                chat.style.opacity = 0;
                chat.style.transition = "opacity 0.3s";
                setTimeout(() => {
                    chat.style.opacity = 1;
                    loadChatContent(); // Load nội dung chat khi hiển thị
                }, 10);
            }
        }

        function loadChatContent() {
            const chatContent = document.getElementById('chat-content');
            chatContent.innerHTML = '<div style="padding:20px; text-align:center;">Đang tải chat...</div>';

            fetch('/chat')
                .then(response => response.text())
                .then(data => {
                    chatContent.innerHTML = data;
                    initChatScript();
                })
                .catch(error => {
                    chatContent.innerHTML = '<div style="color:red; padding:20px;">Lỗi khi tải chat!</div>';
                    console.error('Lỗi khi tải nội dung chat:', error);
                });
        }

        function initChatScript() {
            if (!localStorage.getItem('chat_token')) {
                localStorage.setItem('chat_token', 'token_' + Math.random().toString(36).substring(2));
            }
            const chatToken = localStorage.getItem('chat_token');

            window.sendMessage = function () {
                const messageInput = document.getElementById('message');
                const messageText = messageInput.value.trim();

                if (messageText) {
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    fetch('/chat/send', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({
                            token: chatToken,
                            message: messageText
                        })
                    }).then(() => {
                        messageInput.value = '';
                        loadMessages();
                    });
                }
            };

            function loadMessages() {
                fetch('/chat/load?token=' + chatToken)
                    .then(res => res.json())
                    .then(data => {
                        const box = document.getElementById('chat-box');
                        box.innerHTML = '';
                        if (Array.isArray(data)) {
                            data.forEach(m => {
                                const messageDiv = document.createElement('div');
                                messageDiv.classList.add('message');
                                messageDiv.classList.add(m.is_admin ? 'received' : 'sent');
                                messageDiv.innerHTML = `${m.message}`;
                                box.appendChild(messageDiv);
                            });
                        }
                        box.scrollTop = box.scrollHeight;
                    });
            }

            loadMessages();
            setInterval(loadMessages, 2000);
        }
        
    </script>

</html>