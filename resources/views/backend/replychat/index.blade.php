<link rel="stylesheet" href="{{ asset('public/backend/assets/css/chatbox.css') }}?v={{ time() }}">

<body class="bg-gray-100">
    <div class="flex h-[80vh] overflow-hidden rounded-xl shadow-lg">
        {{-- Sidebar danh sách người dùng --}}
        <div class="w-80 bg-white border-r border-gray-200 p-4 overflow-y-auto">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Trang chủ /</span> Chat với khách hàng</h4>
        <div class="space-y-3">
            @foreach ($conversations as $conversation)
                <div class="user-item" data-token="{{ $conversation->token }}" data-name="{{ $conversation->name }}">
                    <div class="flex items-center gap-3">
                        <div class="user-avatar">
                            {{ strtoupper(substr($conversation->name, 0, 1)) }}
                        </div>
                        <div class="user-info">
                            <div class="user-name">{{ $conversation->name ?? 'Người dùng' }}</div>
                            <div class="unread-count">{{ $conversation->unread_count }} tin nhắn mới</div>
                        </div>
                        
                    </div>
                </div>
            @endforeach

            </div>
        </div>

        {{-- Khung chat --}}
        <div id="chatbox" class="chatbox">
            <div class="chatbox__header">
                <span id="chat-username">💬 Chat với Người dùng</span>
                <button id="chatbox-close-btn">✖</button>
            </div>
            <div id="message-list" class="chatbox__messages"></div>
            <div class="chatbox__input">
                <input type="text" id="message-input" class="chatbox__input-field" placeholder="Nhập tin nhắn...">
                <button id="send-button" class="chatbox__send-btn">Gửi</button>
            </div>
        </div>

    </div>

    <script>
    let currentToken = '';

    document.getElementById('chatbox-close-btn').addEventListener('click', closeChatWindow);
    document.getElementById('send-button').addEventListener('click', sendMessage);
    document.querySelector('.space-y-3').addEventListener('click', function (e) {
        const item = e.target.closest('.user-item');
        if (!item) return;

        const token = item.dataset.token;
        const name = item.dataset.name || 'Người dùng';

        if (currentToken === token) return;
        openChatWindow(token, name);
    });

    function openChatWindow(token, username) {
        stopPolling();

        const chatbox = document.getElementById('chatbox');
        chatbox.classList.add('chatbox-open');
        document.getElementById('chat-username').textContent = `💬 Chat với ${username}`;
        currentToken = token;

        const messageList = document.getElementById('message-list');
        messageList.dataset.seenCalled = ''; // Reset khi mở mới

        loadMessages(token);
        startPolling(token);
    }

    function closeChatWindow() {
        const chatbox = document.getElementById('chatbox');
        chatbox.classList.remove('chatbox-open');
        stopPolling();

        if (currentToken) {
            markMessagesAsSeen(currentToken);
        }

        const messageList = document.getElementById('message-list');
        messageList.dataset.seenCalled = '';

        currentToken = '';
    }

    function markMessagesAsSeen(token) {
        fetch(`{{ route('admin.chat.seen') }}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ token })
        }).then(res => res.json())
        .then(data => {
            if (!data.success) {
                console.error('Không thể đánh dấu đã xem:', data.error);
            } else {
                const userItem = document.querySelector(`.user-item[data-token="${token}"]`);
                if (userItem) {
                    const countEl = userItem.querySelector('.unread-count');
                    if (countEl) {
                        countEl.textContent = '0 tin nhắn mới';
                    }
                }
            }
        });
    }

    async function sendMessage() {
        const input = document.getElementById('message-input');
        const message = input.value.trim();
        if (!message || !currentToken) return;

        try {
            const res = await fetch('/admin/chat/reply', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ token: currentToken, message })
            });

            const data = await res.json();
            if (!data.success) throw new Error(data.error);

            input.value = '';
            loadMessages(currentToken);
        } catch (error) {
            console.error('Gửi tin nhắn lỗi:', error);
            alert('Không thể gửi tin nhắn. Vui lòng thử lại sau.');
        }
    }

    const adminName = "{{ auth()->user()->name }}";
    let isLoading = false;

    async function loadMessages(token) {
        if (isLoading) return;
        isLoading = true;

        try {
            const res = await fetch(`/admin/chat/load?token=${token}`);
            const data = await res.json();
            if (!data.success) throw new Error(data.error);

            const messages = data.messages;
            const messageList = document.getElementById('message-list');
            messageList.innerHTML = '';

            messages.forEach(msg => {
                const messageEl = document.createElement('div');
                messageEl.className = `chatbox__message message ${msg.is_admin ? 'admin' : 'user'}`;
                messageEl.innerHTML = `
                    <div class="sender-name">${msg.is_admin ? adminName : (msg.name ?? 'Khách')}</div>
                    <div class="message-text">${msg.message}</div>
                `;
                messageList.appendChild(messageEl);
            });

            messageList.scrollTop = messageList.scrollHeight;

            // Chỉ gọi 1 lần mark seen
            if (!messageList.dataset.seenCalled) {
                markMessagesAsSeen(token);
                messageList.dataset.seenCalled = "1";
            }
        } catch (error) {
            console.error('Tải tin nhắn lỗi:', error);
            alert('Không thể tải tin nhắn. Vui lòng thử lại sau.');
        } finally {
            isLoading = false;
        }
    }

    let pollingInterval;
    function startPolling(token) {
        if (pollingInterval) return;
        pollingInterval = setInterval(() => {
            loadMessages(token);
        }, 3000);
    }

    function stopPolling() {
        if (pollingInterval) {
            clearInterval(pollingInterval);
            pollingInterval = null;
        }
    }
</script>

</body>
</html>
