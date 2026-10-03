<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dapurmelia_ — Snack & Catering Premium</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,600&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/home.css">
</head>
<body>

<!-- ═══════════════════════════════════════════════
     NAVIGATION
═══════════════════════════════════════════════ -->
<nav id="nav">
  <a href="#" class="nav-logo" onclick="showPage('home');return false;">Dapur<em>melia</em>_</a>
  <ul class="nav-links">
    <li><a href="#home"    data-page="home"    onclick="showPage('home');return false;">Home</a></li>
    <li><a href="#menu"    data-page="menu"    onclick="showPage('menu');return false;">Menu</a></li>
    <li><a href="#about"   data-page="about"   onclick="showPage('about');return false;">Tentang</a></li>
    <li><a href="#contact" data-page="contact" onclick="showPage('contact');return false;">Kontak</a></li>
  </ul>
  <div style="display:flex;align-items:center;gap:0.8rem;">
    <a href="?page=auth&action=login" class="nav-btn nav-btn-login">⟶ Login</a>
    <a href="?page=auth&action=login" class="nav-btn">✦ Pesan Sekarang</a>
  </div>
  <button class="hamburger" onclick="openMob()" aria-label="Menu">
    <span></span><span></span><span></span>
  </button>
</nav>

<!-- Mobile nav overlay -->
<div class="mob-nav" id="mobNav">
  <button class="mob-close" onclick="closeMob()">✕</button>
  <a href="#home"    onclick="goPage('home')">Home</a>
  <a href="#menu"    onclick="goPage('menu')">Menu</a>
  <a href="#about"   onclick="goPage('about')">Tentang</a>
  <a href="#contact" onclick="goPage('contact')">Kontak</a>
  <a href="?page=auth&action=login" class="btn-gold" style="font-size:1rem;padding:0.8rem 2rem;background:transparent;color:var(--dark);border:1.5px solid var(--gold-dark);margin-bottom:0.5rem;">⟶ Login</a>
  <a href="?page=auth&action=login" class="btn-gold" style="font-size:1rem;padding:0.8rem 2rem;">✦ Pesan Sekarang</a>
</div>


<!-- ═══════════════════════════════════════════════
     PAGE: HOME
