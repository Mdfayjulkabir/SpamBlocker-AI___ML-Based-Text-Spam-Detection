<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spam_Blocker_AI</title>
    <style>
        /* Global Styles */
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            transition: background-color 0.3s ease;
        }

        body.dark-mode {
            background-color: #333;
        }

        /* App Container */
        .app-container {
            width: 100%;
            max-width: 600px;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            transition: transform 0.3s ease, background-color 0.3s ease;
        }

        body.dark-mode .app-container {
            background-color: #2c3e50;
        }

        /* Header */
        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            color: #34495e;
            font-size: 28px;
            margin-bottom: 10px;
        }

        body.dark-mode .header h1 {
            color: #ecf0f1;
        }

        .dark-mode-toggle {
            display: inline-block;
            margin-left: 15px;
            font-size: 14px;
            cursor: pointer;
            color: #34495e;
        }

        body.dark-mode .dark-mode-toggle {
            color: #ecf0f1;
        }

        /* Main Content */
        .main-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
        }

        textarea {
            width: 100%;
            padding: 15px;
            font-size: 16px;
            border: 2px solid #ddd;
            border-radius: 10px;
            resize: none;
            transition: all 0.3s ease;
        }

        body.dark-mode textarea {
            background-color: #34495e;
            color: #ecf0f1;
            border-color: #7f8c8d;
        }

        textarea:focus {
            outline: none;
            border-color: #2980b9;
        }

        button {
            padding: 15px 30px;
            background-color: #3498db;
            border: none;
            border-radius: 10px;
            color: white;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #2980b9;
        }

        body.dark-mode button {
            background-color: #2980b9;
        }

        button:active {
            background-color: #1c5980;
        }

        /* Feedback and Result */
        .feedback-bar {
            width: 100%;
            height: 10px;
            background-color: #3498db;
            border-radius: 5px;
            transition: width 0.3s ease;
            display: none;
        }

        .result {
            margin-top: 20px;
            font-size: 20px;
            font-weight: bold;
            color: #34495e;
            display: none;
        }

        body.dark-mode .result {
            color: #ecf0f1;
        }

        /* Loading Spinner */
        .spinner {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #3498db;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
            margin-top: 20px;
            display: none;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Footer */
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
        }

        .footer a {
            color: #3498db;
        }

        body.dark-mode .footer a {
            color: #ecf0f1;
        }
    </style>
</head>
<body>
    <div class="app-container">
        <header class="header">
            <h1>Spam_Blocker_AI</h1>
            <label for="darkModeToggle" class="dark-mode-toggle">
                <input type="checkbox" id="darkModeToggle" onclick="toggleDarkMode()"> Dark Mode
            </label>
        </header>

        <main class="main-content">
            <textarea id="smsInput" placeholder="Enter SMS text to classify..." oninput="checkSpamLikelihood()"></textarea>
            <button onclick="classifyMessage()">Classify Message</button>

            <!-- Feedback and Result -->
            <div id="feedback" class="feedback-bar"></div>
            <div id="result" class="result"></div>

            <!-- Loading spinner -->
            <div id="spinner" class="spinner"></div>
        </main>

        <footer class="footer">
            <p>Created by <strong>Md Fayjul Kabir</strong> | <a href="https://github.com/Mdfayjulkabir" target="_blank">GitHub</a></p>
        </footer>
    </div>

    <script>
        // Dark Mode Toggle
        function toggleDarkMode() {
            const body = document.body;
            body.classList.toggle('dark-mode');
            const container = document.querySelector('.app-container');
            container.classList.toggle('dark-mode');
        }

        // Show feedback bar while typing
        function checkSpamLikelihood() {
            const inputText = document.getElementById('smsInput').value;
            const feedbackBar = document.getElementById('feedback');
            
            if (inputText.length > 0) {
                feedbackBar.style.display = 'block';
                const progress = Math.min(inputText.length / 100, 1) * 100;
                feedbackBar.style.width = `${progress}%`;
            } else {
                feedbackBar.style.display = 'none';
            }
        }

        // Classify message and show result
        function classifyMessage() {
            const smsInput = document.getElementById('smsInput').value;
            const spinner = document.getElementById('spinner');
            const resultDiv = document.getElementById('result');

            // Show spinner while processing
            spinner.style.display = 'block';

            // Simulate API call for classification (replace with actual backend call)
            setTimeout(() => {
                spinner.style.display = 'none';
                const isSpam = Math.random() > 0.5; // Random classification for demo
                const result = isSpam ? 'spam' : 'ham';
                resultDiv.className = result;
                resultDiv.textContent = `The message is classified as ${result}`;
                resultDiv.style.display = 'block';
            }, 1500); // Simulate delay
        }
    </script>
</body>
</html>
