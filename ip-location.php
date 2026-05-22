<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>𝗭𝗶𝗻𝘅𝗲𝘀𝟳𝘇</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #0A0A11;
      color: #e0e0e0;
      margin: 0;
      padding: 0;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }
    .container {
      background: #1E1E1E;
      border: 1px solid rgba(255, 255, 255, 0.15);
      padding: 25px;
      border-radius: 14px;
      text-align: center;
      width: 80%;
      max-width: 500px;
    }
    h1 {
      margin-bottom: 30px;
      font-size: 1.6em;
      color: #ffffff; /* Title white */
    }
    .input-group {
      display: flex;
      justify-content: center;
      margin-bottom: 20px;
    }
    input {
      padding: 12px;
      width: 70%;
      border: 1px solid #333;
      background: #040407;
      color: #fff;
      border-radius: 8px 0 0 8px;
      font-size: 16px;
      outline: none;
    }
    button {
      padding: 12px 18px;
      border: none;
      border-radius: 0 8px 8px 0;
      background: linear-gradient(to right, #F54949, #dc2626);
      color: white;
      font-size: 16px;
      cursor: pointer;
      transition: 0.3s;
    }
    button:hover {
      background: #2f6ed6;
    }
    #result {
      margin-top: 20px;
      padding: 15px;
      background: #040407;
      border: 1px solid #333;
      border-radius: 10px;
      text-align: left;
      font-size: 16px;
    }
    #result b {
      color: #3883FA;
    }
    .check-location {
      margin-top: 20px;
      display: inline-block;
      padding: 8px 18px;
      font-size: 12px;
      color: #fff;
      
      border-radius: 25px;
      cursor: pointer;
      background: linear-gradient(to right, #3b82f6, #1d4ed8);
      transition: 0.3s;
      text-transform: uppercase;
      font-weight: bold;
      letter-spacing: 1px;
    }
  
    

    /* Online Status Box */
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

    /* Dialog popup */
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
      background: #222;
      color: #fff;
      padding: 20px 30px;
      border-radius: 12px;
      font-weight: 600;
      box-shadow: 0 8px 24px rgba(0,0,0,0.7);
      text-align: center;
      max-width: 350px;
      width: 80%;
      animation: pop 0.25s ease;
    }
    @keyframes pop {
      0% { transform: scale(0.8); opacity: 0; }
      100% { transform: scale(1); opacity: 1; }
    }
    .dialog-box button {
      margin-top: 12px;
      padding: 8px 14px;
      border: none;
      border-radius: 8px;
      background: #3883FA;
      color: #fff;
      cursor: pointer;
      font-weight: 600;
    }
    .dialog-box button:hover {
      background: #2f6ed6;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>IP To Location</h1>
    <div class="input-group">
      <input type="text" id="ipInput" placeholder="Enter IP or leave blank for your IP">
      <button onclick="getLocation()">Find</button>
    </div>
    <div id="result"></div>
    <div class="check-location" onclick="checkMyLocation()">Check My IP</div>
  </div>

  <div class="status-box">
    <span class="status-dot"></span> Online
  </div>

  <div class="dialog-overlay" id="dialog">
    <div class="dialog-box" id="dialogMessage">
      <p id="dialogText"></p>
      <button onclick="closeDialog()">OK</button>
    </div>
  </div>

  <script>
    function showDialog(message) {
      const overlay = document.getElementById("dialog");
      document.getElementById("dialogText").innerText = message;
      overlay.style.display = "flex";
    }

    function closeDialog() {
      document.getElementById("dialog").style.display = "none";
    }

    async function getLocation() {
      const ip = document.getElementById("ipInput").value.trim();

      if (!ip) {
        showDialog("Please enter a valid IP address!");
        return; // Stop if input is empty
      }

      const url = `https://ipwho.is/${ip}`;

      try {
        const res = await fetch(url);
        const data = await res.json();

        if (!data.success) {
          showDialog(data.message || "Invalid IP address");
          return;
        }

        document.getElementById("result").innerHTML = `
          <b>IP:</b> ${data.ip}<br>
          <b>Country:</b> ${data.country} (${data.country_code})<br>
          <b>Region:</b> ${data.region}<br>
          <b>City:</b> ${data.city}<br>
          <b>Latitude:</b> ${data.latitude}<br>
          <b>Longitude:</b> ${data.longitude}<br>
          <b>Timezone:</b> ${data.timezone.id}<br>
          <b>ISP:</b> ${data.connection?.isp || "Unknown"}
        `;
      } catch (e) {
        showDialog("Error fetching location");
      }
    }

    async function checkMyLocation() {
      try {
        const res = await fetch("https://api.ipify.org?format=json");
        const data = await res.json();
        document.getElementById("ipInput").value = data.ip;
      } catch (e) {
        showDialog("Could not fetch your IP");
      }
    }
  </script>
</body>
</html>
