<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>𝗭𝗶𝗻𝘅𝗲𝘀𝟳𝘇</title>
<!-- Outfit Font -->
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;700&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/qrcode/build/qrcode.min.js"></script>
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
    align-items: center;
    min-height: 100vh;
    color: #fff;
    gap: 20px;
  }

  .card {
    background: #1E1E1E;
    border: 1px solid rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(20px);
    border-radius: 20px;
    padding: 30px 25px;
    width: 360px;
    max-width: 90%;
    text-align: center;
    box-shadow: 0 8px 30px rgba(0,0,0,0.5);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.6);
  }

  h1 {
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 20px;
    color: #fff;
  }

  input {
    width: 100%;
    padding: 10px;
    border-radius: 12px;
    border: 1px solid rgba(255,255,255,0.2);
    background: #040407;
    color: #fff;
    outline: none;
    font-size: 1.1rem;
    margin-bottom: 18px;
    transition: border 0.3s;
  }

  input:focus {
    border: 1px solid #3A86FE;
  }

  button {
    width: 100%;
    padding: 12px;
    border-radius: 12px;
    border: none;
    background: linear-gradient(to right, #3b82f6, #1d4ed8);
    color: #fff;
    font-size: 1rem;
    font-weight: 500;
    cursor: pointer;
    transition: background 0.3s, transform 0.3s;
    margin-bottom: 15px;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 8px;
  }

  button:hover {
    background: linear-gradient(90deg, #2668d8, #3A86FE);
    transform: translateY(-2px);
  }

  #qrcode {
    margin-top: 12px;
    display: flex;
    justify-content: center;
    padding: 10px;
    border-radius: 15px;
    background: #040407;
    border: 1px solid rgba(255, 255, 255, 0.15);
  }

  /* 🔥 Download Link Style */
  .download-link {
    display: none;
    margin-top: 20px;
    font-size: 0.95rem;
    color: #3A86FE;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    cursor: pointer;
    transition: color 0.3s;
  }

  .download-link:hover {
    color: #2668d8;
  }

  .download-link img {
    width: 25px;
    height: 25px;
  }

  /* ✅ Online Status Box */
  .status-box {
    margin-top: 28px;
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

</style>
</head>
<body>

<div class="card">
  <h1>QR Code Generator</h1>
  <input type="text" id="text" placeholder="Enter your text here">
  <button id="generateBtn">Generate QR Code</button>
  <div id="qrcode"></div>
  <!-- ✅ শুধুমাত্র Icon + Text -->
  <a class="download-link" id="downloadLink">
    <img src="https://cdn-icons-png.flaticon.com/512/10255/10255624.png" alt="Download"> Download QR
  </a>
</div>

<!-- ✅ Online Status Box -->
<div class="status-box">
  <span class="status-dot"></span> Online
</div>

<script>
const generateBtn = document.getElementById('generateBtn');
const downloadLink = document.getElementById('downloadLink');
const qrcodeContainer = document.getElementById('qrcode');
const textInput = document.getElementById('text');

generateBtn.addEventListener('click', () => {
  const text = textInput.value.trim();
  if(!text) return; 
  qrcodeContainer.innerHTML = '';
  QRCode.toCanvas(document.createElement('canvas'), text, { width: 180 }, function (error, canvas) {
    if(error) console.error(error);
    qrcodeContainer.appendChild(canvas);
    downloadLink.style.display = "inline-flex"; // ✅ Icon+Text show
  });
});

downloadLink.addEventListener('click', () => {
  const canvas = qrcodeContainer.querySelector('canvas');
  if(!canvas) return;
  const link = document.createElement('a');
  link.href = canvas.toDataURL();
  link.download = 'qr-code.png';
  link.click();
});
</script>

</body>
</html>
