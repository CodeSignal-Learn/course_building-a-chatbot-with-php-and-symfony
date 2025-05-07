<?php
namespace App\Controller;
require_once '../services/ChatService.php';

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ChatController
{
    private \ChatService $chatService;
    private SessionInterface $session;
    
    public function __construct(SessionInterface $session)
    {
        $this->chatService = new \ChatService();
        $this->session = $session;
    }
    
    public function ensureUserSession(): string
    {
        /**
         * Ensure user has a session ID.
         */
        if (!$this->session->has('user_id')) {
            $newId = uniqid();
            $this->session->set('user_id', $newId);
            error_log("[ChatController] New user session created: $newId");
        } else {
            $existingId = $this->session->get('user_id');
            error_log("[ChatController] Existing user session: $existingId");
        }
        $userId = $this->session->get('user_id');
        error_log("[ChatController] PHPSESSID: " . session_id() . " user_id: $userId");
        return $userId;
    }
    
    public function createChat(): JsonResponse
    {
        /**
         * Handle chat creation request.
         */
        $userId = $this->ensureUserSession(); // Ensure user session is set
        if (!$userId) {
            error_log("[ChatController] createChat: Session expired");
            return new JsonResponse(['error' => 'Session expired'], 401);
        }
        
        $chatId = $this->chatService->createChat($userId);
        error_log("[ChatController] createChat called. userId=$userId");
        error_log("[ChatController] Chat created. chatId=$chatId");
        return new JsonResponse([
            'chat_id' => $chatId,
            'user_id' => $userId,
            'message' => 'Chat created successfully'
        ]);
    }
    
    public function sendMessage(): JsonResponse
    {
        /**
         * Handle message sending request.
         */
        $userId = $this->ensureUserSession(); // Ensure user session is set
        if (!$userId) {
            error_log("[ChatController] sendMessage: Session expired");
            return new JsonResponse(['error' => 'Session expired'], 401);
        }
        
        $request = Request::createFromGlobals();
        $rawContent = $request->getContent();
        error_log("[ChatController] sendMessage called. userId=$userId");
        error_log("[ChatController] Raw POST content: $rawContent");
        $data = json_decode($rawContent, true);
        error_log("[ChatController] Decoded POST data: " . print_r($data, true));
        
        $chatId = $data['chat_id'] ?? null;
        $userMessage = $data['message'] ?? null;
        
        if (!$chatId || !$userMessage) {
            error_log("[ChatController] sendMessage: Missing chat_id or message");
            return new JsonResponse(['error' => 'Missing chat_id or message'], 400);
        }
            
        try {
            error_log("[ChatController] Processing message. chatId=$chatId, userMessage=$userMessage");
            $aiResponse = $this->chatService->processMessage($userId, $chatId, $userMessage);
            return new JsonResponse(['message' => $aiResponse]);
        } catch (\ValueError $e) {
            error_log("[ChatController] ValueError: " . $e->getMessage());
            return new JsonResponse(['error' => $e->getMessage()], 404);
        } catch (\RuntimeException $e) {
            error_log("[ChatController] RuntimeException: " . $e->getMessage());
            return new JsonResponse(['error' => $e->getMessage()], 500);
        }
    }
}
?>