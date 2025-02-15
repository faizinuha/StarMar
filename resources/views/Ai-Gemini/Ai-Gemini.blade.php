@extends('Ai-Gemini.Ai-Layout')

@section('content')
    <div class="bg-gray-100 flex items-center justify-center h-screen">
        <div class="chat-container bg-white p-8 rounded-lg shadow-lg w-full max-w-2xl">
            <h2 class="text-3xl font-bold mb-6 text-center text-gray-800">Chat dengan Gemini</h2>
            <hr>
            <div id="chatbox" class="chatbox border p-4 mb-6 overflow-y-auto bg-gray-50 rounded-lg text-sm flex flex-col space-y-2 h-96">
            </div>
            <div class="flex items-center space-x-2 w-full">
                <textarea type="text" id="userInput" class="flex-1 p-3 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Tanyakan sesuatu pada Mahiro..." onkeypress="handleKeyPress(event)"></textarea>
                <button id="sendMessage" class="bg-blue-500 text-white px-6 py-3 rounded-full hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">➤</button>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('sendMessage').addEventListener('click', sendMessage);

        function handleKeyPress(event) {
            if (event.key === 'Enter') {
                sendMessage();
            }
        }

        function sendMessage() {
            let userInput = document.getElementById('userInput').value.trim();
            let chatbox = document.getElementById('chatbox');

            if (userInput === '') return;

            chatbox.innerHTML += `<div class="user-message"><b>You:</b> ${userInput}</div>`;
            document.getElementById('userInput').value = '';
            chatbox.scrollTop = chatbox.scrollHeight;

            let loadingMessage = document.createElement('div');
            loadingMessage.className = 'loading-message';
            loadingMessage.innerHTML = `<b>Mahiro:</b> <span class="loading-dots">...</span>`;
            chatbox.appendChild(loadingMessage);
            chatbox.scrollTop = chatbox.scrollHeight;

            fetch("{{ route('ai-gemini.chat') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ message: userInput })
            })
            .then(response => response.json())
            .then(data => {
                chatbox.removeChild(loadingMessage);
                if (data.success) {
                    chatbox.innerHTML += `<div class="ai-message"><b>Mahiro:</b> ${data.reply}</div>`;
                } else {
                    chatbox.innerHTML += `<div class="ai-message text-red-500"><b>Error:</b> ${data.error}</div>`;
                }
                chatbox.scrollTop = chatbox.scrollHeight;
            })
            .catch(error => {
                chatbox.removeChild(loadingMessage);
                chatbox.innerHTML += `<div class="ai-message text-red-500"><b>Error:</b> Terjadi kesalahan saat mengirim pesan.</div>`;
            });
        }
    </script>

    <style>

    body {
        font-family: 'Inter', sans-serif;
        background-color: #000;
        color: #fff; /* Biar teksnya putih dan gampang dibaca */
    }       
     .user-message {
            background-color: #3b82f6;
            color: white;
            border-radius: 1rem 1rem 0 1rem;
            margin-left: auto;
            max-width: 70%;
            padding: 0.5rem 1rem;
        }

        .ai-message {
            background-color: #f3f4f6;
            color: black;
            border-radius: 1rem 1rem 1rem 0;
            margin-right: auto;
            max-width: 70%;
            padding: 0.5rem 1rem;
        }

        .loading-dots::after {
            content: " ";
            display: inline-block;
            animation: dots 1.5s steps(3, end) infinite;
        }

        @keyframes dots {
            0% { content: ""; }
            33% { content: "."; }
            66% { content: ".."; }
            100% { content: "..."; }
        }

        .chat-container {
            width: 90%;
            max-width: 1100px;
        }


            .chatbox {
                height: 400px;
                word-wrap: break-word; /* Menambahkan properti ini */
            }
        
            .user-message, .ai-message {
                word-wrap: /* Menambahkan properti ini */
            }

    </style>
@endsection