═══════════════════════════════════════════════ -->
<div class="page" id="page-home">

  <!-- Hero -->
  <section class="hero" style="padding:0;">
    <div class="hero-left">
      <div class="h-eyebrow">Handcrafted · Fresh · Premium</div>
      <h1 class="h-title">Snack &amp; Catering<br><em>Untuk Setiap</em><br>Momen Spesial</h1>
      <p class="h-sub">Dibuat segar setiap hari dengan bahan pilihan — dari snack tradisional hingga paket catering lengkap untuk hajatan Anda.</p>
      <div class="h-btns">
        <a href="?page=auth&action=login" class="btn-gold">✦ &nbsp;Pesan Sekarang</a>
        <a href="#menu" class="btn-ghost-w" onclick="showPage('menu');return false;">Lihat Menu &nbsp;↓</a>
      </div>
      <div class="h-stats">
        <div><div class="hs-num">500+</div><div class="hs-lbl">Pelanggan</div></div>
        <div><div class="hs-num">30+</div><div class="hs-lbl">Varian Menu</div></div>
        <div><div class="hs-num">5★</div><div class="hs-lbl">Rating</div></div>
        <div><div class="hs-num">3 Thn</div><div class="hs-lbl">Pengalaman</div></div>
      </div>
    </div>
    <div class="hero-right">
      <div class="hero-bg"></div>
      <div class="hero-overlay"></div>
    </div>
  </section>

  <!-- Marquee -->
  <div class="marquee-wrap">
    <div class="marquee-track">
      <span class="mi">Risol Mayo Spesial</span><span class="ms">✦</span>
      <span class="mi">Onde-onde Kacang</span><span class="ms">✦</span>
      <span class="mi">Sosis Solo Ayam</span><span class="ms">✦</span>
      <span class="mi">Nasi Kotak Premium</span><span class="ms">✦</span>
      <span class="mi">Mochi Matcha</span><span class="ms">✦</span>
      <span class="mi">Catering Hajatan</span><span class="ms">✦</span>
      <span class="mi">Snack Box Arisan</span><span class="ms">✦</span>
      <span class="mi">Kue Lapis Legit</span><span class="ms">✦</span>
      <span class="mi">Paket 50 Orang</span><span class="ms">✦</span>
      <span class="mi">Risol Mayo Spesial</span><span class="ms">✦</span>
      <span class="mi">Onde-onde Kacang</span><span class="ms">✦</span>
      <span class="mi">Sosis Solo Ayam</span><span class="ms">✦</span>
      <span class="mi">Nasi Kotak Premium</span><span class="ms">✦</span>
      <span class="mi">Mochi Matcha</span><span class="ms">✦</span>
      <span class="mi">Catering Hajatan</span><span class="ms">✦</span>
      <span class="mi">Snack Box Arisan</span><span class="ms">✦</span>
      <span class="mi">Kue Lapis Legit</span><span class="ms">✦</span>
      <span class="mi">Paket 50 Orang</span><span class="ms">✦</span>
    </div>
  </div>

  <!-- Stats bar -->
  <div class="stats-bar">
    <div class="rv"><div class="sb-num">500+</div><div class="sb-lbl">Pelanggan Puas</div></div>
    <div class="rv"><div class="sb-num">30+</div><div class="sb-lbl">Varian Menu</div></div>
    <div class="rv"><div class="sb-num">5★</div><div class="sb-lbl">Rating Rata-rata</div></div>
    <div class="rv"><div class="sb-num">3 Thn</div><div class="sb-lbl">Pengalaman</div></div>
  </div>

  <!-- Testimonials - Landing Page -->
  <div class="testi-wrap">
    <div class="testi-hd rv">
      <div class="slabel">Testimoni</div>
      <h2 class="stitle">Kata <em>Mereka</em></h2>
      <p class="ssub" style="margin:0 auto;">Kepuasan pelanggan adalah prioritas utama kami.</p>
    </div>

    <?php if (!empty($testimoni)):
      $total     = count($testimoni);
      $sumRating = array_sum(array_column($testimoni, 'rating'));
      $avgRating = $total > 0 ? $sumRating / $total : 0;
      $dist = [5=>0,4=>0,3=>0,2=>0,1=>0];
      foreach ($testimoni as $t) { $dist[(int)$t['rating']]++; }
      $fullStars = floor($avgRating);
    ?>

    <!-- Overview rating -->
    <div class="testi-overview">
      <div class="testi-ov-left">
        <div class="testi-big-score"><?= number_format($avgRating,1) ?></div>
        <div class="testi-big-stars">
          <?php for($i=1;$i<=5;$i++) echo $i<=$fullStars ? '★' : '☆'; ?>
        </div>
        <div class="testi-big-total"><?= $total ?> ulasan</div>
      </div>
      <div class="testi-ov-bars">
        <?php for($s=5;$s>=1;$s--):
          $pct = $total > 0 ? round(($dist[$s]/$total)*100) : 0;
        ?>
        <div class="testi-bar-row">
          <span><?= $s ?></span>
          <div class="testi-bar-track"><div class="testi-bar-fill" style="width:<?= $pct ?>%"></div></div>
          <span class="testi-bar-count"><?= $dist[$s] ?></span>
        </div>
        <?php endfor; ?>
      </div>
    </div>

    <!-- Filter bintang — selalu tampil semua 1-5 -->
    <div class="testi-filter-bar">
      <button class="testi-filter-btn tf-active" data-r="0" onclick="filterTestiHome(0)">Semua</button>
      <button class="testi-filter-btn" data-r="5" onclick="filterTestiHome(5)">★ 5</button>
      <button class="testi-filter-btn" data-r="4" onclick="filterTestiHome(4)">★ 4</button>
      <button class="testi-filter-btn" data-r="3" onclick="filterTestiHome(3)">★ 3</button>
      <button class="testi-filter-btn" data-r="2" onclick="filterTestiHome(2)">★ 2</button>
      <button class="testi-filter-btn" data-r="1" onclick="filterTestiHome(1)">★ 1</button>
    </div>

    <!-- Kartu ulasan -->
    <div id="testi-home-list">
      <?php foreach ($testimoni as $idx => $t):
        $rating   = (int)$t['rating'];
        $nama     = htmlspecialchars($t['nama_user'] ?? 'Pelanggan');
        $initials = strtoupper(implode('', array_map(fn($w)=>$w[0], array_slice(explode(' ',$nama),0,2))));
        $pesan    = htmlspecialchars($t['pesan']);
        $tgl      = date('j F Y', strtotime($t['created_at']));
        $bintang  = str_repeat('★',$rating).str_repeat('☆',5-$rating);
      ?>
      <div class="testi-card-item" data-rating="<?= $rating ?>" data-idx="<?= $idx ?>">
        <div class="testi-card-head">
          <div class="testi-avatar"><?= $initials ?></div>
          <div class="testi-card-meta">
            <div class="testi-card-name"><?= $nama ?></div>
            <div class="testi-card-order">Pelanggan Dapurmelia_</div>
          </div>
        </div>
        <div class="testi-card-stars">
          <?= $bintang ?>
          <span class="testi-card-date"><?= $tgl ?></span>
        </div>
        <div class="testi-card-text"><?= $pesan ?></div>
      </div>
      <?php endforeach; ?>
    </div>

    <!-- Tombol lihat semua -->
    <?php if ($total > 3): ?>
    <div class="testi-show-more-wrap">
      <button class="testi-show-more" id="testi-toggle-btn" onclick="testiToggleAll()">
        Lihat Semua Ulasan &#9660;
      </button>
    </div>
    <?php endif; ?>

    <?php else: ?>
      <div class="testi-empty">Belum ada ulasan saat ini.</div>
    <?php endif; ?>
  </div>

  <script>
  (function(){
    var SHOW_INIT = 3;
    var activeFilter = 0;
    var isExpanded = false;

    function getCards() {
      return Array.from(document.querySelectorAll('#testi-home-list .testi-card-item'));
    }

    function applyView() {
      var cards = getCards();
      var visibleCount = 0;
      var totalMatch = 0;

      cards.forEach(function(c) {
        var r = parseInt(c.dataset.rating);
        var matchFilter = (activeFilter === 0 || r === activeFilter);
        if (!matchFilter) { c.style.display = 'none'; return; }
        totalMatch++;
        visibleCount++;
        c.style.display = (!isExpanded && visibleCount > SHOW_INIT) ? 'none' : '';
      });

      // Tampilkan pesan kosong jika tidak ada ulasan yang cocok
      var emptyEl = document.getElementById('testi-no-result');
      if (!emptyEl) {
        emptyEl = document.createElement('div');
        emptyEl.id = 'testi-no-result';
        emptyEl.className = 'testi-empty';
        emptyEl.textContent = 'Tidak ada ulasan untuk bintang ini.';
        document.getElementById('testi-home-list').after(emptyEl);
      }
      emptyEl.style.display = totalMatch === 0 ? '' : 'none';

      // Update tombol lihat semua
      var btn  = document.getElementById('testi-toggle-btn');
      var wrap = document.querySelector('.testi-show-more-wrap');
      if (wrap) {
        wrap.style.display = (totalMatch > SHOW_INIT) ? '' : 'none';
        if (btn) btn.innerHTML = isExpanded ? 'Sembunyikan &#9650;' : 'Lihat Semua Ulasan &#9660;';
      }
    }

    window.filterTestiHome = function(r) {
      activeFilter = r;
      isExpanded = false;
      document.querySelectorAll('.testi-filter-btn').forEach(function(b){
        b.classList.toggle('tf-active', parseInt(b.dataset.r) === r);
      });
      applyView();
    };

    window.testiToggleAll = function() {
      isExpanded = !isExpanded;
      applyView();
    };

    // Inisialisasi: sembunyikan card index >= 3
    applyView();
  })();
  </script>


    <!-- Gallery preview -->
  <div class="gallery-wrap">
    <div class="gallery-hd">
      <div><div class="slabel">Galeri</div><h2 class="stitle">Momen <em>Lezat</em></h2></div>
      <a href="https://www.instagram.com/dapurmelia_" class="btn-ghost-w" target="_blank" style="font-size:0.73rem;padding:0.6rem 1.2rem;">Lihat Instagram →</a>
    </div>
    <div class="ggrid rv">
      <div class="gitem"><img src="https://i.pinimg.com/1200x/30/60/5a/30605a5ebd32c77defc2888c548b42ed.jpg" alt="Gallery" loading="lazy"><div class="goverlay"><span>+</span></div></div>
      <div class="gitem"><img src="https://i.pinimg.com/736x/f3/f3/dd/f3f3dd272f022fba73165336292d00a7.jpg" alt="Gallery" loading="lazy"><div class="goverlay"><span>+</span></div></div>
      <div class="gitem"><img src="https://images.unsplash.com/photo-1578985545062-69928b1d9587?w=400&auto=format&fit=crop&q=75" alt="Gallery" loading="lazy"><div class="goverlay"><span>+</span></div></div>
      <div class="gitem"><img src="https://i.pinimg.com/736x/55/26/37/5526373031ba9a01af330e692bea42c5.jpg" alt="Gallery" loading="lazy"><div class="goverlay"><span>+</span></div></div>
    </div>
  </div>

  <!-- Footer -->
  <footer>
    <div class="ftop">
      <div>
        <a href="#" class="flogo" onclick="showPage('home');return false;">Dapur<em>melia</em>_</a>
        <p class="ftagline">Snack &amp; catering premium rumahan — dibuat segar dengan cinta untuk setiap momen Anda.</p>
        <div class="fsocials">
          <a href="https://www.instagram.com/dapurmelia_" class="fsoc" target="_blank">IG</a>
          <a href="https://wa.me/6281234567890" class="fsoc" target="_blank">WA</a>
          <a href="#" class="fsoc">TT</a>
        </div>
      </div>
      <div>
        <div class="fctitle">Menu</div>
        <ul class="flinks">
          <li><a onclick="showPage('menu')">Snack Tradisional</a></li>
          <li><a onclick="showPage('menu')">Nasi Kotak</a></li>
          <li><a onclick="showPage('menu')">Paket Catering</a></li>
          <li><a onclick="showPage('menu')">Dessert &amp; Kue</a></li>
        </ul>
      </div>
      <div>
        <div class="fctitle">Navigasi</div>
        <ul class="flinks">
          <li><a onclick="showPage('home')">Beranda</a></li>
          <li><a onclick="showPage('menu')">Menu</a></li>
          <li><a onclick="showPage('about')">Tentang Kami</a></li>
          <li><a onclick="showPage('contact')">Kontak &amp; Pesan</a></li>
        </ul>
      </div>
      <div>
        <div class="fctitle">Kontak</div>
        <ul class="flinks">
          <li><a href="https://wa.me/6281234567890" target="_blank">+62 812-3456-7890</a></li>
          <li><a href="https://www.instagram.com/dapurmelia_" target="_blank">@dapurmelia_</a></li>
          <li><a onclick="showPage('contact')">Surabaya, Jawa Timur</a></li>
          <li><a>Senin–Sabtu 07.00–18.00</a></li>
        </ul>
      </div>
    </div>
    <div class="fbot">
      <p class="fcopy">© 2025 <a href="#">Dapurmelia_</a>. Hak cipta dilindungi.</p>
      <p class="flove">Dibuat dengan <em>♥</em> untuk Surabaya</p>
    </div>
  </footer>

