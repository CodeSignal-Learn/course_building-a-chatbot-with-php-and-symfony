<?php
require_once '../vendor/autoload.php';
require_once '../controllers/ChatController.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Controller\ChatController;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

// Initialize the request
$request = Request::createFromGlobals();

// Set a secret key for session management
$session = new Session();
$session->start();

// Create an instance of ChatController to handle chat operations
$chatController = new ChatController($session);

// Initialize Twig
$loader = new FilesystemLoader('../templates');
$twig = new Environment($loader);

// Define a route for the index page that ensures a user session
if ($request->getPathInfo() === '/') {
    $chatController->ensureUserSession();
    $response = new Response($twig->render('chat.html.twig'));
    $response->send();
}

// Define a route for creating a new chat session
if ($request->getPathInfo() === '/api/create_chat' && $request->getMethod() === 'POST') {
    // Delegate the creation of a chat session to the chat controller
    $response = $chatController->createChat();
    $response->send();
}

// Define a route for sending a message in an existing chat session
if ($request->getPathInfo() === '/api/send_message' && $request->getMethod() === 'POST') {
    // Delegate message handling to ChatController's send_message
    $response = $chatController->sendMessage();
    $response->send();
}
?>
