<!-- AI Assistant Floating Widget -->
<div id="aiAssistantWidget" class="fixed bottom-6 right-6 z-50">
    <!-- Chat Button -->
    <button id="aiAssistantBtn" onclick="toggleAiChat()" class="w-14 h-14 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-full flex items-center justify-center text-white shadow-xl hover:shadow-2xl hover:scale-105 transition-all duration-300 relative group">
        <i class="fas fa-robot text-2xl group-hover:animate-bounce"></i>
        <!-- Ping dot for notification -->
        <span class="absolute top-0 right-0 flex items-center justify-center w-4 h-4 text-xs bg-red-500 text-white rounded-full border-2 border-white"></span>
    </button>
    
    <!-- Chat Window (Hidden by default) -->
    <div id="aiChatWindow" class="hidden absolute bottom-16 right-0 w-80 sm:w-96 bg-white rounded-2xl shadow-2xl border border-gray-100 flex flex-col overflow-hidden transition-all duration-300" style="height: 500px; transform-origin: bottom right;">
        
        <!-- Header -->
        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-4 py-3 flex justify-between items-center text-white rounded-t-2xl">
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                    <i class="fas fa-robot"></i>
                </div>
                <div>
                    <h3 class="font-bold text-sm leading-tight">SIEM AI Assistant</h3>
                    <p class="text-xs text-blue-100">Selalu Aktif (Terkoneksi)</p>
                </div>
            </div>
            <button onclick="toggleAiChat()" class="text-white hover:text-gray-200 transition-colors">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <!-- Chat Area -->
        <div id="aiChatBox" class="flex-1 p-4 overflow-y-auto bg-gray-50 space-y-4 text-sm">
            <!-- Initial Greeting -->
            <div class="flex">
                <div class="flex-shrink-0 mr-3 mt-1">
                    <div class="w-8 h-8 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center border border-blue-200">
                        <i class="fas fa-robot text-xs"></i>
                    </div>
                </div>
                <div class="bg-white p-3 rounded-2xl rounded-tl-none shadow-sm border border-gray-100 max-w-[85%] text-gray-700">
                    Halo! Saya adalah AI Assistant SIEM Anda. Saya dapat:
                    <ul class="list-disc pl-4 mt-2 mb-1 space-y-1 text-xs">
                        <li>Membantu analisis ancaman</li>
                        <li>Memberikan solusi mitigasi *Alerts*</li>
                        <li>Membuat panduan *todo-list* Pentest</li>
                        <li>Menganalisa log web monitoring</li>
                    </ul>
                    Ada yang bisa saya bantu hari ini?
                </div>
            </div>
        </div>
        
        <!-- Input Area -->
        <div class="p-3 bg-white border-t border-gray-100">
            <!-- Quick Prompts / Chips -->
            <div class="flex gap-2 overflow-x-auto pb-2 mb-2 scrollbar-hide text-xs whitespace-nowrap px-1">
                <button onclick="fillAiPrompt('Buatkan panduan Pentest ke Web Server')" class="bg-blue-50 hover:bg-blue-100 text-blue-600 border border-blue-200 px-3 py-1.5 rounded-full transition-colors flex-shrink-0">
                    Panduan Pentest
                </button>
                <button onclick="fillAiPrompt('Solusi untuk Alert: Multiple Login Failures')" class="bg-amber-50 hover:bg-amber-100 text-amber-600 border border-amber-200 px-3 py-1.5 rounded-full transition-colors flex-shrink-0">
                    Solusi Alert Login
                </button>
                <button onclick="fillAiPrompt('Bantu amankan Sertifikat Elektronik')" class="bg-green-50 hover:bg-green-100 text-green-600 border border-green-200 px-3 py-1.5 rounded-full transition-colors flex-shrink-0">
                    Kriptografi TTE
                </button>
            </div>
            
            <form id="aiChatForm" class="flex items-end space-x-2" onsubmit="handleAiChat(event)">
                <div class="flex-1 bg-gray-100 rounded-xl px-3 py-2 flex items-center border border-transparent focus-within:border-blue-400 focus-within:bg-white transition-all">
                    <textarea id="aiMessageInput" rows="1" class="w-full bg-transparent outline-none text-sm resize-none" placeholder="Tanyakan seputar keamanan..." style="max-height: 100px;"></textarea>
                </div>
                <button type="submit" id="aiSendBtn" class="bg-blue-600 hover:bg-blue-700 text-white w-10 h-10 rounded-xl flex items-center justify-center transition-colors shadow-md flex-shrink-0">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </form>
        </div>
    </div>
</div>