</div><!-- end page-home -->


<!-- ═══════════════════════════════════════════════
     PAGE: MENU
═══════════════════════════════════════════════ -->
<div class="page" id="page-menu">
  <div class="page-inner">
    <div class="menu-top rv">
      <div>
        <div class="slabel">Menu Unggulan</div>
        <h2 class="stitle">Pilihan <em>Terbaik</em> Kami</h2>
      </div>
      <div class="ftabs">
        <button class="ftab on" onclick="fmenu('all',this)">Semua</button>
        <button class="ftab" onclick="fmenu('snack',this)">Snack</button>
        <button class="ftab" onclick="fmenu('catering',this)">Catering</button>
        <button class="ftab" onclick="fmenu('dessert',this)">Dessert</button>
      </div>
    </div>
    <div class="mgrid" id="mgrid">
      <div class="mcard rv" data-c="snack"><div class="mcard-img"><img src="https://i.pinimg.com/1200x/5e/3d/51/5e3d51622e72eb06fbb39fe89a769086.jpg" alt="Risol Mayo" loading="lazy"><div class="mbadge">Bestseller</div></div><div class="mcard-body"><div class="mcat">Snack Tradisional</div><div class="mname">Risol Mayo Spesial</div><div class="mdesc">Kulit tipis renyah, isian creamy mayo dengan wortel &amp; daging sapi pilihan.</div><div class="mfoot"><div class="mprice">Rp 3.500 <span>/pcs</span></div><a href="?page=auth&action=login" class="mbtn">Pesan</a></div></div></div>
      <div class="mcard rv" data-c="snack"><div class="mcard-img"><img src="https://i.pinimg.com/736x/9c/3a/0f/9c3a0f6cfdae3d8d2bbe13f6e4231c49.jpg" alt="Onde-onde" loading="lazy"></div><div class="mcard-body"><div class="mcat">Snack Tradisional</div><div class="mname">Onde-onde Kacang Hijau</div><div class="mdesc">Bulat lembut berbalut wijen, isian kacang hijau manis resep turun-temurun.</div><div class="mfoot"><div class="mprice">Rp 3.000 <span>/pcs</span></div><a href="?page=auth&action=login" class="mbtn">Pesan</a></div></div></div>
      <div class="mcard rv" data-c="snack"><div class="mcard-img"><img src="https://i.pinimg.com/1200x/37/63/7f/37637f82ed9ecb1843e4873b48a7409f.jpg" alt="Sosis Solo" loading="lazy"><div class="mbadge">Favorit</div></div><div class="mcard-body"><div class="mcat">Snack Tradisional</div><div class="mname">Sosis Solo Ayam</div><div class="mdesc">Dadar tipis halus, isian ragout ayam berbumbu rempah yang khas.</div><div class="mfoot"><div class="mprice">Rp 4.000 <span>/pcs</span></div><a href="?page=auth&action=login" class="mbtn">Pesan</a></div></div></div>
      <div class="mcard rv" data-c="catering"><div class="mcard-img"><img src="https://i.pinimg.com/1200x/f6/2b/67/f62b67ac108f21e3dcf1780318d1c8a6.jpg" alt="Nasi Kotak" loading="lazy"><div class="mbadge">Popular</div></div><div class="mcard-body"><div class="mcat">Nasi Kotak</div><div class="mname">Nasi Kotak Premium</div><div class="mdesc">Nasi putih pulen + lauk lengkap, dikemas elegan untuk acara &amp; hajatan.</div><div class="mfoot"><div class="mprice">Rp 35.000 <span>/box</span></div><a href="?page=auth&action=login" class="mbtn">Pesan</a></div></div></div>
      <div class="mcard rv" data-c="catering"><div class="mcard-img"><img src="https://i.pinimg.com/1200x/c0/fe/92/c0fe92c0990dc62eb773d4cddd9d406f.jpg" alt="Snack Box" loading="lazy"></div><div class="mcard-body"><div class="mcat">Catering</div><div class="mname">Snack Box Arisan</div><div class="mdesc">Kombinasi 4–5 snack pilihan dalam box premium, cocok untuk berbagai acara.</div><div class="mfoot"><div class="mprice">Rp 25.000 <span>/box</span></div><a href="?page=auth&action=login" class="mbtn">Pesan</a></div></div></div>
      <div class="mcard rv" data-c="catering"><div class="mcard-img"><img src="https://i.pinimg.com/1200x/8f/53/bf/8f53bf58d1d2935bf50381bd20189413.jpg" alt="Catering" loading="lazy"><div class="mbadge">Paket Hemat</div></div><div class="mcard-body"><div class="mcat">Catering</div><div class="mname">Paket Catering 50 Orang</div><div class="mdesc">Paket lengkap 50 porsi: nasi, 3 lauk, sambal, &amp; kerupuk. Siap antar.</div><div class="mfoot"><div class="mprice">Rp 1.500.000 <span>/paket</span></div><a href="?page=auth&action=login" class="mbtn">Pesan</a></div></div></div>
      <div class="mcard rv" data-c="dessert"><div class="mcard-img"><img src="https://i.pinimg.com/736x/ce/c0/a9/cec0a9788d0e997e27414f6b1ad1b305.jpg" alt="Donat" loading="lazy"><div class="mbadge">New!</div></div><div class="mcard-body"><div class="mcat">Dessert</div><div class="mname">Donat Premium</div><div class="mdesc">Kenyal lembut dengan varian: red velvet, matcha, &amp; taro cream.</div><div class="mfoot"><div class="mprice">Rp 6.000 <span>/pcs</span></div><a href="?page=auth&action=login" class="mbtn">Pesan</a></div></div></div>
      <div class="mcard rv" data-c="dessert"><div class="mcard-img"><img src="https://i.pinimg.com/736x/0a/84/81/0a8481457164672038116e4d325f16c2.jpg" alt="Kue Lapis" loading="lazy"></div><div class="mcard-body"><div class="mcat">Dessert</div><div class="mname">Kue Lapis Legit</div><div class="mdesc">Tekstur lembut berlapis sempurna, dibuat dengan mentega pilihan premium.</div><div class="mfoot"><div class="mprice">Rp 8.000 <span>/slice</span></div><a href="?page=auth&action=login" class="mbtn">Pesan</a></div></div></div>
      <div class="mcard rv" data-c="dessert"><div class="mcard-img"><img src="https://i.pinimg.com/1200x/3c/50/f4/3c50f40040ff51e3ad12bc36ae1ea275.jpg" alt="Pastel" loading="lazy"></div><div class="mcard-body"><div class="mcat">Snack</div><div class="mname">Pastel Bihun</div><div class="mdesc">Kulit renyah gurih dengan isian bihun sayuran dan telur puyuh.</div><div class="mfoot"><div class="mprice">Rp 3.500 <span>/pcs</span></div><a href="?page=auth&action=login" class="mbtn">Pesan</a></div></div></div>
      <div class="mcard rv" data-c="dessert"><div class="mcard-img"><img src="https://i.pinimg.com/1200x/1d/bd/0c/1dbd0cedea4cb0c8ced60935e9826616.jpg" alt="Hantaran" loading="lazy"></div><div class="mcard-body"><div class="mcat">Dessert</div><div class="mname">Paket Hantaran</div><div class="mdesc">Kue hantaran premium dalam kemasan cantik, cocok untuk lamaran &amp; pernikahan.</div><div class="mfoot"><div class="mprice">Rp 80.000 <span>/box</span></div><a href="?page=auth&action=login" class="mbtn">Pesan</a></div></div></div>
    </div>
  </div>
  <footer>
    <div class="ftop">
      <div>
        <a class="flogo" onclick="showPage('home')">Dapur<em>melia</em>_</a>
        <p class="ftagline">Snack &amp; catering premium rumahan — dibuat segar dengan cinta.</p>
        <div class="fsocials">
          <a href="https://www.instagram.com/dapurmelia_" class="fsoc" target="_blank">IG</a>
          <a href="https://wa.me/6281234567890" class="fsoc" target="_blank">WA</a>
        </div>
      </div>
      <div><div class="fctitle">Navigasi</div><ul class="flinks"><li><a onclick="showPage('home')">Beranda</a></li><li><a onclick="showPage('about')">Tentang Kami</a></li><li><a onclick="showPage('contact')">Kontak &amp; Pesan</a></li></ul></div>
    </div>
    <div class="fbot"><p class="fcopy">© 2025 Dapurmelia_</p><p class="flove">Dibuat dengan <em>♥</em> untuk Surabaya</p></div>
  </footer>
