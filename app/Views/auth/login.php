<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Masuk / Daftar — Dapurmelia_</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,600&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/auth.css">
</head>
<body>
<div class="left-panel">
  <div class="lp-content">
    <a href="<?= BASE_URL ?>/" class="lp-logo">Dapur<em>melia</em>_</a>
    <div class="lp-badge">✦  Member Area</div>
    <h2 class="lp-title">Pesan <em>Lebih Mudah,</em><br>Lebih Cepat</h2>
    <p class="lp-sub">Daftar akun sekarang dan nikmati kemudahan memesan snack &amp; catering premium Dapurmelia_ kapan saja.</p>
    <div class="lp-features">
      <div class="lp-feat"><div class="lp-feat-icon">🛒</div>Riwayat pesanan tersimpan otomatis</div>
      <div class="lp-feat"><div class="lp-feat-icon">⚡</div>Pesan ulang favoritmu lebih cepat</div>
      <div class="lp-feat"><div class="lp-feat-icon">🔔</div>Notifikasi status pesanan real-time</div>
      <div class="lp-feat"><div class="lp-feat-icon">🎁</div>Promo eksklusif untuk member</div>
    </div>
  </div>
  <div class="lp-bottom">
    <p class="lp-quote">Dibuat segar setiap hari — dari dapur dengan cinta untuk momen spesial Anda.</p>
  </div>
</div>
<div class="right-panel">
  <a href="<?= BASE_URL ?>/" class="back-link">← Kembali ke Beranda</a>
  <div class="auth-tabs">
    <button class="auth-tab on" onclick="switchTab('login')">Masuk</button>
    <button class="auth-tab" onclick="switchTab('register')">Daftar</button>
  </div>

  <!-- LOGIN -->
  <div class="auth-form show" id="form-login">
    <div class="form-head"><h2>Selamat Datang</h2><p>Masuk ke akun Dapurmelia_ kamu</p></div>
    <div class="admin-hint">💡 <strong>Admin?</strong> Gunakan email <strong>admin@dapurmelia.com</strong> untuk masuk ke Dashboard Admin. Pelanggan biasa diarahkan ke halaman pesanan member.</div>
    <div id="toast-login" class="success-toast">✓ Berhasil masuk! Mengalihkan...</div>
    <div class="fgroup">
      <label class="flabel">Email / No. HP</label>
      <input id="l-email" type="text" class="finput" placeholder="email@contoh.com">
      <div class="error-msg" id="l-email-err">Masukkan email atau nomor HP yang valid</div>
    </div>
    <div class="fgroup">
      <label class="flabel">Password</label>
      <input id="l-pass" type="password" class="finput" placeholder="••••••••">
      <div class="error-msg" id="l-pass-err">Password minimal 6 karakter</div>
    </div>
    <button class="fsub" onclick="doLogin()">Masuk →</button>
    <div class="divider">atau masuk dengan</div>
    <div class="soc-btns">
      <a class="soc-btn">🔵  Google</a>
      <a class="soc-btn">📘  Facebook</a>
    </div>
    <p class="switch-link">Belum punya akun? <a onclick="switchTab('register')">Daftar sekarang</a></p>
  </div>

  <!-- REGISTER -->
  <div class="auth-form" id="form-register">
    <div class="form-head"><h2>Buat Akun Baru</h2><p>Bergabung dan nikmati kemudahan memesan</p></div>
    <div id="toast-register" class="success-toast">✓ Akun berhasil dibuat! Silakan login dengan akun Anda.</div>
    <div class="frow2">
      <div class="fgroup"><label class="flabel">Nama Depan</label><input id="r-fname" type="text" class="finput" placeholder="Budi"></div>
      <div class="fgroup"><label class="flabel">Nama Belakang</label><input id="r-lname" type="text" class="finput" placeholder="Santoso"></div>
    </div>
    <div class="fgroup">
      <label class="flabel">Email</label>
      <input id="r-email" type="email" class="finput" placeholder="email@contoh.com">
      <div class="error-msg" id="r-email-err">Masukkan email yang valid</div>
    </div>
    <div class="fgroup"><label class="flabel">No. WhatsApp</label><input id="r-hp" type="tel" class="finput" placeholder="08xx-xxxx-xxxx"></div>
    <div class="fgroup">
      <label class="flabel">Password</label>
      <input id="r-pass" type="password" class="finput" placeholder="Minimal 8 karakter">
      <div class="error-msg" id="r-pass-err">Password minimal 8 karakter</div>
    </div>
    <button class="fsub" onclick="doRegister()">Buat Akun →</button>
    <p class="switch-link">Sudah punya akun? <a onclick="switchTab('login')">Masuk di sini</a></p>
  </div>
</div>

<script>
/* ============================================================
   login.html — Terhubung ke api_auth.php (database XAMPP)
   ============================================================ */

