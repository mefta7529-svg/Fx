<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>QR Code Text Detector</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      background: #0A0A11;
      color: white;
      font-family: "Poppins", sans-serif;
      height: 100vh;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }

    .box {
      background: #1E1E1E;
      border-radius: 20px;
      width: 320px;     
      padding: 25px;
      border: 1px solid rgba(255, 255, 255, 0.15);
      text-align: center;
      margin-bottom: 25px;
      
    }

    h1 {
      font-size: 20px;
      margin-bottom: 25px;
      color: #fff;
    }

    input[type="file"] {
      display: none;
    }

    .upload-btn {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: #fff;
      color: #000;
      font-weight: 600;
      border: none;
      padding: 12px 24px;
      border-radius: 12px;
      cursor: pointer;
      transition: 0.3s;
      font-size: 16px;
    }

    .upload-btn img {
      width: 20px;
      height: 20px;
      vertical-align: middle;
    }

    .upload-btn:hover {
      opacity: 0.9;
      transform: scale(1.02);
    }

    .result {
      margin-top: 20px;
      background: #040407;
      padding: 15px;
      border-radius: 10px;
      border: 1px solid rgba(255, 255, 255, 0.15);
      color: #ccc;
      min-height: 6px;
      font-size: 15px;
      word-break: break-all;
      transition: 0.3s;
    }

    .bottom-buttons {
      display: flex;
      justify-content: space-between;
      margin-top: 15px;
    }

    .btn {
      flex: 1;
      margin: 0 5px;
      border: none;
      padding: 10px 0;
      border-radius: 8px;
      cursor: pointer;
      color: #fff;
      font-weight: 500;
      transition: 0.3s;
      font-size: 15px;
    }

    .btn-open {
      background: linear-gradient(to right, #3b82f6, #1d4ed8);
    }

    .btn-clear {
      background: linear-gradient(to right, #F54949, #dc2626);
    }

  

    #hiddenReader {
      display: none;
    }

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

  <div class="box">
    <h1>Qr Code To Text</h1>
    <label for="uploadImg" class="upload-btn">
      <img src="https://cdn-icons-png.flaticon.com/512/8191/8191607.png" alt="upload icon">
      Upload Image
    </label>
    <input type="file" id="uploadImg" accept="image/*" />

    <div class="result" id="result">Upload an image with a QR code...</div>

    <div class="bottom-buttons">
      <button class="btn btn-open" id="openLink">Open Link</button>
      <button class="btn btn-clear" id="clearText">Clear</button>
    </div>
  </div>

  <div class="status-box">
    <span class="status-dot"></span> Online
  </div>

  <div id="hiddenReader"></div>

  <script src="https://unpkg.com/html5-qrcode"></script>
  <script>
    const uploadInput = document.getElementById("uploadImg");
    const resultBox = document.getElementById("result");
    const openBtn = document.getElementById("openLink");
    const clearBtn = document.getElementById("clearText");
    const qrReader = new Html5Qrcode("hiddenReader");

    uploadInput.addEventListener("change", (e) => {
      const file = e.target.files[0];
      if (!file) return;

      resultBox.textContent = "⏳ Scanning QR code...";

      qrReader
        .scanFile(file, true)
        .then((decodedText) => {
          resultBox.textContent = decodedText || "❌ No text found in QR code.";
        })
        .catch(() => {
          resultBox.textContent = "❌ No QR code detected in the image.";
        });
    });

    openBtn.addEventListener("click", () => {
      const text = resultBox.textContent.trim();
      if (!text || text.includes("Upload") || text.includes("No QR") || text.includes("Scanning")) return;

      let url = text;
      if (!/^https?:\/\//i.test(url) && url.includes(".")) {
        url = "https://" + url;
      }

      try {
        const validUrl = new URL(url);
        window.open(validUrl, "_blank");
      } catch {
        // ❌ No system dialog / no alert
        resultBox.textContent = "⚠ The detected text is not a valid link.";
      }
    });

    clearBtn.addEventListener("click", () => {
      resultBox.textContent = "Upload an image with a QR code...";
      uploadInput.value = "";
    });
  </script>
</body>
</html>
