    <!-- ══════════════════════════════════════════════════
         VIEW: BUAT PESANAN  (katalog + keranjang)
    ══════════════════════════════════════════════════ -->
    <div class="view" id="view-pesan">

      <!-- STEP 1 & 2: Katalog + Keranjang -->
      <div id="step-catalog">
        <div class="pesan-layout">

          <!-- Katalog -->
          <div class="catalog-wrap">
            <div class="catalog-header">
              <div class="catalog-title">Pilih Menu</div>
              <div class="cat-tabs">
                <button class="cat-tab on" onclick="filterCat('semua',this)">Semua</button>
                <button class="cat-tab" onclick="filterCat('snack',this)">Snack</button>
                <button class="cat-tab" onclick="filterCat('catering',this)">Catering</button>
                <button class="cat-tab" onclick="filterCat('dessert',this)">Dessert</button>
              </div>
            </div>
            <div class="catalog-grid" id="catalogGrid">
              <!-- Dirender via JS -->
            </div>
          </div>

          <!-- Keranjang -->
          <div class="cart-panel">
            <div class="cart-hd">
              <div class="cart-hd-title">🛒 Keranjang <span class="cart-count-badge" id="cartBadge">0</span></div>
              <button class="cart-clear" onclick="clearCart()">Kosongkan</button>
            </div>
            <div id="cartBody">
              <div class="cart-empty"><span>🧺</span><p>Keranjang masih kosong.<br>Pilih menu di sebelah kiri.</p></div>
            </div>
            <div class="cart-summary" id="cartSummary" style="display:none;">
              <div class="cs-row"><span>Subtotal (<span id="totalQty">0</span> item)</span><span id="subtotalVal">Rp 0</span></div>
              <div class="cs-row"><span>Ongkos Kirim <span id="ongkirTag"></span></span><span id="ongkirVal">Rp 10.000</span></div>
              <div class="cs-row grand"><span>Total Pembayaran</span><span id="grandTotalVal">Rp 0</span></div>
              <button class="checkout-btn" id="checkoutBtn" onclick="goToCheckout()">
                Lanjut ke Checkout →
              </button>
            </div>
          </div>

        </div>
      </div><!-- end step-catalog -->

      <!-- STEP 3 & 4: Detail + Konfirmasi -->
      <div id="step-checkout" style="display:none;">
        <div class="flow-wrap">
          <div class="flow-steps">
            <div class="fs on" id="fs2"><span class="fs-num">2</span>Detail Pesanan</div>
            <div class="fs"    id="fs3"><span class="fs-num">3</span>Konfirmasi</div>
          </div>

          <!-- Panel: Detail -->
          <div class="flow-panel show" id="panel-detail">
            <h3 style="font-family:var(--serif);font-size:1.05rem;color:var(--dark);margin-bottom:0.35rem;">Detail &amp; Pengiriman</h3>
            <p style="font-size:0.78rem;color:var(--muted);margin-bottom:1.3rem;">Lengkapi informasi acara dan pengiriman untuk semua item dalam keranjang.</p>

            <!-- Ringkasan keranjang mini -->
            <div style="background:var(--beige);border:1px solid var(--tan);border-radius:5px;padding:0.85rem 1rem;margin-bottom:1.3rem;" id="checkoutCartMini"></div>

            <div class="frow2">
              <div class="fgroup">
                <label class="flabel">Jenis Acara</label>
                <select id="f-acara" class="fselect">
                  <option value="">Pilih jenis acara...</option>
                  <option>Arisan / Pertemuan</option><option>Hajatan / Syukuran</option>
                  <option>Ulang Tahun</option><option>Meeting / Kantor</option>
                  <option>Sekolah / Kampus</option><option>Lainnya</option>
                </select>
                <div class="err-msg" id="e-acara">Pilih jenis acara</div>
              </div>
              <div class="fgroup">
                <label class="flabel">Tanggal Acara</label>
                <input id="f-tgl" type="date" class="finput">
                <div class="err-msg" id="e-tgl">Pilih tanggal acara</div>
              </div>
            </div>
            <div class="frow2">
              <div class="fgroup">
                <label class="flabel">Waktu Pengiriman</label>
                <select id="f-waktu" class="fselect">
                  <option value="">Pilih waktu...</option>
                  <option>07.00 – 09.00 WIB</option><option>09.00 – 11.00 WIB</option>
                  <option>11.00 – 13.00 WIB</option><option>13.00 – 15.00 WIB</option>
                  <option>15.00 – 17.00 WIB</option>
                </select>
                <div class="err-msg" id="e-waktu">Pilih waktu pengiriman</div>
              </div>
              <div class="fgroup">
                <label class="flabel">Metode Pembayaran</label>
                <select id="f-bayar" class="fselect" disabled>
                  <option selected>Bayar di Tempat (COD)</option>
                </select>
                <div class="err-msg" id="e-bayar">Pilih metode pembayaran</div>
              </div>
            </div>
            <div class="fgroup">
              <label class="flabel">Alamat Pengiriman</label>
              <input id="f-alamat" type="text" class="finput" placeholder="Jl. Nama Jalan No. XX, Kelurahan, Kecamatan, Kota">
              <div class="err-msg" id="e-alamat">Masukkan alamat lengkap</div>
            </div>
            <div class="fgroup">
              <label class="flabel">Catatan Tambahan (opsional)</label>
              <textarea id="f-note" class="ftarea" placeholder="Contoh: tidak pakai sambal, minta dibungkus terpisah per menu, dll..."></textarea>
            </div>
            <div class="flow-nav">
              <button class="flow-back" onclick="backToCatalog()">← Kembali ke Keranjang</button>
              <button class="flow-next" onclick="goConfirm()">Lanjut: Konfirmasi →</button>
            </div>
          </div>

          <!-- Panel: Konfirmasi -->
          <div class="flow-panel" id="panel-confirm">
            <h3 style="font-family:var(--serif);font-size:1.05rem;color:var(--dark);margin-bottom:0.35rem;">Konfirmasi Pesanan</h3>
            <p style="font-size:0.78rem;color:var(--muted);margin-bottom:1.3rem;">Periksa kembali seluruh pesanan sebelum dikonfirmasi.</p>

            <!-- Tabel item -->
            <div id="confirmItemsTable"></div>

            <!-- Detail pengiriman -->
            <div class="confirm-box" id="confirmDetailBox"></div>

            <div style="background:rgba(201,169,110,0.1);border:1px solid rgba(201,169,110,0.3);border-radius:5px;padding:0.85rem 1rem;margin-bottom:1rem;font-size:0.77rem;color:var(--brown);line-height:1.7;">
              <strong style="color:var(--gold-dark);">📌 Informasi Penting:</strong><br>
              Pesanan langsung masuk ke dapur kami setelah Anda konfirmasi. Admin akan memproses dan mengubah status pesanan. Pembayaran dilakukan sesuai metode yang dipilih.
            </div>

            <div class="flow-nav">
              <button class="flow-back" onclick="backToDetail()">← Ubah Detail</button>
              <button class="flow-next" id="submitBtn" onclick="submitOrder()">✦ &nbsp;Konfirmasi &amp; Kirim Pesanan</button>
            </div>
          </div>
        </div>
      </div><!-- end step-checkout -->

    </div><!-- end view-pesan -->
