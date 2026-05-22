<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Password Generator with Status</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      height: 100vh;
      background: #0A0A11;
      font-family: "Poppins", sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      gap: 20px;
      color: #fff;
    }

    .glass-box {
      width: 360px;
      background: #1E1E1E;
      border: 1px solid rgba(255, 255, 255, 0.15);
      border-radius: 20px;
      padding: 30px;
      backdrop-filter: blur(20px);
      box-shadow: 0 0 30px rgba(0, 0, 0, 0.4);
      text-align: center;
    }

    h2 {
      margin-bottom: 20px;
      background: #fff;
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      font-size: 1.5rem;
      letter-spacing: 1px;
    }

    .output {
      background: #040407;
      padding: 12px;
      border-radius: 10px;
      font-size: 1rem;
      letter-spacing: 1px;
      color: #e9e9e9;
      border: 1px solid rgba(255, 255, 255, 0.2);
      margin-bottom: 20px;
      word-wrap: break-word;
      overflow-wrap: break-word;
      max-height: 80px;
      overflow-y: auto;
      scrollbar-width: thin;
      scrollbar-color: #6d5efc transparent;
    }

    .output::-webkit-scrollbar {
      height: 5px;
      width: 5px;
    }

    .output::-webkit-scrollbar-thumb {
      background: #6d5efc;
      border-radius: 10px;
    }

    .settings {
      text-align: left;
      margin-bottom: 20px;
      font-size: 0.9rem;
      line-height: 1.8;
    }

    label {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin: 4px 0;
    }

    input[type="checkbox"],
    input[type="number"] {
      accent-color: #6d5efc;
    }

    .btn {
      background: linear-gradient(90deg, #00b4ff, #6d5efc);
      border: none;
      color: #fff;
      font-weight: 600;
      padding: 12px 20px;
      border-radius: 10px;
      cursor: pointer;
      transition: 0.25s ease;
      width: 100%;
    }

    .btn:hover {
      background: linear-gradient(90deg, #0087c9, #5749d1);
      transform: scale(1.02);
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
  </style>
</head>
<body>

  <!-- Password Generator Box -->
  <div class="glass-box">
    <h2>Generate a Secure Password</h2>
    <div id="password" class="output">Your password will appear here</div>

    <div class="settings">
      <label><span>Include Uppercase</span> <input type="checkbox" id="uppercase" checked></label>
      <label><span>Include Lowercase</span> <input type="checkbox" id="lowercase" checked></label>
      <label><span>Include Numbers</span> <input type="checkbox" id="numbers" checked></label>
      <label><span>Include Symbols</span> <input type="checkbox" id="symbols" checked></label>
      <label><span>Password Length</span> <input type="number" id="length" value="12" min="4" max="64"></label>
    </div>

    <button class="btn" onclick="generatePassword()">Generate Password</button>
  </div>

  <!-- Online Status Box BELOW the main box -->
  <div class="status-box">
    <span class="status-dot"></span> Online
  </div>

  <script>
    function generatePassword() {
      const upper = document.getElementById("uppercase").checked;
      const lower = document.getElementById("lowercase").checked;
      const nums = document.getElementById("numbers").checked;
      const syms = document.getElementById("symbols").checked;
      const len = parseInt(document.getElementById("length").value);

      const upperChars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
      const lowerChars = "abcdefghijklmnopqrstuvwxyz";
      const numberChars = "0123456789";
      const symbolChars = "!@#$%^&*()_+-=[]{}|;:,.<>?/";

      let charSets = [];
      if (upper) charSets.push(upperChars);
      if (lower) charSets.push(lowerChars);
      if (nums) charSets.push(numberChars);
      if (syms) charSets.push(symbolChars);



      let password = "";

      // Ensure at least one character from each selected set
      charSets.forEach(set => {
        password += set.charAt(Math.floor(Math.random() * set.length));
      });

      // Fill the rest randomly
      let allChars = charSets.join("");
      for (let i = password.length; i < len; i++) {
        password += allChars.charAt(Math.floor(Math.random() * allChars.length));
      }

      // Shuffle the password to mix guaranteed chars
      password = password.split('').sort(() => Math.random() - 0.5).join('');

      document.getElementById("password").innerText = password;
    }
  </script>

</body>
</html>
