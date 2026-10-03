<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Akun Saya — Dapurmelia_</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,600&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/member.css">
</head>
<body>

<!-- ══ SIDEBAR ══════════════════════════════════════════════ -->
<aside class="sidebar">
  <div class="sb-logo">
    <a href="<?= BASE_URL ?>/">Dapur<em>melia</em>_</a>
    <span>Member Area</span>
  </div>
  <div class="sb-section">Menu</div>
  <ul class="sb-nav">
    <li><a class="on" onclick="sv('beranda')"><span class="si">🏠</span>Beranda</a></li>
    <li><a onclick="sv('pesan')"><span class="si">🛒</span>Buat Pesanan <span class="sb-badge gold" id="cartBadgeSb" style="display:none;">0</span></a></li>
    <li><a onclick="sv('riwayat')"><span class="si">📋</span>Riwayat Pesanan <span class="sb-badge" id="notifBadge" style="display:none;">0</span></a></li>
    <li><a onclick="sv('profil')"><span class="si">👤</span>Profil Saya</a></li>
  </ul>
  <div class="sb-section">Info</div>
  <ul class="sb-nav">
    <li><a onclick="sv('katalog')" style="cursor:pointer;"><span class="si">🍱</span>Lihat Katalog</a></li>
  </ul>
  <div class="sb-user">
    <div class="sb-av" id="sbAv">?</div>
    <div>
      <div class="sb-uname" id="sbName">Pelanggan</div>
      <div class="sb-urole">Member</div>
    </div>
  </div>
</aside>

<!-- ══ MAIN ════════════════════════════════════════════════ -->
<div class="main">
  <div class="topbar">
    <div>
      <div class="tb-title" id="tbTitle">Beranda</div>
      <div class="tb-sub"  id="tbSub">Selamat datang kembali</div>
    </div>
    <div class="tb-right">
      <div class="tb-cart" onclick="sv('pesan')">
        🛒 Keranjang <span class="cart-count" id="cartCountTop">0</span>
      </div>
      <a href="?page=auth&action=logoutDirect" class="tb-home">⏋ Logout</a>
    </div>
  </div>

  <div class="content">
