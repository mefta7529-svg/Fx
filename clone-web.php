<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>𝗭𝗶𝗻𝘅𝗲𝘀𝟳𝘇</title>
<style>
  * { box-sizing: border-box; }
  body {
    margin: 5px;
    font-family: 'Inter', sans-serif;
    background: #0A0A11;
    color: #eee;
    height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
  }

  .box {
    background: #1E1E1E;
    border: 1px solid rgba(255, 255, 255, 0.15);
    border-radius: 14px;
    padding: 20px 20px;
    width: 90%;
    max-width: 700px;
    text-align: center;
    
  }

  h1 {
    font-size: 22px;
    margin-bottom: 18px;
    margin-top: -6px;
    color: #fff;
    letter-spacing: 1px;
  }

  .controls {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 6px;
    margin-bottom: 15px;
  }

  input {
    padding: 12px;
    flex: 1;
    border-radius: 8px;
    border: none;
    outline: none;
    border: 1px solid rgba(255, 255, 255, 0.20);
    background: #040407;
    color: #eee;
    font-size: 14px;
  }

  button {
    padding: 12px 16px;
    border: none;
    border-radius: 8px;
    background: linear-gradient(to right, #F54949, #dc2626);
    color: #fff;
    font-weight: 600;
    cursor: pointer;
    transition: 0.2s;
  }

  

  textarea {
    width: 100%;
    height: 300px;
    border-radius: 8px;
    border: none;
    outline: none;
    background: #040407;
    color: #eee;
    border: 1px solid rgba(255, 255, 255, 0.20);
    padding: 12px;
    font-family: monospace;
    font-size: 13px;
    resize: none;
  }

  .download-btn {
    margin-top: 15px;
    background: linear-gradient(to right, #3b82f6, #1d4ed8);
    color: #fff;
  }

 
  /* ✅ Offline Status Box */
/* 🔴 Offline / Alert Status Box */
.status-box {
  margin-top: 28px;
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 6px 12px;
  border-radius: 50px;
  background: rgba(255, 0, 0, 0.15);
  border: 1px solid #FF0000;
  color: #FF0000;
  font-weight: 600;
  font-size: 0.85rem;
  box-shadow: 0 0 10px rgba(255, 0, 0, 0.25);
}

.status-dot {
  width: 10px;
  height: 10px;
  border-radius: 50%;
  background: #FF0000;
  box-shadow: 0 0 6px #FF0000;
  animation: blink 1.5s infinite;
}

@keyframes blink {
  0%, 100% { opacity: 1; }
  50% { opacity: 0.4; }
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(8px); }
  to { opacity: 1; transform: translateY(0); }
}

  /* 🔹 smooth message */
  .msg {
    margin-top: 10px;
    font-size: 0.8rem;
    opacity: 0;
    transition: opacity 0.4s ease;
  }

  .msg.show {
    opacity: 1;
  }
</style>
</head>
<body>

<div class="box">
  <h1>Web Cloner Pro</h1>

  <div class="controls">
    <input type="text" id="urlInput" placeholder="Enter website URL...">
    <button id="cloneBtn">Clone</button>
  </div>

  <textarea id="htmlOutput" placeholder="Fetched HTML will appear here..." readonly></textarea>
  <button id="downloadBtn" class="download-btn">Download Code</button>

  <div id="msg" class="msg"></div>
</div>

<div class="status-box">
  <span class="status-dot"></span> Offline
</div>

<script>
const cloneBtn = document.getElementById('cloneBtn');
const urlInput = document.getElementById('urlInput');
const htmlOutput = document.getElementById('htmlOutput');
const downloadBtn = document.getElementById('downloadBtn');
const msg = document.getElementById('msg');

function showMsg(text, color="#f87171") {
  msg.style.color = color;
  msg.textContent = text;
  msg.classList.add('show');
  setTimeout(() => msg.classList.remove('show'), 2500);
}

// ✅ Fetch website source using API (unchanged)
cloneBtn.addEventListener('click', async () => {
  const url = urlInput.value.trim();
  if(!url) { showMsg('Please enter a URL.'); return; }

  htmlOutput.value = 'Fetching source code...';
  showMsg('Fetching website data...', '#60a5fa');

  try {
    const response = await fetch('https://api.allorigins.win/get?url=' + encodeURIComponent(url));
    if(!response.ok) throw new Error('Proxy error');
    const data = await response.json();
    htmlOutput.value = data.contents;
    showMsg('Website cloned successfully!', '#4ade80');
  } catch(err) {
    htmlOutput.value = '// Error: ' + err.message;
    showMsg('Error: ' + err.message);
  }
});

// ✅ Download code as .txt
downloadBtn.addEventListener('click', () => {
  const content = htmlOutput.value;
  if(!content || content.startsWith('Fetching')) {
    showMsg('No code to download!');
    return;
  }
  const blob = new Blob([content], { type: 'text/plain' });
  const url = URL.createObjectURL(blob);
  const a = document.createElement('a');
  a.href = url;
  a.download = 'cloned_code.txt';
  a.click();
  URL.revokeObjectURL(url);
  showMsg('File downloaded successfully!', '#4ade80');
});
</script>

</body>
</html>
