<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>𝗭𝗶𝗻𝘅𝗲𝘀𝟳𝘇</title>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap');

  body {
    font-family: 'Inter', sans-serif;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
    margin: 0;
    background-color: #0A0A11;
    color: #e0e0e0;
    flex-direction: column;
    position: relative;
  }

  .container {
    background: #1E1E1E;
    border: 1px solid rgba(255, 255, 255, 0.15);
    border-radius: 16px;
    padding: 20px; 
    max-width: 300px;
    width: 90%;
    box-shadow: 0 4px 16px rgba(0,0,0,0.6);
    text-align: center;
    z-index: 1;
  }

  h1 {
    font-size: 1.4rem;  
    margin-bottom: 30px;
    font-weight: 600;
    color: #ffffff;
  }

  .input-group {
    margin-bottom: 12px;
    text-align: left;
  }

  input, button {
    width: 95%;  
    padding: 10px 14px; 
    border-radius: 8px;
    border: none;
    font-family: inherit;
    box-sizing: border-box;
    display: block;
    margin-left: auto;
    margin-right: auto;
  }

  input {
    background: #040407;
    color: #fff;
    border: 1px solid rgba(255, 255, 255, 0.15);
    font-size: 15px; 
  }

  button {
    background: linear-gradient(to right, #3b82f6, #1d4ed8);
    color: #fff;
    font-weight: 600;
    cursor: pointer;
    font-size: 16px; 
    margin-top: 8px;
    transition: background 0.25s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
  }

  button:hover {
    background: linear-gradient(to right, #F54949, #dc2626);
  }

  button img {
    width: 22px;
    height: 22px;
  }

  .results {
    margin-top: 12px;
    padding: 14px;
    border-radius: 8px;
    background: #040407;
    font-size: 0.85rem; 
    line-height: 1.4;
    color: #e0e0e0;
    text-align: left;
    position: relative;
  }

  .results .label {
    font-weight: 700;
    color: #2AFF00; 
  }

  .results .title {
    color: #00EAFF;   
    font-size: 1rem;  
    font-weight: 700;
    display: block;
    margin-bottom: 6px;
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
  <h1>Live Age Calculator</h1>
  
  <div class="input-group">
    <input type="number" id="day" placeholder="DD" min="1" max="31">
  </div>
  
  <div class="input-group">
    <input type="number" id="month" placeholder="MM" min="1" max="12">
  </div>
  
  <div class="input-group">
    <input type="number" id="year" placeholder="YYYY" min="1900" max="2100">
  </div>
  
  <button onclick="startAgeCounter()">
    Generate Data
    <img src="https://cdn-icons-png.flaticon.com/512/18634/18634607.png" alt="arrow">
  </button>

  <div class="results" id="results">
    Enter your date, month & year and click Generate Data.
  </div>
</div>

<!-- ✅ Online Status Box -->
<div class="status-box">
  <span class="status-dot"></span> Online
</div>

<div class="dialog-overlay" id="dialog">
  <div class="dialog-box" id="dialog-message"></div>
</div>

<script>
let interval;

function showDialog(message) {
  const dialog = document.getElementById("dialog");
  const dialogMessage = document.getElementById("dialog-message");
  dialogMessage.innerText = message;
  dialog.style.display = "flex";

  dialog.onclick = () => {
    dialog.style.display = "none";
  };
}

function startAgeCounter() {
  const day = document.getElementById('day').value;
  const month = document.getElementById('month').value;
  const year = document.getElementById('year').value;

  if (!day || !month || !year) {
    showDialog("Please enter your Date, Month, and Year properly!");
    return;
  }

  const dob = new Date(`${year}-${month}-${day}`);
  if (dob == "Invalid Date") {
    showDialog("Invalid Date! Please enter correct values.");
    return;
  }

  if(interval) clearInterval(interval);

  interval = setInterval(() => {
    const now = new Date();
    const diffMs = now - dob;
    
    const totalSeconds = Math.floor(diffMs / 1000);
    const totalMinutes = Math.floor(totalSeconds / 60);
    const totalHours = Math.floor(totalMinutes / 60);
    const totalDays = Math.floor(totalHours / 24);

    document.getElementById('results').innerHTML = `
      <span class="title">Your Age in Real-Time:</span>
      <span class="label">Days:</span> ${totalDays.toLocaleString()}<br>
      <span class="label">Hours:</span> ${totalHours.toLocaleString()}<br>
      <span class="label">Minutes:</span> ${totalMinutes.toLocaleString()}<br>
      <span class="label">Seconds:</span> ${totalSeconds.toLocaleString()}
    `;
  }, 1000);
}
</script>

</body>
</html>
