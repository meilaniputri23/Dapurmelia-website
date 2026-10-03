    <!-- ══════════════════════════════════════════════════
         VIEW: KATALOG MENU
    ══════════════════════════════════════════════════ -->
    <div class="view" id="view-katalog">
      <div class="katalog-hero">
        <div class="katalog-hero-inner">
          <div class="katalog-hero-tag">✦ Menu Pilihan</div>
          <h2 class="katalog-hero-title">Katalog Dapurmelia_</h2>
          <p class="katalog-hero-sub">Temukan jajanan & hidangan lezat untuk acara spesial Anda</p>
        </div>
      </div>

      <div class="katalog-filter-bar">
        <button class="katalog-filter-btn kat-active" data-cat="semua" onclick="renderKatalog('semua')">Semua</button>
        <button class="katalog-filter-btn" data-cat="snack" onclick="renderKatalog('snack')">🧆 Snack</button>
        <button class="katalog-filter-btn" data-cat="catering" onclick="renderKatalog('catering')">🍱 Catering</button>
        <button class="katalog-filter-btn" data-cat="dessert" onclick="renderKatalog('dessert')">🍰 Dessert</button>
        <button class="katalog-filter-btn" data-cat="nasi kotak" onclick="renderKatalog('nasi kotak')">🍚 Nasi Kotak</button>
      </div>

      <div class="katalog-grid" id="katalog-grid">
        <div class="empty"><span>🍱</span><p>Memuat katalog...</p></div>
      </div>

      <div class="katalog-cta-strip">
        <div class="katalog-cta-text">Tertarik? Langsung buat pesanan sekarang!</div>
        <button class="katalog-cta-btn" onclick="sv('pesan')">🛒 Buat Pesanan →</button>
      </div>
    </div><!-- end view-katalog -->
