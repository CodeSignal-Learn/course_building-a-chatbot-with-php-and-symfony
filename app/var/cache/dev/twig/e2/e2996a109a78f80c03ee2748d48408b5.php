<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* chat.html.twig */
class __TwigTemplate_47fbf9e701832282f206ee1857514690 extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "chat.html.twig"));

        // line 1
        yield "<!DOCTYPE html>
<html>
<head>
    <title>Customer Service Chat</title>
    <link rel=\"stylesheet\" href=\"/css/style.css\">
</head>
<body>
    <div class=\"header\">
        <h1>Welcome to Our Customer Service</h1>
        <p>How can we help you today?</p>
    </div>
    <div class=\"suggestions\">
        <button class=\"suggestion-btn\" onclick=\"usePrompt('What services do you offer?')\">Our Services</button>
        <button class=\"suggestion-btn\" onclick=\"usePrompt('What are your business hours?')\">Business Hours</button>
        <button class=\"suggestion-btn\" onclick=\"usePrompt('What is your contact email?')\">Contact Email</button>
    </div>
    <div id=\"chat-container\">
        <div id=\"messages\"></div>
        <div class=\"input-container\">
            <div class=\"input-wrapper\">
                <input type=\"text\" id=\"message-input\" placeholder=\"Type your message...\">
            </div>
            <button onclick=\"sendMessage()\">Send</button>
            <button id=\"new-chat-btn\" onclick=\"startNewChat()\">New Chat</button>
        </div>
    </div>

    <script>
        const messagesContainer = document.getElementById('messages');
        const messageInput = document.getElementById('message-input');
        let currentChatId = null;
        let currentUserId = null;

        // Start a chat automatically when the page loads
        document.addEventListener('DOMContentLoaded', startNewChat);

        function startNewChat() {
            fetch('/api/create_chat', {
                method: 'POST',
                credentials: 'same-origin'
            })
            .then(response => response.json())
            .then(data => {
                currentChatId = data.chat_id;
                currentUserId = data.user_id;
                messagesContainer.innerHTML = '';
            })
            .catch(() => {
                alert('Error creating chat');
            });
        }

        function sendMessage() {
            const message = messageInput.value.trim();
            if (!message) return;

            // Add user message
            appendMessage('user', message);
            messageInput.value = '';

            // Send to server
            fetch('/api/send_message', {
                method: 'POST',
                credentials: 'same-origin',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    chat_id: currentChatId,
                    message: message
                })
            })
            .then(response => response.json())
            .then(data => {
                appendMessage('assistant', data.message);
            })
            .catch(() => {
                alert('Error sending message');
            });
        }

        function usePrompt(prompt) {
            messageInput.value = prompt;
            sendMessage();
        }

        function appendMessage(role, content) {
            const messageDiv = document.createElement('div');
            messageDiv.className = `message \${role}`;
            messageDiv.textContent = content;
            messagesContainer.appendChild(messageDiv);
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }

        // Handle Enter key
        messageInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                sendMessage();
            }
        });
    </script>
</body>
</html>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "chat.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  45 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!DOCTYPE html>
<html>
<head>
    <title>Customer Service Chat</title>
    <link rel=\"stylesheet\" href=\"/css/style.css\">
</head>
<body>
    <div class=\"header\">
        <h1>Welcome to Our Customer Service</h1>
        <p>How can we help you today?</p>
    </div>
    <div class=\"suggestions\">
        <button class=\"suggestion-btn\" onclick=\"usePrompt('What services do you offer?')\">Our Services</button>
        <button class=\"suggestion-btn\" onclick=\"usePrompt('What are your business hours?')\">Business Hours</button>
        <button class=\"suggestion-btn\" onclick=\"usePrompt('What is your contact email?')\">Contact Email</button>
    </div>
    <div id=\"chat-container\">
        <div id=\"messages\"></div>
        <div class=\"input-container\">
            <div class=\"input-wrapper\">
                <input type=\"text\" id=\"message-input\" placeholder=\"Type your message...\">
            </div>
            <button onclick=\"sendMessage()\">Send</button>
            <button id=\"new-chat-btn\" onclick=\"startNewChat()\">New Chat</button>
        </div>
    </div>

    <script>
        const messagesContainer = document.getElementById('messages');
        const messageInput = document.getElementById('message-input');
        let currentChatId = null;
        let currentUserId = null;

        // Start a chat automatically when the page loads
        document.addEventListener('DOMContentLoaded', startNewChat);

        function startNewChat() {
            fetch('/api/create_chat', {
                method: 'POST',
                credentials: 'same-origin'
            })
            .then(response => response.json())
            .then(data => {
                currentChatId = data.chat_id;
                currentUserId = data.user_id;
                messagesContainer.innerHTML = '';
            })
            .catch(() => {
                alert('Error creating chat');
            });
        }

        function sendMessage() {
            const message = messageInput.value.trim();
            if (!message) return;

            // Add user message
            appendMessage('user', message);
            messageInput.value = '';

            // Send to server
            fetch('/api/send_message', {
                method: 'POST',
                credentials: 'same-origin',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    chat_id: currentChatId,
                    message: message
                })
            })
            .then(response => response.json())
            .then(data => {
                appendMessage('assistant', data.message);
            })
            .catch(() => {
                alert('Error sending message');
            });
        }

        function usePrompt(prompt) {
            messageInput.value = prompt;
            sendMessage();
        }

        function appendMessage(role, content) {
            const messageDiv = document.createElement('div');
            messageDiv.className = `message \${role}`;
            messageDiv.textContent = content;
            messagesContainer.appendChild(messageDiv);
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }

        // Handle Enter key
        messageInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                sendMessage();
            }
        });
    </script>
</body>
</html>
", "chat.html.twig", "/Users/svetlanayesayan/new/new/course_building-a-chatbot-with-php-and-symfony/app/templates/chat.html.twig");
    }
}
