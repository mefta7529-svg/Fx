<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
<title>ZINXES Admin Panel</title>
<link href="https://fonts.googleapis.com/css2?family=Afacad&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
    * { margin:0; padding:0; box-sizing:border-box; }
    body {
        background:radial-gradient(circle at 20% 30%,#1a3b5d,#0a1a2a,#05121e);
        min-height:100vh; font-family:'Poppins','Afacad',system-ui,-apple-system,sans-serif;
        padding:1rem; color:#fff;
    }
    .container { max-width:1400px; margin:0 auto; }
    .header {
        text-align:center; margin-bottom:30px; padding:20px;
        background:rgba(255,255,255,0.1); backdrop-filter:blur(10px); -webkit-backdrop-filter:blur(10px);
        border-radius:24px; border:1px solid rgba(255,255,255,0.2);
    }
    .header h1 {
        font-size:2rem; font-weight:700; margin-bottom:5px;
        background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);
        -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;
    }
    .header p { font-size:0.9rem; opacity:0.8; }
    .admin-panel { display:block; }
    .stats-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(200px,1fr)); gap:20px; margin-bottom:30px; }
    .stat-card { background:rgba(255,255,255,0.1); backdrop-filter:blur(10px); -webkit-backdrop-filter:blur(10px); padding:20px; border-radius:16px; border:1px solid rgba(255,255,255,0.2); text-align:center; }
    .stat-card h3 { font-size:0.9rem; opacity:0.8; margin-bottom:10px; }
    .stat-card .number { font-size:2rem; font-weight:700; }
    .total-users .number { color:#67e8f9; }
    .blocked-users .number { color:#fca5a5; }
    .search-box { margin-bottom:20px; }
    .search-box input { width:100%; padding:14px 20px; border:none; border-radius:16px; background:rgba(255,255,255,0.1); backdrop-filter:blur(10px); -webkit-backdrop-filter:blur(10px); border:1px solid rgba(255,255,255,0.2); color:#fff; font-size:16px; outline:none; transition:all 0.3s; }
    .search-box input:focus { border-color:rgba(102,126,234,0.6); background:rgba(255,255,255,0.15); }
    .search-box input::placeholder { color:rgba(255,255,255,0.6); }
    .user-table-container { background:rgba(255,255,255,0.1); backdrop-filter:blur(15px); -webkit-backdrop-filter:blur(15px); border-radius:20px; border:1px solid rgba(255,255,255,0.2); overflow-x:auto; -webkit-overflow-scrolling:touch; }
    table { width:100%; border-collapse:collapse; }
    th { background:rgba(255,255,255,0.15); padding:15px; text-align:left; font-size:0.85rem; text-transform:uppercase; letter-spacing:1px; color:rgba(255,255,255,0.9); white-space:nowrap; }
    td { padding:12px 15px; border-bottom:1px solid rgba(255,255,255,0.1); font-size:0.9rem; white-space:nowrap; }
    tr:hover { background:rgba(255,255,255,0.05); }
    .blocked-badge { background:rgba(239,68,68,0.3); color:#fca5a5; border:1px solid rgba(239,68,68,0.5); padding:5px 12px; border-radius:20px; font-size:0.8rem; font-weight:600; display:inline-block; }
    .unblocked-badge { background:rgba(34,197,94,0.3); color:#86efac; border:1px solid rgba(34,197,94,0.5); padding:5px 12px; border-radius:20px; font-size:0.8rem; font-weight:600; display:inline-block; }
    .action-btn { padding:8px 16px; border:none; border-radius:8px; font-size:0.8rem; font-weight:600; cursor:pointer; transition:all 0.3s; font-family:'Poppins',sans-serif; margin:2px; }
    .block-btn { background:rgba(239,68,68,0.8); color:#fff; }
    .block-btn:hover { background:rgba(239,68,68,1); transform:translateY(-1px); }
    .unblock-btn { background:rgba(34,197,94,0.8); color:#fff; }
    .unblock-btn:hover { background:rgba(34,197,94,1); transform:translateY(-1px); }
    .delete-btn { background:rgba(220,38,38,0.8); color:#fff; }
    .delete-btn:hover { background:rgba(220,38,38,1); transform:translateY(-1px); }
    .logout-btn { background:rgba(220,38,38,0.7); color:#fff; border:none; padding:8px 20px; border-radius:12px; font-size:0.85rem; font-weight:700; cursor:pointer; font-family:'Poppins',sans-serif; margin-top:10px; transition:0.2s; }
    .logout-btn:hover { background:rgba(220,38,38,1); }
    .refresh-btn { background:rgba(16,185,129,0.7); color:#fff; border:none; padding:8px 20px; border-radius:12px; font-size:0.85rem; font-weight:700; cursor:pointer; font-family:'Poppins',sans-serif; margin-top:10px; margin-right:8px; transition:0.2s; }
    .refresh-btn:hover { background:rgba(16,185,129,1); }
    .no-users { text-align:center; padding:40px; opacity:0.7; font-size:1.1rem; }
    .password-clickable { cursor:pointer; position:relative; display:inline-flex; align-items:center; gap:8px; background:linear-gradient(135deg,rgba(102,126,234,0.2),rgba(118,75,162,0.2)); padding:6px 14px; border-radius:40px; font-family:monospace; font-size:0.85rem; font-weight:500; transition:all 0.25s ease; border:1px solid rgba(102,126,234,0.4); backdrop-filter:blur(4px); }
    .password-clickable:hover { background:linear-gradient(135deg,rgba(102,126,234,0.4),rgba(118,75,162,0.4)); transform:scale(1.02); border-color:rgba(102,126,234,0.8); box-shadow:0 0 12px rgba(102,126,234,0.3); }
    .password-clickable .eye-icon { font-size:0.9rem; opacity:0.8; }
    .password-dialog { display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.75); backdrop-filter:blur(12px); z-index:1000; justify-content:center; align-items:center; font-family:'Poppins',sans-serif; animation:fadeIn 0.2s ease; }
    @keyframes fadeIn { from{opacity:0} to{opacity:1} }
    .dialog-card { background:linear-gradient(145deg,rgba(25,35,50,0.98),rgba(15,25,40,0.98)); backdrop-filter:blur(20px); border-radius:48px; padding:0; max-width:460px; width:90%; border:1px solid rgba(102,126,234,0.6); box-shadow:0 30px 50px rgba(0,0,0,0.6),0 0 0 1px rgba(255,255,255,0.05) inset; overflow:hidden; transform:scale(0.98); animation:dialogPop 0.25s cubic-bezier(0.34,1.2,0.64,1) forwards; }
    @keyframes dialogPop { 0%{transform:scale(0.92);opacity:0} 100%{transform:scale(1);opacity:1} }
    .dialog-header h3 { font-size:1.8rem; font-weight:700; margin:0; color:white; letter-spacing:-0.3px; display:flex; align-items:center; justify-content:center; gap:10px; }
    .dialog-header h3 span { font-size:2rem; }
    .dialog-header .sub { font-size:0.75rem; opacity:0.85; margin-top:6px; letter-spacing:0.5px; }
    .password-vault { padding:30px 28px 20px; text-align:center; }
    .password-label { text-transform:uppercase; font-size:0.7rem; letter-spacing:2px; font-weight:600; color:#a0aec0; margin-bottom:12px; }
    .password-value-wrapper { background:rgba(0,0,0,0.45); border-radius:28px; padding:50px 20px; border:1px solid rgba(255,255,255,0.15); transition:all 0.2s; margin:8px 0 12px; position:relative; }
    .password-value { font-family:'Courier New','Fira Code',monospace; font-size:1.5rem; font-weight:700; letter-spacing:1.5px; color:#facc15; text-shadow:0 0 6px rgba(250,204,21,0.3); word-break:break-all; background:transparent; text-align:center; }
    .password-hint { font-size:0.7rem; color:#8aa0c0; margin-top:12px; display:flex; align-items:center; justify-content:center; gap:6px; }
    .dialog-actions-modern { display:flex; gap:16px; padding:0 28px 32px 28px; justify-content:center; }
    .dialog-btn-modern { flex:1; padding:12px 0; border:none; border-radius:60px; font-size:0.95rem; font-weight:600; cursor:pointer; transition:all 0.25s; font-family:'Poppins',sans-serif; display:flex; align-items:center; justify-content:center; gap:10px; background:rgba(30,40,55,0.9); color:#e2e8f0; border:1px solid rgba(255,255,255,0.1); }
    .copy-btn { background:linear-gradient(135deg,#3b82f6,#2563eb); color:white; border:none; box-shadow:0 4px 12px rgba(59,130,246,0.3); }
    .copy-btn:hover { background:linear-gradient(135deg,#2563eb,#1d4ed8); transform:translateY(-2px); box-shadow:0 8px 20px rgba(59,130,246,0.4); }
    .close-btn { background:rgba(100,116,139,0.7); backdrop-filter:blur(4px); }
    .close-btn:hover { background:rgba(71,85,105,0.9); transform:translateY(-2px); }
    .dialog-btn-modern:active { transform:translateY(1px); }
    @keyframes pulseCopy { 0%{transform:scale(1)} 50%{transform:scale(0.98)} 100%{transform:scale(1)} }
    .copy-feedback { animation:pulseCopy 0.3s ease; }

    /* Login screen */
    #loginScreen { position:fixed; inset:0; background:radial-gradient(circle at 20% 30%,#1a3b5d,#0a1a2a,#05121e); display:flex; align-items:center; justify-content:center; z-index:9999; }
    .login-card { background:rgba(255,255,255,0.12); border:1px solid rgba(255,255,255,0.3); border-radius:32px; padding:36px 28px; width:90%; max-width:360px; text-align:center; }
    .login-card h2 { font-size:1.6rem; font-weight:800; margin-bottom:20px; }
    .login-card input { width:100%; padding:13px 18px; margin-bottom:14px; background:rgba(255,255,255,0.1); border:1px solid rgba(255,255,255,0.25); border-radius:20px; color:#fff; font-size:15px; outline:none; font-family:'Poppins',sans-serif; }
    .login-card input::placeholder { color:rgba(255,255,255,0.6); }
    .login-card button { width:100%; padding:13px; background:rgba(37,99,235,0.85); border:none; border-radius:20px; color:#fff; font-size:15px; font-weight:700; cursor:pointer; font-family:'Poppins',sans-serif; }
    #loginError { color:#ff8a8a; font-size:13px; margin-top:10px; display:none; }

    @media(max-width:500px) {
        .password-value{font-size:1.1rem}
        .dialog-header h3{font-size:1.4rem}
        .dialog-actions-modern{gap:12px;padding:0 20px 24px 20px}
        .password-vault{padding:20px 20px 10px}
        .dialog-btn-modern{padding:10px 0;font-size:0.85rem}
    }
</style>
</head>
<body>

<!-- LOGIN SCREEN -->
<div id="loginScreen">
  <div class="login-card">
    <h2>🔐 Admin Login</h2>
    <input type="password" id="adminPass" placeholder="Admin Password" onkeydown="if(event.key==='Enter')doLogin()">
    <button onclick="doLogin()">Login</button>
    <div id="loginError">❌ Wrong password!</div>
  </div>
</div>

<div class="container">
    <div class="admin-panel" id="adminPanel" style="display:none;">
        <div class="header">
            <h1>ZINXES Admin Panel</h1>
            <p>User Management & Monitoring</p>
            <br>
            <button class="refresh-btn" onclick="loadUsers()">🔄 Refresh</button>
            <button class="logout-btn" onclick="doLogout()">Logout</button>
        </div>

        <div class="stats-grid">
            <div class="stat-card total-users"><h3>Total Users</h3><div class="number" id="totalUsers">0</div></div>
            <div class="stat-card blocked-users"><h3>Blocked Users</h3><div class="number" id="blockedUsers">0</div></div>
        </div>

        <div class="search-box">
            <input type="text" id="searchInput" placeholder="Search by username or password..." onkeyup="filterUsers()">
        </div>

        <div class="user-table-container">
            <table>
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Status</th>
                        <th>Last Login</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="userTableBody">
                    <tr><td colspan="6" class="no-users">Loading...</td></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="passwordDialog" class="password-dialog">
    <div class="dialog-card">
        <div class="dialog-header">
            <h3><span>🔑</span> Password Vault</h3>
            <div class="sub">Secure Password View</div>
        </div>
        <div class="password-vault">
            <div class="password-label">User Password</div>
            <div class="password-value-wrapper">
                <div class="password-value" id="dialogPasswordText">********</div>
            </div>
            <div class="password-hint"><span>👆</span> Click Copy to copy password</div>
        </div>
        <div class="dialog-actions-modern">
            <button class="dialog-btn-modern copy-btn" id="copyPasswordBtn"><span>📋</span> Copy Password</button>
            <button class="dialog-btn-modern close-btn" id="hideDialogBtn"><span>✕</span> Close</button>
        </div>
    </div>
</div>

<script>
  // ── CONFIG — এখানে তোমার password দাও ──
  const ADMIN_PASSWORD = "zin@admin2025";
  const API = '../api.php';

  // ── Login ──
  function doLogin() {
    const pass = document.getElementById('adminPass').value;
    if (pass === ADMIN_PASSWORD) {
      document.getElementById('loginScreen').style.display = 'none';
      document.getElementById('adminPanel').style.display = 'block';
      sessionStorage.setItem('adminLoggedIn','1');
      loadUsers();
    } else {
      document.getElementById('loginError').style.display = 'block';
      document.getElementById('adminPass').value = '';
    }
  }

  function doLogout() {
    sessionStorage.removeItem('adminLoggedIn');
    location.reload();
  }

  if (sessionStorage.getItem('adminLoggedIn')==='1') {
    document.getElementById('loginScreen').style.display='none';
    document.getElementById('adminPanel').style.display='block';
    loadUsers();
  }

  let allUsers = [];
  let currentPasswordForDialog = '';

  async function apiCall(action, data={}) {
    const res = await fetch(API, {
      method:'POST',
      headers:{'Content-Type':'application/json'},
      body: JSON.stringify({action, ...data})
    });
    return res.json();
  }

  async function loadUsers() {
    document.getElementById('userTableBody').innerHTML='<tr><td colspan="6" class="no-users">Loading...</td></tr>';
    try {
      const data = await apiCall('get_users');
      if (data.success) { allUsers=data.users; renderUsers(allUsers); }
      else document.getElementById('userTableBody').innerHTML=`<tr><td colspan="6" class="no-users" style="color:#ff6b6b;">Error: ${escapeHtml(data.message)}</td></tr>`;
    } catch(e) {
      document.getElementById('userTableBody').innerHTML='<tr><td colspan="6" class="no-users" style="color:#ff6b6b;">Connection error! api.php check করো</td></tr>';
    }
  }

  function renderUsers(users) {
    const tbody = document.getElementById('userTableBody');
    if (!users||users.length===0) { tbody.innerHTML='<tr><td colspan="6" class="no-users">No users found</td></tr>'; updateStats([]); return; }
    tbody.innerHTML = users.map(user => {
      const safeUsername = escapeHtml(user.username||'Unknown');
      const rawPassword = user.password||'N/A';
      const escapedPasswordForAttr = rawPassword.replace(/\\/g,'\\\\').replace(/'/g,"\\'");
      const statusText = user.blocked ? 'Blocked' : 'Active';
      const statusClass = user.blocked ? 'blocked-badge' : 'unblocked-badge';
      return `<tr>
        <td><strong>${safeUsername}</strong></td>
        <td>
          <div class="password-clickable" onclick="showPasswordDialog('${escapedPasswordForAttr}')" title="Click to view password">
            <span>••••••••</span><span class="eye-icon">👁</span>
          </div>
        </td>
        <td><span class="${statusClass}">${statusText}</span></td>
        <td>${formatTimestamp(user.lastLogin)}</td>
        <td>${formatTimestamp(user.createdAt)}</td>
        <td>
          ${user.blocked
            ? `<button class="action-btn unblock-btn" onclick="unblockUser('${user.id}')">Unblock</button>`
            : `<button class="action-btn block-btn" onclick="blockUser('${user.id}')">Block</button>`}
          <button class="action-btn delete-btn" onclick="deleteUser('${user.id}')">Delete</button>
        </td>
      </tr>`;
    }).join('');
    updateStats(users);
  }

  function updateStats(users) {
    document.getElementById('totalUsers').textContent = users.length;
    document.getElementById('blockedUsers').textContent = users.filter(u=>u.blocked===true).length;
  }

  function filterUsers() {
    const term = document.getElementById('searchInput').value.toLowerCase();
    if (!allUsers) return;
    const filtered = allUsers.filter(u =>
      (u.username&&u.username.toLowerCase().includes(term)) ||
      (u.password&&u.password.toLowerCase().includes(term)) ||
      (u.id&&u.id.toLowerCase().includes(term))
    );
    renderUsers(filtered);
  }

  async function blockUser(userId) {
    if (!confirm('Are you sure you want to BLOCK this user?')) return;
    const data = await apiCall('block_user',{userId, blocked:true});
    if (data.success) loadUsers(); else alert('Error: '+data.message);
  }

  async function unblockUser(userId) {
    if (!confirm('Are you sure you want to UNBLOCK this user?')) return;
    const data = await apiCall('block_user',{userId, blocked:false});
    if (data.success) loadUsers(); else alert('Error: '+data.message);
  }

  async function deleteUser(userId) {
    if (!confirm('Are you sure you want to DELETE this user? This cannot be undone!')) return;
    const data = await apiCall('delete_user',{userId});
    if (data.success) loadUsers(); else alert('Error: '+data.message);
  }

  function showPasswordDialog(password) {
    currentPasswordForDialog = password||'N/A';
    document.getElementById('dialogPasswordText').textContent = currentPasswordForDialog;
    document.getElementById('passwordDialog').style.display = 'flex';
  }

  function hidePasswordDialog() {
    document.getElementById('passwordDialog').style.display = 'none';
    currentPasswordForDialog = '';
  }

  function copyPasswordFromDialog() {
    if (!currentPasswordForDialog||currentPasswordForDialog==='N/A') {
      const btn=document.getElementById('copyPasswordBtn');
      const orig=btn.innerHTML; btn.innerHTML='<span></span> No Password';
      setTimeout(()=>btn.innerHTML=orig,1000); return;
    }
    navigator.clipboard.writeText(currentPasswordForDialog).then(() => {
      const wrapper=document.querySelector('.password-value-wrapper');
      const btn=document.getElementById('copyPasswordBtn');
      wrapper.style.transition='0.2s'; wrapper.style.backgroundColor='rgba(59,130,246,0.2)'; wrapper.style.borderColor='#3b82f6';
      const orig=btn.innerHTML; btn.innerHTML='<span></span> Copied!'; btn.classList.add('copy-feedback');
      setTimeout(()=>{ wrapper.style.backgroundColor=''; wrapper.style.borderColor=''; btn.innerHTML=orig; btn.classList.remove('copy-feedback'); },1500);
    }).catch(()=>{
      const ta=document.createElement('textarea'); ta.value=currentPasswordForDialog;
      document.body.appendChild(ta); ta.select(); document.execCommand('copy'); document.body.removeChild(ta);
      const btn=document.getElementById('copyPasswordBtn'); const orig=btn.innerHTML;
      btn.innerHTML='<span></span> Copied!'; setTimeout(()=>btn.innerHTML=orig,1200);
    });
  }

  function formatTimestamp(ts) {
    if (!ts) return 'N/A';
    return new Date(parseInt(ts)).toLocaleString('en-US',{year:'numeric',month:'short',day:'numeric',hour:'2-digit',minute:'2-digit'});
  }

  function escapeHtml(str) {
    if (!str) return '';
    return str.replace(/[&<>]/g, m=>m==='&'?'&amp;':m==='<'?'&lt;':'&gt;');
  }

  document.getElementById('copyPasswordBtn').addEventListener('click', copyPasswordFromDialog);
  document.getElementById('hideDialogBtn').addEventListener('click', hidePasswordDialog);
  document.getElementById('passwordDialog').addEventListener('click', (e)=>{ if(e.target===document.getElementById('passwordDialog')) hidePasswordDialog(); });
  document.addEventListener('keydown',(e)=>{ if(e.key==='Escape') hidePasswordDialog(); });

  window.showPasswordDialog=showPasswordDialog;
  window.hidePasswordDialog=hidePasswordDialog;
  window.copyPasswordFromDialog=copyPasswordFromDialog;
  window.blockUser=blockUser;
  window.unblockUser=unblockUser;
  window.deleteUser=deleteUser;
  window.filterUsers=filterUsers;
</script>
</body>
</html>