</div><!-- end page-menu -->


<!-- ═══════════════════════════════════════════════
     PAGE: ABOUT
═══════════════════════════════════════════════ -->
<div class="page" id="page-about">
  <div class="page-inner">
    <div class="about-grid">
      <div class="about-imgs rv">
        <img class="about-main" src="https://i.pinimg.com/736x/a2/32/e5/a232e5c9b6a116971a21f82fc8afeac5.jpg" alt="Dapur Melia">
        <img class="about-accent" src="https://i.pinimg.com/736x/80/1c/06/801c0611a898d95b37b8cde415641dd8.jpg" alt="Detail">
        <div class="about-pill"><div class="ap-num">100%</div><div class="ap-txt">Fresh &amp;<br>Homemade</div></div>
      </div>
      <div class="rv">
        <div class="slabel">Tentang Kami</div>
        <h2 class="stitle">Dibuat dengan <em>Cinta</em> dari Dapur Sendiri</h2>
        <div class="about-body">
          <p>Dapurmelia_ lahir dari kecintaan mendalam terhadap kuliner tradisional Indonesia. Berawal dari pesanan kecil di sekitar lingkungan, kini kami hadir melayani berbagai acara — arisan, hajatan, ulang tahun, hingga meeting kantor.</p>
          <p>Setiap produk dibuat fresh sesuai pesanan, menggunakan bahan-bahan pilihan tanpa pengawet. Kami percaya makanan yang lezat harus dimulai dari proses yang jujur dan bahan yang berkualitas.</p>
        </div>
        <div class="vals">
          <div class="val"><div class="val-icon">🌾</div><div class="val-text"><strong>Bahan Segar &amp; Berkualitas</strong><span>Dipilih setiap hari dari pasar lokal terpercaya</span></div></div>
          <div class="val"><div class="val-icon">👩‍🍳</div><div class="val-text"><strong>Dibuat Sendiri, Penuh Perhatian</strong><span>Setiap sajian adalah karya tangan yang tulus</span></div></div>
          <div class="val"><div class="val-icon">📦</div><div class="val-text"><strong>Kemasan Elegan &amp; Higienis</strong><span>Presentasi memukau untuk setiap momen</span></div></div>
        </div>
        <div style="margin-top:2rem;">
          <a href="?page=auth&action=login" class="btn-gold">✦ Pesan Sekarang →</a>
        </div>
      </div>
    </div>
  </div>
  <div class="stats-bar" style="margin-top:0;">
    <div class="rv"><div class="sb-num">500+</div><div class="sb-lbl">Pelanggan Puas</div></div>
    <div class="rv"><div class="sb-num">30+</div><div class="sb-lbl">Varian Menu</div></div>
    <div class="rv"><div class="sb-num">5★</div><div class="sb-lbl">Rating Rata-rata</div></div>
    <div class="rv"><div class="sb-num">3 Thn</div><div class="sb-lbl">Pengalaman</div></div>
  </div>
  <footer>
    <div class="ftop">
      <div><a class="flogo" onclick="showPage('home')">Dapur<em>melia</em>_</a><p class="ftagline">Snack &amp; catering premium rumahan.</p></div>
      <div><div class="fctitle">Navigasi</div><ul class="flinks"><li><a onclick="showPage('home')">Beranda</a></li><li><a onclick="showPage('menu')">Menu</a></li><li><a onclick="showPage('contact')">Kontak</a></li></ul></div>
    </div>
    <div class="fbot"><p class="fcopy">© 2025 Dapurmelia_</p><p class="flove">Dibuat dengan <em>♥</em> untuk Surabaya</p></div>
  </footer>