function switchTab(t) {
  document.querySelectorAll('.auth-tab').forEach(x=>x.classList.remove('on'));
  document.querySelectorAll('.auth-form').forEach(x=>x.classList.remove('show'));
  if(t==='login'){
    document.querySelectorAll('.auth-tab')[0].classList.add('on');
    document.getElementById('form-login').classList.add('show');
  } else {
    document.querySelectorAll('.auth-tab')[1].classList.add('on');
    document.getElementById('form-register').classList.add('show');
  }
}

/* ── Tampilkan pesan error inline ── */
function showErr(elId, msgElId, msg) {
  const el = document.getElementById(elId);
  const me = document.getElementById(msgElId);
  if(el){ el.classList.add('error'); }
  if(me){ me.textContent = msg; me.style.display='block'; }
}
function clearErrs(ids) {
  ids.forEach(([elId, msgElId]) => {
    const el = document.getElementById(elId);
    const me = document.getElementById(msgElId);
    if(el) el.classList.remove('error');
    if(me) me.style.display='none';
  });
}

/* ── Disable / enable tombol saat loading ── */
function setBtn(btnEl, loading) {
  btnEl.disabled = loading;
  btnEl.textContent = loading ? 'Memproses...' : btnEl.dataset.label;
}

/* ── LOGIN ── */
async function doLogin() {
  const email = document.getElementById('l-email').value.trim();
  const pass  = document.getElementById('l-pass').value;
  const btn   = document.querySelector('#form-login .fsub');

  clearErrs([['l-email','l-email-err'],['l-pass','l-pass-err']]);

  let ok = true;
  if(!email){ showErr('l-email','l-email-err','Masukkan email yang valid'); ok=false; }
  if(pass.length<6){ showErr('l-pass','l-pass-err','Password minimal 6 karakter'); ok=false; }
  if(!ok) return;

  if(!btn.dataset.label) btn.dataset.label = btn.textContent;
  setBtn(btn, true);

  try {
    const res  = await fetch('?page=auth&action=doLogin', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ email, password:pass })
    });
    const data = await res.json();

    if(data.success) {
      /* Simpan ke sessionStorage agar nama tampil di member/dashboard */
      sessionStorage.setItem('member_name',  data.nama);
      sessionStorage.setItem('member_email', data.email);
      sessionStorage.setItem('member_role',  data.role);

      const toast = document.getElementById('toast-login');
      toast.style.display='block';
      setTimeout(()=>{ window.location.href = data.redirect; }, 1200);
    } else {
      showErr('l-email','l-email-err', data.message || 'Login gagal');
      setBtn(btn, false);
    }
  } catch(e) {
    showErr('l-email','l-email-err','Tidak bisa terhubung ke server. Pastikan XAMPP aktif.');
    setBtn(btn, false);
  }
}

/* ── REGISTER ── */
async function doRegister() {
  const fname = document.getElementById('r-fname').value.trim();
  const lname = document.getElementById('r-lname').value.trim();
  const email = document.getElementById('r-email').value.trim();
  const hp    = document.getElementById('r-hp').value.trim();
  const pass  = document.getElementById('r-pass').value;
  const btn   = document.querySelector('#form-register .fsub');

  clearErrs([['r-email','r-email-err'],['r-pass','r-pass-err']]);

  let ok = true;
  if(!email||!email.includes('@')){ showErr('r-email','r-email-err','Masukkan email yang valid'); ok=false; }
  if(pass.length<8){ showErr('r-pass','r-pass-err','Password minimal 8 karakter'); ok=false; }
  if(!ok) return;

  if(!btn.dataset.label) btn.dataset.label = btn.textContent;
  setBtn(btn, true);

  try {
    const res  = await fetch('?page=auth&action=doRegister', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ fname, lname, email, hp, password:pass })
    });
    const data = await res.json();

    if(data.success) {
      // Tampilkan notifikasi sukses, lalu pindah ke tab login
      const toast = document.getElementById('toast-register');
      toast.textContent = data.message || '✓ Akun berhasil dibuat! Silakan login.';
      toast.style.display='block';
      const registeredEmail = document.getElementById('r-email').value;
      setTimeout(() => {
        toast.style.display = 'none';
        switchTab('login');
        // Isi email otomatis agar mudah login
        const lEmail = document.getElementById('l-email');
        if (lEmail) lEmail.value = registeredEmail;
      }, 2000);
      setBtn(btn, false);
    } else {
      showErr('r-email','r-email-err', data.message || 'Pendaftaran gagal');
      setBtn(btn, false);
    }
  } catch(e) {
    showErr('r-email','r-email-err','Tidak bisa terhubung ke server. Pastikan XAMPP aktif.');
    setBtn(btn, false);
  }
}
</script>
</body>
</html>