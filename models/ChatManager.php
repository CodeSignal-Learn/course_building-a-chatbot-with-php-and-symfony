<?php

class ChatManager {
    public function __construct() {
        // Ensure session is started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // Initialize chats array in session if it doesn't exist
        if (!isset($_SESSION['chats'])) {
            $_SESSION['chats'] = [];
        }
    }

    public function createChat(string $userId, string $chatId, string $systemPrompt): void {
        if (!isset($_SESSION['chats'][$userId])) {
            $_SESSION['chats'][$userId] = [];
        }

        $_SESSION['chats'][$userId][$chatId] = [
            'system_prompt' => $systemPrompt,
            'messages' => []
        ];
    }

    public function getChat(string $userId, string $chatId): ?array {
        return $_SESSION['chats'][$userId][$chatId] ?? null;
    }

    public function addMessage(string $userId, string $chatId, string $role, string $content): void {
        if ($chat = $this->getChat($userId, $chatId)) {
            $chat['messages'][] = ["role" => $role, "content" => $content];
            $_SESSION['chats'][$userId][$chatId] = $chat; // Update the chat with new message
        }
    }

    public function getConversation(string $userId, string $chatId): array {
        if ($chat = $this->getChat($userId, $chatId)) {
            return array_merge(
                [["role" => "system", "content" => $chat['system_prompt']]],
                $chat['messages']
            );
        }
        return [];
    }
}
?>
