document.addEventListener('DOMContentLoaded', () => {
    const messagesDiv = document.getElementById('aiMessages');
    const userInput = document.getElementById('userInput');
    const sendButton = document.getElementById('sendButton');
    let isProcessing = false;
    const marked = window.marked;

    // Add clear button to chat input
    const chatInput = document.querySelector('.chat-input');
    const clearButton = document.createElement('button');
    clearButton.id = 'clearButton';
    clearButton.textContent = 'Clear History';
    chatInput.insertBefore(clearButton, sendButton);

    // Load chat history on startup and show customize modal
    loadChatHistory();
    setTimeout(() => {
        customizeModal.style.display = 'flex';
        systemPrompt.value = currentSystemPrompt || '';
    }, 500);

    clearButton.addEventListener('click', () => {
        if (confirm('Are you sure you want to clear your chat history?')) {
            localStorage.removeItem('chatHistory');
            // Reset character counter
            const counter = document.querySelector('.char-counter');
            counter.textContent = '0/500';
            // Update messages to show empty state
            updateChatMessages([]);
        }
    });

    function loadChatHistory() {
        const history = localStorage.getItem('chatHistory');
        console.log('Loading chat history:', history);
        
        const messages = history ? JSON.parse(history) : [];
        
        // Clear existing messages
        messagesDiv.innerHTML = '';
        
        if (!messages || messages.length === 0) {
            // Show empty chat message
            const emptyMessage = document.createElement('div');
            emptyMessage.className = 'empty-chat-message';
            emptyMessage.innerHTML = `
                <div class="empty-chat-icon">🤖</div>
                <div class="empty-chat-text">No messages yet</div>
                <div class="empty-chat-subtext">Start a conversation with AI!</div>
            `;
            messagesDiv.appendChild(emptyMessage);
            return;
        }

        // Render messages
        messages.forEach(msg => {
            if (!msg || !msg.content) return;
            
            const messageDiv = document.createElement('div');
            messageDiv.className = `message ${msg.type}-message`;
            
            if (msg.type === 'ai') {
                const avatar = document.createElement('img');
                avatar.className = 'message-avatar';
                avatar.src = 'images/aipfp.png';
                messageDiv.appendChild(avatar);
            }
            
            const messageContent = document.createElement('div');
            messageContent.className = 'message-content';
            
            const header = document.createElement('div');
            header.className = 'message-header';
            
            // Always show "AI" for AI messages
            const username = msg.type === 'user' ? 'You' : 'AI';
            header.innerHTML = `<span>${username}</span>`;
            
            const textContent = document.createElement('div');
            if (msg.type === 'ai') {
                // Handle think tags for DeepSeek R1 messages in history
                let processedContent = msg.content;
                if (msg.userData?.model === 'deepseek-ai/DeepSeek-R1') {
                    processedContent = processedContent.replace(/<\/?think>/g, '`<think>`');
                } else {
                    processedContent = processedContent.replace(/<think>[\s\S]*?<\/think>\n*/g, '');
                }
                textContent.innerHTML = processedContent;
            } else {
                textContent.textContent = msg.content;
            }
            
            messageContent.appendChild(header);
            messageContent.appendChild(textContent);
            messageDiv.appendChild(messageContent);
            messagesDiv.appendChild(messageDiv);
        });
        
        messagesDiv.scrollTop = messagesDiv.scrollHeight;
    }

    function saveChatHistory() {
        const messages = Array.from(messagesDiv.children)
            .filter(msg => !msg.classList.contains('system-message') && 
                          !msg.classList.contains('thinking') &&
                          !msg.classList.contains('empty-chat-message'))
            .map(msg => {
                const isUser = msg.classList.contains('user-message');
                const userData = isUser ? getUserData() : null;
                const contentElement = msg.querySelector('.message-content div:last-child');
                
                if (!contentElement) return null;
                
                return {
                    type: isUser ? 'user' : 'ai',
                    content: isUser ? 
                        contentElement.textContent : 
                        contentElement.innerHTML, // Store the HTML to preserve formatting
                    userData: isUser ? {
                        username: userData.username,
                        profileImage: userData.profileImage
                    } : {
                        username: 'AI',
                        model: currentModel
                    }
                };
            })
            .filter(msg => msg !== null);

        console.log('Saving chat history:', messages);
        localStorage.setItem('chatHistory', JSON.stringify(messages));
    }

    function addThinkingMessage() {
        const messageDiv = document.createElement('div');
        messageDiv.className = 'system-message thinking';
        messageDiv.innerHTML = `
            Thinking
            <div class="thinking-dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        `;
        messagesDiv.appendChild(messageDiv);
        messagesDiv.scrollTop = messagesDiv.scrollHeight;
        return messageDiv;
    }

    // Add these new variables
    const customizeBtn = document.getElementById('customizeAI');
    const customizeModal = document.getElementById('customizeModal');
    const systemPrompt = document.getElementById('systemPrompt');
    const savePromptBtn = document.getElementById('savePrompt');
    const resetPromptBtn = document.getElementById('resetPrompt');
    let currentSystemPrompt = localStorage.getItem('aiSystemPrompt') || null;
    const tempSlider = document.getElementById('tempSlider');
    const tempValue = document.getElementById('tempValue');
    let currentTemperature = localStorage.getItem('aiTemperature') || 0.4;
    let currentModel = localStorage.getItem('aiModel') || 'mistralai/Mixtral-8x7B-Instruct-v0.1';
    const modelSelect = document.getElementById('modelSelect');

    // Initialize temperature
    tempSlider.value = currentTemperature;
    tempValue.textContent = currentTemperature;

    // Initialize model selection
    modelSelect.value = currentModel;

    // Add modal handlers
    customizeBtn.addEventListener('click', () => {
        customizeModal.style.display = 'flex';
        systemPrompt.value = currentSystemPrompt || '';
    });

    customizeModal.addEventListener('click', (e) => {
        // Remove this handler since we don't want to close on outside click anymore
        // if (e.target === customizeModal) {
        //     customizeModal.style.display = 'none';
        // }
    });

    // Add temperature slider handler
    tempSlider.addEventListener('input', function() {
        tempValue.textContent = this.value;
    });

    // Add model selection handler
    modelSelect.addEventListener('change', function() {
        currentModel = this.value;
        localStorage.setItem('aiModel', currentModel);
    });

    // Update save handler
    savePromptBtn.addEventListener('click', () => {
        currentSystemPrompt = systemPrompt.value.trim();
        currentTemperature = tempSlider.value;
        currentModel = modelSelect.value;
        
        if (currentSystemPrompt) {
            localStorage.setItem('aiSystemPrompt', currentSystemPrompt);
        } else {
            localStorage.removeItem('aiSystemPrompt');
        }
        
        localStorage.setItem('aiTemperature', currentTemperature);
        localStorage.setItem('aiModel', currentModel);
        customizeModal.style.display = 'none';
    });

    // Update reset handler
    resetPromptBtn.addEventListener('click', () => {
        currentSystemPrompt = "You are a helpful AI assistant.";
        systemPrompt.value = currentSystemPrompt;
        currentTemperature = 0.4;
        tempSlider.value = 0.4;
        tempValue.textContent = '0.4';
        currentModel = 'mistralai/Mixtral-8x7B-Instruct-v0.1';
        modelSelect.value = currentModel;
        
        // Clear stored values
        localStorage.removeItem('aiSystemPrompt');
        localStorage.setItem('aiTemperature', '0.4');
        localStorage.setItem('aiModel', 'mistralai/Mixtral-8x7B-Instruct-v0.1');
    });

    async function sendMessage() {
        if (isProcessing) return;
        
        const message = userInput.value.trim();
        if (!message) return;

        isProcessing = true;
        userInput.disabled = true;
        sendButton.disabled = true;

        const emptyState = messagesDiv.querySelector('.empty-chat-message');
        if (emptyState) {
            emptyState.remove();
        }

        addMessage('user', message);
        userInput.value = '';
        document.querySelector('.char-counter').textContent = '0/500';

        const loadingMessage = addThinkingMessage();
        
        try {
            const response = await fetch('api/AI/ai_endpoint.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    message: message,
                    systemPrompt: currentSystemPrompt,
                    temperature: parseFloat(currentTemperature),
                    model: currentModel
                })
            });

            const data = await response.json();
            console.log('AI Response data:', data);

            loadingMessage.remove();

            if (data.error) {
                addMessage('system', `Error: ${data.error}`);
                return;
            }

            if (data.response && data.response.trim()) {
                addMessage('ai', data.response.trim());
                saveChatHistory();
            } else {
                addMessage('system', 'Sorry, I could not generate a response.');
            }

        } catch (error) {
            console.error('Error:', error);
            loadingMessage.remove();
            addMessage('system', 'An error occurred while processing your request. Please try again.');
        } finally {
            isProcessing = false;
            userInput.disabled = false;
            sendButton.disabled = false;
            userInput.focus();
        }
    }

    function getUserData() {
        const stats = JSON.parse(localStorage.getItem('siteStats')) || {
            profilePicture: 'images/favicon.png'
        };

        return {
            username: 'You',
            profileImage: stats.profilePicture || 'images/favicon.png'
        };
    }

    function addMessage(type, content) {
        console.log('Adding message:', { type, content });
        
        const messageDiv = document.createElement('div');
        messageDiv.className = `message ${type}-message`;
        
        if (type === 'ai') {
            const avatar = document.createElement('img');
            avatar.className = 'message-avatar';
            avatar.src = 'images/aipfp.png';
            messageDiv.appendChild(avatar);
        }
        
        const messageContent = document.createElement('div');
        messageContent.className = 'message-content';
        
        const header = document.createElement('div');
        header.className = 'message-header';
        
        const userData = type === 'user' ? { username: 'You' } : { username: 'AI' };
        header.innerHTML = `<span>${userData.username}</span>`;
        
        const textContent = document.createElement('div');
        
        if (type === 'ai') {
            console.log('Processing AI response:', content);
            
            // Special handling for DeepSeek R1 thinking process
            if (currentModel === 'deepseek-ai/DeepSeek-R1') {
                // Only show thinking process if there's content between think tags
                let processedContent = content.replace(
                    /<think>([\s\S]*?)<\/think>/g,
                    (match, thinkContent) => {
                        thinkContent = thinkContent.trim();
                        if (thinkContent) {
                            return `<div class="thinking-process"><strong>Thinking Process:</strong><pre>${thinkContent}</pre></div>`;
                        }
                        return ''; // Remove empty think tags
                    }
                );
                textContent.innerHTML = marked.parse(processedContent);
            } else {
                // Remove think tags for other models
                let processedContent = content.replace(/<think>[\s\S]*?<\/think>\n*/g, '');
                textContent.innerHTML = marked.parse(processedContent);
            }
        } else {
            textContent.textContent = content;
        }
        
        messageContent.appendChild(header);
        messageContent.appendChild(textContent);
        messageDiv.appendChild(messageContent);
        messagesDiv.appendChild(messageDiv);
        
        setTimeout(() => {
            messagesDiv.scrollTop = messagesDiv.scrollHeight;
        }, 100);
        
        return messageDiv;
    }

    sendButton.addEventListener('click', sendMessage);

    userInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter' && !e.shiftKey && !isProcessing) {
            e.preventDefault();
            sendMessage();
        }
    });

    const charCounter = document.querySelector('.char-counter');

    userInput.addEventListener('input', function() {
        const length = this.value.length;
        charCounter.textContent = `${length}/500`;
    });

    function initializeProfileSync() {
        // Empty function - we don't need profile syncing anymore
    }

    initializeProfileSync();

    function updateChatMessages(messages) {
        const aiMessages = document.getElementById('aiMessages');
        aiMessages.innerHTML = '';

        if (!messages || messages.length === 0) {
            // Show empty chat message
            const emptyMessage = document.createElement('div');
            emptyMessage.className = 'empty-chat-message';
            emptyMessage.innerHTML = `
                <div class="empty-chat-icon">🤖</div>
                <div class="empty-chat-text">No messages yet</div>
                <div class="empty-chat-subtext">Start a conversation with AI!</div>
            `;
            aiMessages.appendChild(emptyMessage);
            return;
        }

        // Render messages if they exist
        messages.forEach(msg => {
            if (!msg || !msg.content) return;
            addMessage(msg.type, msg.content);
        });
        
        // Scroll to bottom after rendering messages
        aiMessages.scrollTop = aiMessages.scrollHeight;
    }

    // Add a function to get the display name for the model
    function getModelDisplayName(modelId) {
        const modelNames = {
            'mistralai/Mixtral-8x7B-Instruct-v0.1': 'Mixtral-8x7B',
            'deepseek-ai/DeepSeek-V3': 'DeepSeek V3',
            'deepseek-ai/DeepSeek-R1': 'DeepSeek R1',
            'meta-llama/Llama-3.3-70B-Instruct-Turbo': 'Llama 3 70B'
        };
        return modelNames[modelId] || 'AI Assistant';
    }

    // Update the ESC key handler if you have one
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && customizeModal.style.display === 'flex') {
            e.preventDefault(); // Prevent the default ESC behavior
        }
    });
}); 