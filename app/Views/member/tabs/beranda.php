    <!-- ══════════════════════════════════════════════════
         VIEW: BERANDA
    ══════════════════════════════════════════════════ -->
    <div class="view show" id="view-beranda">
      <div class="welcome-banner">
        <div>
          <div class="wb-tag">Selamat Datang Kembali ✦</div>
          <div class="wb-name" id="wbName">Pelanggan</div>
          <div class="wb-sub">Siap memesan untuk acara spesial hari ini?</div>
        </div>
        <button class="wb-cta" onclick="sv('pesan')">✦ &nbsp;Buat Pesanan Baru</button>
      </div>
      <div class="qstats">
        <div class="qs"><div class="qs-ic ic-b">🛒</div><div><div class="qs-val" id="statTotal">0</div><div class="qs-lbl">Total Pesanan</div></div></div>
        <div class="qs"><div class="qs-ic ic-gr">✅</div><div><div class="qs-val" id="statSelesai">0</div><div class="qs-lbl">Pesanan Selesai</div></div></div>
        <div class="qs"><div class="qs-ic ic-o">⏳</div><div><div class="qs-val" id="statProses">0</div><div class="qs-lbl">Sedang Diproses</div></div></div>
        <div class="qs"><div class="qs-ic ic-g">💰</div><div><div class="qs-val" id="statBelanja">Rp 0</div><div class="qs-lbl">Total Belanja</div></div></div>
      </div>
      <div class="str">
        <div class="stitle">Pesanan Terbaru</div>
        <button class="btn-sm btn-sm-g" onclick="sv('riwayat')">Lihat Semua →</button>
      </div>
      <div class="orders-list" id="berandaOrders">
        <div class="empty"><span>🛒</span><p>Belum ada pesanan.</p><button class="btn-sm" onclick="sv('pesan')">Buat Pesanan Pertama →</button></div>
      </div>
      <div class="promo-banner">
        <div><div class="pb-tag">🎁 Promo Member</div><div class="pb-title">Gratis ongkir untuk pesanan ≥ 50 pcs total!</div></div>
        <button class="pb-btn" onclick="sv('pesan')">Pesan Sekarang</button>
      </div>
    </div><!-- end beranda -->
