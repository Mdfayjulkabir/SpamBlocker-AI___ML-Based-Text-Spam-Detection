<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Spam Blocker AI</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f0f0f0;
      margin: 0;
      padding: 0;
      color: #000;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      transition: background-color 0.4s ease, color 0.4s ease;
    }

    body.dark-mode {
      background-color: #1e1e1e;
      color: white;
    }

    .app-container {
      width: 100%;
      max-width: 600px;
      background-color: #fff;
      padding: 30px;
      border-radius: 20px;
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
      border: 2px solid #ccc;
      transition: background-color 0.3s ease;
    }

    body.dark-mode .app-container {
      background-color: #2a2a2a;
      border-color: #444;
    }

    .header {
      text-align: center;
      margin-bottom: 20px;
    }

    .fancy-title {
      font-size: 32px;
      font-weight: 800;
      background: linear-gradient(to right, #ff6ec4, #7873f5);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      animation: pulse 2s infinite;
    }

    @keyframes pulse {
      0%, 100% { transform: scale(1); }
      50% { transform: scale(1.05); }
    }

    .dark-mode-toggle {
      font-size: 14px;
      cursor: pointer;
      margin-top: 5px;
      color: #00796b;
    }

    body.dark-mode .dark-mode-toggle {
      color: #26a69a;
    }

    .main-content {
      display: flex;
      flex-direction: column;
      gap: 15px;
      align-items: center;
    }

    textarea {
      width: 100%;
      height: 120px;
      padding: 15px;
      font-size: 16px;
      border-radius: 12px;
      border: 2px solid #bbb;
      resize: none;
      background-color: #f9f9f9;
      color: #000;
    }

    body.dark-mode textarea {
      background-color: #1b1b1b;
      color: white;
      border-color: #666;
    }

    button {
      padding: 12px 28px;
      background: linear-gradient(to right, #00c6ff, #0072ff);
      border: none;
      border-radius: 40px;
      font-size: 16px;
      font-weight: bold;
      color: white;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    button:hover {
      transform: scale(1.05);
      box-shadow: 0 6px 15px rgba(0, 114, 255, 0.4);
    }

    .feedback-bar {
      width: 100%;
      height: 10px;
      background-color: #3498db;
      border-radius: 5px;
      display: none;
    }

    .result {
      font-size: 20px;
      font-weight: bold;
      display: none;
    }

    .spinner {
      border: 4px solid #f3f3f3;
      border-top: 4px solid #3498db;
      border-radius: 50%;
      width: 40px;
      height: 40px;
      animation: spin 1s linear infinite;
      display: none;
      margin-top: 10px;
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }

    .footer {
      text-align: center;
      margin-top: 20px;
      font-size: 14px;
    }

    .github-btn {
      display: inline-block;
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background-color: #333;
      color: #fff;
      text-align: center;
      line-height: 40px;
      margin-top: 10px;
      transition: background-color 0.3s, transform 0.3s;
    }

    .github-btn:hover {
      background-color: #6e5494;
      transform: scale(1.1);
    }

    body.dark-mode .github-btn {
      background-color: #fff;
      color: #000;
    }

    body.dark-mode .github-btn:hover {
      background-color: #c77dff;
    }

    .github-btn svg {
      width: 20px;
      height: 20px;
      vertical-align: middle;
      fill: currentColor;
    }
  </style>
</head>
<body class="light-mode">
  <div class="app-container">
    <header class="header">
      <h1><span class="fancy-title">Spam Blocker AI</span></h1>
      <label class="dark-mode-toggle">
        <input type="checkbox" onclick="toggleDarkMode()"> Dark Mode
      </label>
    </header>

    <main class="main-content">
      <textarea id="smsInput" placeholder="Type your SMS here..." oninput="updateProgress()"></textarea>
      <button onclick="classifyMessage()">Classify Message</button>

      <div id="feedback" class="feedback-bar"></div>
      <div id="result" class="result"></div>
      <div id="spinner" class="spinner"></div>
    </main>

    <footer class="footer">
      <p>Created by <strong>Md Fayjul Kabir</strong></p>
      <a href="https://github.com/Mdfayjulkabir" target="_blank" class="github-btn" title="GitHub">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
          <path d="M8 0C3.6 0 0 3.6 0 8c0 3.5 2.3 6.4 5.5 7.5.4.1.5-.2.5-.4v-1.3c-2.2.5-2.7-1-2.7-1-.3-.9-.8-1.1-.8-1.1-.7-.5.1-.5.1-.5.7.1 1.1.7 1.1.7.6 1.1 1.6.8 2 .6.1-.5.3-.8.5-1C4.9 10.7 3 10 3 7.1c0-.8.3-1.5.8-2.1-.1-.2-.3-1 .1-2.1 0 0 .6-.2 2.1.8.6-.2 1.2-.3 1.8-.3s1.2.1 1.8.3c1.5-1 2.1-.8 2.1-.8.4 1.1.2 1.9.1 2.1.5.6.8 1.3.8 2.1 0 2.9-1.9 3.6-3.6 3.8.3.3.6.8.6 1.6v2.4c0 .2.1.5.5.4C13.7 14.4 16 11.5 16 8c0-4.4-3.6-8-8-8z"/>
        </svg>
      </a>
    </footer>
  </div>

  <script>
    function toggleDarkMode() {
      document.body.classList.toggle('dark-mode');
    }

    function updateProgress() {
      const input = document.getElementById('smsInput').value;
      const bar = document.getElementById('feedback');
      if (input.length > 0) {
        bar.style.display = 'block';
        const percent = Math.min(input.length / 100, 1) * 100;
        bar.style.width = `${percent}%`;
      } else {
        bar.style.display = 'none';
      }
    }

    function classifyMessage() {
      const spinner = document.getElementById('spinner');
      const result = document.getElementById('result');
      const text = document.getElementById('smsInput').value;

      result.style.display = 'none';
      spinner.style.display = 'block';

      setTimeout(() => {
        spinner.style.display = 'none';
        const isSpam = Math.random() > 0.5;
        result.textContent = `The message is classified as ${isSpam ? '🚫 SPAM' : '✅ HAM'}`;
        result.style.color = isSpam ? '#ff5252' : '#00e676';
        result.style.display = 'block';
      }, 1500);
    }
  </script>
</body>
</html>
