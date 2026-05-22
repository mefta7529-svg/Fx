<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Base64 Converter</title>
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600&display=swap" rel="stylesheet">
<style>
  * {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    font-family: 'Outfit', sans-serif;
  }

  body {
    background: #0A0A11;
    display: flex;
    flex-direction: column;
    justify-content: center;
    margin-top: -10px;
    align-items: center;
    min-height: 100vh;
    color: #fff;
    padding: 20px;
  }

  .container {
    background: #1E1E1E;
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 14px;
    padding: 20px;
    width: 100%;
    max-width: 500px;
    margin-bottom: 20px;
  }

  h1 {
    text-align: center;
    font-size: 1.6rem;
    margin-bottom: 25px;
    color: #fff;
    font-weight: 500;
  }

  textarea {
    width: 100%;
    padding: 10px;
    border-radius: 8px;
    border: 1px solid rgba(255,255,255,0.15);
    background: #0f0f15;
    color: #fff;
    outline: none;
    font-size: 1rem;
    margin-bottom: 15px;
    resize: vertical;
    min-height: 150px;
    font-family: monospace;
    transition: border 0.2s;
  }

  textarea:focus {
    border-color: #3A86FE;
  }

  .buttons {
    display: flex;
    gap: 12px;
    margin-bottom: 25px;
  }

  button {
    flex: 1;
    padding: 13px;
    border-radius: 8px;
    border: none;
    color: white;
    font-size: 0.95rem;
    font-weight: 500;
    cursor: pointer;
    transition: opacity 0.2s;
  }

  .encode-btn {
    background: linear-gradient(to right, #3b82f6, #1d4ed8);
  }

  .decode-btn {
    background: linear-gradient(to right, #F54949, #dc2626);
  }

  button:hover {
    opacity: 0.9;
  }

  .result-box {
    background: #0f0f15;
    border-radius: 8px;
    padding: 10px;
    border: 1px solid rgba(255,255,255,0.1);
    min-height: 150px;
  }

  .result-label {
    color: #888;
    font-size: 0.85rem;
    margin-bottom: 8px;
    display: block;
  }

  #result {
    color: #fff;
    font-family: monospace;
    font-size: 0.95rem;
    line-height: 1.5;
    word-break: break-all;
  }

  .info {
    text-align: center;
    color: #666;
    font-size: 0.8rem;
    margin-top: 20px;
    line-height: 1.4;
  }

  .result-box:empty::before {
    content: "Result will appear here...";
    color: #666;
    font-style: italic;
  }

  /* Status box styles - NOW OUTSIDE THE CONTAINER */
  .status-box {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 12px;
    border-radius: 50px;
    background: rgba(0, 255, 20, 0.15);
    border: 1px solid #00FF14;
    color: #00FF14;
    font-weight: 600;
    font-size: 0.85rem; 
    box-shadow: 0 0 10px rgba(0,255,20,0.25);
  }
  
  .status-dot {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background: #00FF14;
    box-shadow: 0 0 6px #00FF14;
    animation: blink 1.5s infinite;
  }
  
  @keyframes blink {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.4; }
  }

  /* Dialog overlay styles (not activated in current code) */
  .dialog-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.6);
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 999;
  }

  .dialog-box {
    background: #ffffff;
    padding: 30px;
    border-radius: 16px;
    text-align: center;
    max-width: 360px;
    width: 70%;
    color: #ff2e2e;
    font-size: 1rem; 
    font-weight: 600;
    box-shadow: 0 8px 24px rgba(0,0,0,0.7);
    animation: pop 0.3s ease;
  }

  @keyframes pop {
    0% { transform: scale(0.8); opacity: 0; }
    100% { transform: scale(1); opacity: 1; }
  }
</style>
</head>
<body>

<div class="container">
  <h1>Base64 Converter</h1>
  
  <textarea id="input" placeholder="Enter text or paste Base64 here..."></textarea>
  
  <div class="buttons">
    <button class="encode-btn" onclick="encodeText()">Encode to Base64</button>
    <button class="decode-btn" onclick="decodeText()">Decode from Base64</button>
  </div>
  
  <div class="result-box">
    <div id="result"></div>
  </div>
</div>

<!-- Status box moved HERE - OUTSIDE AND BELOW the container -->
<div class="status-box">
  <div class="status-dot"></div>
  Online
</div>

<!-- Dialog overlay (not activated in current code) -->
<div class="dialog-overlay" id="dialogOverlay">
  <div class="dialog-box" id="dialogBox">
    Dialog message here
  </div>
</div>

<script>
const input = document.getElementById('input');
const result = document.getElementById('result');

function encodeText() {
  const text = input.value.trim();
  if (!text) {
    result.innerHTML = '<span style="color:#ff6b6b">Please enter some text</span>';
    return;
  }
  
  try {
    const encoded = btoa(unescape(encodeURIComponent(text)));
    result.textContent = encoded;
    result.style.color = "#fff";
  } catch (error) {
    result.innerHTML = '<span style="color:#ff6b6b">Encoding error</span>';
  }
}

function decodeText() {
  const text = input.value.trim();
  if (!text) {
    result.innerHTML = '<span style="color:#ff6b6b">Please enter Base64</span>';
    return;
  }
  
  try {
    const decoded = decodeURIComponent(escape(atob(text)));
    result.textContent = decoded;
    result.style.color = "#fff";
  } catch (error) {
    result.innerHTML = '<span style="color:#ff6b6b">Invalid Base64 format</span>';
  }
}

// Keyboard shortcuts
input.addEventListener('keydown', (e) => {
  if (e.ctrlKey && e.key === 'Enter') {
    encodeText();
    e.preventDefault();
  }
  
  if (e.ctrlKey && e.shiftKey && e.key === 'Enter') {
    decodeText();
    e.preventDefault();
  }
});
</script>

</body>
</html>