    <div class="view" id="view-orders">
      <div class="str">
        <div class="stitle">Semua Pesanan</div>
        <div style="display:flex;gap:0.6rem;flex-wrap:wrap;">
          <div class="search-box"><span>🔍</span><input type="text" id="orders-search" placeholder="Cari pesanan..." oninput="filterPesanan()"></div>
        </div>
      </div>
      <div class="card">
        <table>
          <thead><tr><th>ID</th><th>Pelanggan</th><th>Produk</th><th>Total</th><th>Tanggal</th><th>Status</th><th>Aksi</th></tr></thead>
          <tbody id="orders-tbody">
            <tr><td colspan="7" style="text-align:center;padding:2rem;">Memuat data...</td></tr>
          </tbody>
        </table>
      </div>
    </div><!-- end view-orders -->


