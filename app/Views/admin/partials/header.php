<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Admin — Dapurmelia_</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>
  <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/admin.css">
</head>
<body>

<!-- ══ SIDEBAR ══════════════════════════════════════════════ -->
<aside class="sidebar">
  <div class="sb-logo">
    <a href="<?= BASE_URL ?>/">Dapur<em>melia</em>_</a>
    <span>Admin Dashboard</span>
  </div>
  <div class="sb-section">Utama</div>
  <ul class="sb-nav">
    <li><a onclick="setView('dashboard')"><span class="sb-icon">🏠</span>Dashboard</a></li>
    <li><a onclick="setView('orders')"><span class="sb-icon">🛒</span>Pesanan <span class="sb-badge">7</span></a></li>
    <li><a onclick="setView('pendapatan')"><span class="sb-icon">📊</span>Laporan Pendapatan</a></li>
    <li><a onclick="setView('menu')"><span class="sb-icon">🍱</span>Kelola Menu</a></li>
    <li><a onclick="setView('customers')"><span class="sb-icon">👥</span>Pelanggan</a></li>
    <li><a onclick="setView('testimoni')"><span class="sb-icon">⭐</span>Testimoni</a></li>
  </ul>
  <div class="sb-section">Lainnya</div>
  <ul class="sb-nav">
    <li><a href="<?= BASE_URL ?>/"><span class="sb-icon">🏪</span>Lihat Toko</a></li>
  </ul>
  <div class="sb-user">
    <div class="sb-av">M</div>
    <div style="flex:1;">
      <div class="sb-uname">Melia</div>
      <div class="sb-urole">Owner / Admin</div>
    </div>
  </div>
  <div style="padding:0.8rem 1rem 1.2rem;">
    <a href="?page=auth&action=logoutDirect" style="display:flex;align-items:center;justify-content:center;gap:0.5rem;width:100%;padding:0.6rem 1rem;background:rgba(231,76,60,0.12);color:#e74c3c;border:1px solid rgba(231,76,60,0.25);border-radius:5px;font-size:0.78rem;font-weight:600;text-decoration:none;letter-spacing:0.05em;transition:all 0.2s;" onmouseover="this.style.background='rgba(231,76,60,0.22)'" onmouseout="this.style.background='rgba(231,76,60,0.12)'">
      ⎋ &nbsp;Logout
    </a>
  </div>
</aside>

<!-- ══ MAIN ════════════════════════════════════════════════ -->
<div class="main">
  <div class="topbar">
    <div class="topbar-l">
      <h1 id="topbar-title">Dashboard</h1>
      <p id="topbar-sub">Ringkasan aktivitas toko hari ini</p>
    </div>
    <div class="topbar-r">
      <div class="tb-btn notif">🔔</div>
      <a href="<?= BASE_URL ?>/" style="text-decoration:none;"><div class="tb-btn">🏪</div></a>
      <div class="tb-av">M</div>
    </div>
  </div>

  <div class="content">