</div><!-- end page-about -->


<!-- ═══════════════════════════════════════════════
     PAGE: CONTACT
═══════════════════════════════════════════════ -->
<div class="page" id="page-contact">
  <div class="page-inner">
    <div class="contact-grid">
      <div class="rv">
        <div class="slabel">Hubungi Kami</div>
        <h2 class="stitle">Siap Melayani <em>Acara</em> Anda</h2>
        <p class="contact-info">Hubungi kami langsung atau buat akun untuk memesan secara online dengan mudah. Kami siap membantu mewujudkan momen spesial Anda.</p>
        <div class="clist">
          <div class="citem"><div class="cicon">🎵</div><div><div class="clabel">TikTok</div><div class="cval">@dapurmelia_</div></div></div>
          <div class="citem"><div class="cicon">📸</div><div><div class="clabel">Instagram</div><div class="cval">@dapurmelia_</div></div></div>
          <div class="citem"><div class="cicon">📍</div><div><div class="clabel">Lokasi</div><div class="cval">Surabaya, Jawa Timur</div></div></div>
          <div class="citem"><div class="cicon">🕐</div><div><div class="clabel">Jam Operasional</div><div class="cval">Senin–Sabtu, 07.00–18.00 WIB</div></div></div>
        </div>
      </div>
      <div class="cform rv" style="display:flex;flex-direction:column;justify-content:center;align-items:center;text-align:center;gap:1.5rem;padding:3rem 2rem;">
        <div style="font-size:3rem;">🛒</div>
        <div>
          <div style="font-family:var(--serif);font-size:1.5rem;font-weight:700;color:var(--dark);margin-bottom:0.5rem;">Siap Memesan?</div>
          <p style="color:var(--muted);font-size:0.9rem;line-height:1.6;max-width:280px;margin:0 auto;">
            Masuk atau daftar akun untuk mulai memesan menu favorit kamu langsung dari dapur kami.
          </p>
        </div>
        <a href="?page=auth&action=login" style="display:inline-block;background:var(--gold-dark);color:#fff;font-family:var(--sans);font-size:0.85rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;padding:1rem 2.5rem;border-radius:4px;text-decoration:none;transition:all 0.3s;box-shadow:0 4px 16px rgba(168,132,58,0.35);">
          ✦ &nbsp;Pesan Sekarang
        </a>
        <div style="display:flex;gap:1rem;flex-wrap:wrap;justify-content:center;">
          <a href="https://www.tiktok.com/@dapurmelia_" target="_blank" style="display:flex;align-items:center;gap:0.4rem;color:var(--gold-dark);font-size:0.82rem;text-decoration:none;border:1px solid var(--tan);padding:0.5rem 1rem;border-radius:4px;">
            🎵 TikTok
          </a>
          <a href="https://www.instagram.com/dapurmelia_" target="_blank" style="display:flex;align-items:center;gap:0.4rem;color:var(--gold-dark);font-size:0.82rem;text-decoration:none;border:1px solid var(--tan);padding:0.5rem 1rem;border-radius:4px;">
            📸 Instagram
          </a>
        </div>
      </div>
    </div>

    <div class="map-wrap rv">
      <div class="map-header">
        <span>📍</span>
        <div>
          <div class="map-title">Lokasi Dapurmelia_</div>
          <div class="map-sub">Surabaya, Jawa Timur — Area pengiriman: Surabaya, Sidoarjo, Gresik</div>
        </div>
      </div>
      <iframe class="map-frame"
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d253804.38620848127!2d112.60356!3d-7.2574719!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fbf8381ac47f%3A0x37588a27c3b04ac3!2sSurabaya%2C%20East%20Java!5e0!3m2!1sid!2sid!4v1699999999999"
        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
        title="Lokasi Dapurmelia Surabaya">
      </iframe>
    </div>
  </div>
  <footer>
    <div class="ftop">
      <div><a class="flogo" onclick="showPage('home')">Dapur<em>melia</em>_</a><p class="ftagline">Snack &amp; catering premium rumahan.</p></div>
      <div><div class="fctitle">Navigasi</div><ul class="flinks"><li><a onclick="showPage('home')">Beranda</a></li><li><a onclick="showPage('menu')">Menu</a></li><li><a onclick="showPage('about')">Tentang</a></li></ul></div>
    </div>
    <div class="fbot"><p class="fcopy">© 2025 Dapurmelia_</p><p class="flove">Dibuat dengan <em>♥</em> untuk Surabaya</p></div>
  </footer>
</div><!-- end page-contact -->


<script src="<?= BASE_URL ?>/js/app.js"></script>

</body>
</html>