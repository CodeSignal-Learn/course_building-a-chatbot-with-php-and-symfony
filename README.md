# Developing a Chatbot Web Application With Symfony

This project demonstrates how to build an interactive customer service chatbot using **Symfony** (PHP web framework) and **OpenAI's API**. The chatbot features a modern web interface, persistent chat sessions, and real-time AI-powered responses.

## Features

- Professional, responsive chat interface
- Integration with OpenAI's API 
- Persistent chat sessions per user
- Message suggestions for quick queries
- Clean MVC (Model-View-Controller) architecture
- Easily customizable system prompt for chatbot persona

## Prerequisites

- PHP 8.1 or higher
- Composer (PHP dependency manager)
- Symfony CLI (for local development)
- OpenAI API key

## Installation

1. **Clone the repository:**
   ```bash
   git clone https://github.com/CodeSignal-Learn/course_developing-a-chatbot-web-application-with-symfony
   cd course_developing-a-chatbot-web-application-with-symfony
   ```

2. **Install PHP dependencies inside the `app` directory:**
   ```bash
   cd app
   composer install
   ```

## Configuration

Before running the application, set your OpenAI API key (and optionally, base URL) as environment variables.

For macOS/Linux:
```bash
export OPENAI_API_KEY='your-api-key-here'
export OPENAI_BASE_URL='https://api.openai.com/v1' # (optional, defaults to OpenAI)
```

For Windows (Command Prompt):
```cmd
set OPENAI_API_KEY=your-api-key-here
set OPENAI_BASE_URL=https://api.openai.com/v1
```

For Windows (PowerShell):
```powershell
$env:OPENAI_API_KEY='your-api-key-here'
$env:OPENAI_BASE_URL='https://api.openai.com/v1'
```

## Running the Application

1. **Start the Symfony development server from the `app` directory:**
   ```bash
   symfony server:start --no-tls --port=3000 --allow-http --allow-all-ip
   ```

2. **Open your browser and navigate to:**
   ```
   http://localhost:3000
   ```

## Usage

1. The chat interface will load in your browser.
2. Type your message in the input field or use a suggestion button.
3. Press Enter or click "Send" to submit your message.
4. The chatbot will respond in real time using OpenAI.

## Project Structure

```
.
├── README.md
├── composer.json
└── app/
    ├── public/           # Public assets (index.php, css/)
    │   └── css/
    │       └── style.css
    ├── templates/        # Twig HTML templates
    │   └── chat.html.twig
    ├── controllers/      # Route controllers (ChatController.php)
    ├── models/           # Data models (ChatManager.php)
    ├── services/         # Business logic (ChatService.php)
    └── data/             # System prompt and other data
        └── system_prompt.txt
```

The project follows an MVC (Model-View-Controller) architecture:
- **Controllers:** Handle HTTP requests and responses
- **Models:** Manage data and session storage
- **Services:** Contain business logic and OpenAI integration
- **Templates:** Store HTML views (Twig)
- **Public:** Contains CSS, JavaScript, and entry point (`index.php`)

## Customization

- **System Prompt:** Edit `app/data/system_prompt.txt` to change the chatbot's persona, services, or guidelines.
- **Styling:** Modify `app/public/css/style.css` for custom UI/UX.

---

**Happy chatting!**
