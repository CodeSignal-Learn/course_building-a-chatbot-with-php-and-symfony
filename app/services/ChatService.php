<?php

require_once '../models/ChatManager.php';
require_once '../vendor/autoload.php';

use OpenAI\Client;

class ChatService {
    private ChatManager $chatManager;
    private Client $openaiClient;
    private string $systemPrompt;

    public function __construct() {
        $this->chatManager = new ChatManager();
        
        // Initialize the OpenAI client
        $apiKey = $_ENV['OPENAI_API_KEY'] ?? getenv('OPENAI_API_KEY');
        $baseUrl = $_ENV['OPENAI_BASE_URL'] ?? getenv('OPENAI_BASE_URL');
        
        $this->openaiClient = \OpenAI::factory()
            ->withApiKey($apiKey)
            ->withBaseUri($baseUrl)
            ->make();
            
        $this->systemPrompt = $this->loadSystemPrompt('../data/system_prompt.txt');
    }

    private function loadSystemPrompt(string $filePath): string {
        try {
            if (!file_exists($filePath)) {
                throw new Exception("File not found.");
            }
            $content = file_get_contents($filePath);
            if ($content === false) {
                throw new Exception("Error reading file.");
            }
            return $content;
        } catch (Exception $e) {
            echo "Error loading system prompt: " . $e->getMessage() . PHP_EOL;
            return "You are a helpful assistant.";
        }
    }

    public function createChat(string $userId): string {
        $chatId = uniqid();
        $this->chatManager->createChat($userId, $chatId, $this->systemPrompt);
        return $chatId;
    }
    
    public function processMessage(string $userId, string $chatId, string $message): string {
        $chat = $this->chatManager->getChat($userId, $chatId);
        if (!$chat) {
            throw new ValueError("Chat not found");
        }
        
        // Add user message
        $this->chatManager->addMessage($userId, $chatId, "user", $message);
        
        try {
            // Get AI response
            $conversation = $this->chatManager->getConversation($userId, $chatId);
            
            $response = $this->openaiClient->chat()->create([
                'model' => 'gpt-3.5-turbo',
                'messages' => $conversation,
                'temperature' => 0.7,
                'max_tokens' => 500
            ]);
            
            $aiMessage = trim($response['choices'][0]['message']['content']);
            
            // Add AI response to chat history
            $this->chatManager->addMessage($userId, $chatId, "assistant", $aiMessage);
            
            return $aiMessage;
            
        } catch (Exception $e) {
            throw new RuntimeException("Error getting AI response: " . $e->getMessage());
        }
    }
}
?>
