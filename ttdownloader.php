<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>TikTok Downloader</title>

<style>
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
      font-family: 'Inter', sans-serif;
      background-color: #0A0A11;
      color: #e0e0e0;
    }

    body {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
    }

    .box {
        width: 320px;
        background: #1E1E1E;
        padding: 25px 20px 20px 20px;
        border-radius: 12px;
        border: 1px solid rgba(255,255,255,0.1);
        text-align: center;
        margin-bottom: 15px;
    }

    h2 {
        margin-top: 0;
        margin-bottom: 18px;
        font-weight: 600;
        font-size: 22px;
        color: #fff;
    }

    input {
        width: 100%;
        padding: 12px 14px;
        border: 1px solid #444;
        border-radius: 10px;
        background: #040407;
        color: #fff;
        margin: 10px 0;
        font-size: 16px;
        outline: none;
        box-sizing: border-box;
    }

    button {
        width: 100%;
        padding: 12px;
        background: linear-gradient(to right, #3b82f6, #1d4ed8);
        color: #fff;
        border: none;
        font-size: 18px;
        border-radius: 10px;
        cursor: pointer;
        font-weight: 600;
        margin-top: 10px;
    }
    .download-btn {
        margin-top: 10px;
        padding: 12px;
         background: linear-gradient(to right, #3b82f6, #1d4ed8);
        color: #fff;
        border: none;
        width: 100%;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 600;
    }

    video {
        width: 100%;
        border-radius: 10px;
        margin-top: 12px;
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
    <h2>TikTok Video Downloader</h2>

    <input type="text" id="url" placeholder="Paste TikTok URL here...">
    <button onclick="processVideo()">Find Video</button>

    <p id="msg" style="color:red; margin-top:10px;"></p>

    <div id="preview" style="display:none;">
        <video controls id="videoPlayer"></video>
        <button class="download-btn" id="btnDownload">Download</button>
    </div>
</div>

<!-- ONLINE STATUS BOX -->
<div class="status-box">
    <span class="status-dot"></span> Online
</div>

<script>
async function processVideo() {
    const inputUrl = document.getElementById("url").value.trim();
    const msg = document.getElementById("msg");
    const preview = document.getElementById("preview");
    const videoPlayer = document.getElementById("videoPlayer");

    msg.textContent = "";
    preview.style.display = "none";

    if (!inputUrl.includes("tiktok.com")) {
        msg.textContent = "Please enter a valid TikTok URL.";
        return;
    }

    msg.textContent = "Please Wait, Finding Video...";

    try {
        const api = `https://www.tikwm.com/api/?url=${encodeURIComponent(inputUrl)}`;
        const res = await fetch(api);
        const data = await res.json();

        if (!data.data) {
            msg.textContent = "Failed to fetch video.";
            return;
        }

        const videoUrl = data.data.play;

        // Fetch the video as blob
        const file = await fetch(videoUrl);
        const blob = await file.blob();

        // Create local object URL
        const objectURL = URL.createObjectURL(blob);

        // show in video player
        videoPlayer.src = objectURL;
        preview.style.display = "block";
        msg.textContent = "";

        // Download same-page — no redirect
        document.getElementById("btnDownload").onclick = () => {
            const a = document.createElement("a");
            a.href = objectURL;
            a.download = "tiktok_video.mp4";
            a.click();
        };

    } catch (error) {
        msg.textContent = "Unable to find video !";
    }
}
</script>

</body>
</html>
