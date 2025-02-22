<?php
$page = "AI";
define('allowed', true);
include 'header.php';
?>
    <main>
        <div class="ai-container">
            <div class="ai-chat">
                <div class="chat-header">
                    <div class="chat-header-left">
                        <h2 class="chat-header-title">AI Chat</h2>
                    </div>
                    <div class="chat-header-right">
                        <button id="customizeAI" class="customize-button">Customize AI</button>
                    </div>
                </div>
                <div class="chat-messages" id="aiMessages">
                    <!-- Messages will appear here -->
                    <div id="exampleQuestions" class="example-questions" style="display: none;">
                        <!-- Example questions will be dynamically added here -->
                    </div>
                </div>
                <div class="chat-input">
                    <div class="input-wrapper">
                        <input type="text" id="userInput" placeholder="Ask me anything..." maxlength="500">
                        <div class="char-counter">0/500</div>
                    </div>
                    <button id="sendButton">Send</button>
                </div>
            </div>
        </div>

        <!-- Add this modal -->
        <div id="customizeModal" class="customize-modal">
            <div class="customize-content">
                <h3>Customize AI Behavior</h3>
                
                <div class="model-selection">
                    <label for="modelSelect">AI Model:</label>
                    <select id="modelSelect">
                        <option value="mistralai/Mixtral-8x7B-Instruct-v0.1">Mixtral-8x7B (Recommended)</option>
                        <option value="deepseek-ai/DeepSeek-V3">DeepSeek V3</option>
                        <option value="deepseek-ai/DeepSeek-R1">DeepSeek R1 (Shows Thinking Process)</option>
                        <option value="meta-llama/Llama-3.3-70B-Instruct-Turbo">Llama 3 70B</option>
                    </select>
                </div>

                <textarea id="systemPrompt" placeholder="Describe how you want the AI to behave..." maxlength="1000"></textarea>
                
                <div class="temperature-control">
                    <label for="tempSlider">Response Creativity: <span id="tempValue">0.7</span></label>
                    <input type="range" id="tempSlider" min="0.1" max="1.0" step="0.1" value="0.7">
                    <div class="temp-labels">
                        <span>Focused</span>
                        <span>Creative</span>
                    </div>
                </div>

                <div class="customize-buttons">
                    <button id="resetPrompt">Reset to Default</button>
                    <button id="savePrompt">Save</button>
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <script src="js/particles-config.js?v=<?php echo time(); ?>"></script>
    <script src="js/ai-chat.js?v=<?php echo time(); ?>"></script>
</body>
</html> 
