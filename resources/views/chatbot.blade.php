<!DOCTYPE html>
<html>

<head>
    <title>Chat Bot</title>
    <link rel="stylesheet" type="text/css" href="/css/style.css">
</head>

<body>
    <div class="chat-box">
        <div class="chat-history" id="chat-history">
            <!-- Chat history will be displayed here -->
            @foreach(session('chatHistory', []) as $chat)
            @if ($chat['role'] === 'user')
            <div class="user-message">{{ $chat['message'] }}</div>
            @elseif ($chat['role'] === 'bot')
            <div class="bot-message">{{ $chat['message'] }}</div>
            @endif
            @endforeach
        </div>
        <!-- form to submit users' messages -->
        <div class="chat-input">
            <form id="chat-form" action="/chat" method="post">
                @csrf
                <input type="text" name="message" id="user-message" placeholder="Type a message..." autocomplete="off" required>
                <button type="submit">Send</button>
            </form>
        </div>
    </div>
</body>

</html>