<style>
/* Hide scrollbar for chips */
.scrollbar-hide::-webkit-scrollbar {
    display: none;
}
.scrollbar-hide {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
</style>

<script>
// Prevent multiple listeners
if (typeof aiChatInitialized === 'undefined') {
    window.aiChatInitialized = true;

    // Auto resize textarea
    const textarea = document.getElementById('aiMessageInput');
    textarea.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = (this.scrollHeight < 100 ? this.scrollHeight : 100) + 'px';
    });

    // Enter to submit
    textarea.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            document.getElementById('aiChatForm').dispatchEvent(new Event('submit'));
        }
    });

    function toggleAiChat() {
        const chatWindow = document.getElementById('aiChatWindow');
        const isHidden = chatWindow.classList.contains('hidden');
        if (isHidden) {
            chatWindow.classList.remove('hidden');
            chatWindow.classList.add('flex');
            // Remove ping dot if clicked
            const ping = document.querySelector('#aiAssistantBtn span.absolute');
            if (ping) ping.style.display = 'none';
        } else {
            chatWindow.classList.add('hidden');
            chatWindow.classList.remove('flex');
        }
    }

    function fillAiPrompt(text) {
        const input = document.getElementById('aiMessageInput');
        input.value = text;
        input.style.height = 'auto'; // Reset size
        document.getElementById('aiChatForm').dispatchEvent(new Event('submit'));
    }

    async function handleAiChat(e) {
        e.preventDefault();
        const input = document.getElementById('aiMessageInput');
        const message = input.value.trim();
        const chatBox = document.getElementById('aiChatBox');
        const sendBtn = document.getElementById('aiSendBtn');

        if (!message) return;

        // Reset input immediately
        input.value = '';
        input.style.height = 'auto';

        // 1. Add User Message to Chat
        appendUserMessage(message, chatBox);

        // Scroll to bottom
        chatBox.scrollTop = chatBox.scrollHeight;

        // Show typing indicator
        const typingId = 'typing-' + Date.now();
        appendTypingIndicator(typingId, chatBox);
        chatBox.scrollTop = chatBox.scrollHeight;

        // Disable input while generating
        input.disabled = true;
        sendBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';

        try {
            // CSRF Token workaround for CI4 if needed (usually handled via meta headers or direct endpoints)
            const response = await fetch('/ai-assistant/chat', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({ message: message })
            });

            const data = await response.json();
            
            // Remove typing indicator
            const typingEl = document.getElementById(typingId);
            if (typingEl) typingEl.remove();

            if (data.status === 'success') {
                appendBotMessage(data.response, chatBox);
            } else {
                appendBotMessage('Maaf, saya tidak dapat memproses permintaan Anda saat ini.', chatBox, true);
            }

        } catch (error) {
            const typingEl = document.getElementById(typingId);
            if (typingEl) typingEl.remove();
            appendBotMessage('Terjadi kesalahan koneksi saat menghubungi AI Server.', chatBox, true);
        } finally {
            input.disabled = false;
            sendBtn.innerHTML = '<i class="fas fa-paper-plane"></i>';
            input.focus();
            chatBox.scrollTop = chatBox.scrollHeight;
        }
    }

    function appendUserMessage(msg, container) {
        const div = document.createElement('div');
        div.className = 'flex justify-end';
        div.innerHTML = `
            <div class="bg-blue-600 text-white p-3 rounded-2xl rounded-tr-none shadow-sm max-w-[85%] text-sm break-words whitespace-pre-wrap">
                ${escapeHTML(msg)}
            </div>
            <div class="flex-shrink-0 ml-3 mt-1">
                <div class="w-8 h-8 bg-gray-200 text-gray-600 rounded-full flex items-center justify-center">
                    <i class="fas fa-user text-xs"></i>
                </div>
            </div>
        `;
        container.appendChild(div);
    }

    function appendBotMessage(msg, container, isError = false) {
        const div = document.createElement('div');
        div.className = 'flex';
        
        // Parse basic markdown to HTML for better display
        const htmlMsg = parseMarkdown(msg);
        
        div.innerHTML = `
            <div class="flex-shrink-0 mr-3 mt-1">
                <div class="w-8 h-8 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center border border-blue-200">
                    <i class="fas fa-robot text-xs"></i>
                </div>
            </div>
            <div class="bg-white p-3 rounded-2xl rounded-tl-none shadow-sm border ${isError ? 'border-red-200 text-red-600' : 'border-gray-100 text-gray-700'} max-w-[85%] text-sm prose prose-sm prose-blue">
                ${htmlMsg}
            </div>
        `;
        container.appendChild(div);
    }

    function appendTypingIndicator(id, container) {
        const div = document.createElement('div');
        div.id = id;
        div.className = 'flex';
        div.innerHTML = `
            <div class="flex-shrink-0 mr-3 mt-1">
                <div class="w-8 h-8 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center border border-blue-200">
                    <i class="fas fa-robot text-xs"></i>
                </div>
            </div>
            <div class="bg-white px-4 py-3 rounded-2xl rounded-tl-none shadow-sm border border-gray-100 flex items-center space-x-1">
                <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0s;"></div>
                <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.2s;"></div>
                <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.4s;"></div>
            </div>
        `;
        container.appendChild(div);
    }

    function escapeHTML(str) {
        return str.replace(/[&<>'"]/g, 
            tag => ({
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                "'": '&#39;',
                '"': '&quot;'
            }[tag])
        );
    }

    // A very basic markdown parser for the AI response
    function parseMarkdown(md) {
        // Convert bold
        md = md.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');
        // Convert headers
        md = md.replace(/^### (.*$)/gim, '<h3 class="font-bold text-gray-900 mt-2 mb-1">$1</h3>');
        md = md.replace(/^## (.*$)/gim, '<h2 class="font-bold text-gray-900 mt-2 mb-1 text-base">$1</h2>');
        // Convert code blocks
        md = md.replace(/```([\s\S]*?)```/g, '<pre class="bg-gray-800 text-gray-100 rounded-lg p-2 text-xs overflow-x-auto my-2"><code>$1</code></pre>');
        // Convert inline code
        md = md.replace(/`(.*?)`/g, '<code class="bg-gray-100 text-pink-600 px-1 py-0.5 rounded text-xs">$1</code>');
        // Convert lists (simple)
        md = md.replace(/^\- (.*$)/gim, '<li class="ml-4 list-disc">$1</li>');
        // Fix line breaks
        md = md.replace(/\n\n/g, '<br><br>');
        md = md.replace(/\n(?!(<li|<br|<pre|<h))/g, '<br>'); // only break if not immediately before these tags
        
        return md;
    }
}
</script>
