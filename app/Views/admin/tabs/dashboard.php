    <div class="view show" id="view-dashboard">

      <!-- Stat cards -->
      <div class="stat-grid">
        <div class="sc"><div class="sc-top"><div class="sc-icon ic-gold">💰</div></div><div class="sc-val" id="stat-pendapatan">Rp 0</div><div class="sc-lbl">Total Pendapatan (Selesai)</div></div>
        <div class="sc"><div class="sc-top"><div class="sc-icon ic-blue">🛒</div></div><div class="sc-val" id="stat-pesanan-baru">0</div><div class="sc-lbl">Pesanan Baru</div></div>
        <div class="sc"><div class="sc-top"><div class="sc-icon ic-green">👥</div></div><div class="sc-val" id="stat-member">0</div><div class="sc-lbl">Total Pelanggan</div></div>
        <div class="sc"><div class="sc-top"><div class="sc-icon ic-orange">📦</div></div><div class="sc-val" id="stat-total-pesanan">0</div><div class="sc-lbl">Total Pesanan (Selesai)</div></div>
      </div>

      <!-- Revenue line + donut -->
      <div class="rev-grid" style="margin-bottom:1.1rem;">
        <div class="card">
          <div class="card-hd">
            <div><div class="card-title">Pendapatan 7 Hari Terakhir</div><div class="card-sub">Tren harian dalam ribuan rupiah</div></div>
            <div class="chip-group">
              <button class="chip on" onclick="switchWeek(this)">Minggu Ini</button>
              <button class="chip" onclick="switchMonth(this)">30 Hari</button>
            </div>
          </div>
          <div class="chart-canvas-wrap" style="height:200px;">
            <canvas id="lineChart"></canvas>
          </div>
        </div>
        <div class="card">
          <div class="card-hd">
            <div><div class="card-title">Kategori Penjualan</div><div class="card-sub">Berdasarkan total pendapatan (Laporan Pendapatan)</div></div>
          </div>
          <div class="donut-row">
            <div class="donut-wrap">
              <div style="width:130px;height:130px;position:relative;">
                <canvas id="donutChart" width="130" height="130"></canvas>
                <div class="donut-center"><div class="dc-val">100%</div><div class="dc-lbl">Total</div></div>
              </div>
            </div>
            <div class="leg-list" id="dashKategoriLegend">
              <div style="color:var(--muted);font-size:0.78rem;">Memuat...</div>
            </div>
          </div>
        </div>
      </div>

      <!-- Recent orders -->
      <div class="two-col">
        <div class="card">
          <div class="card-hd">
            <div><div class="card-title">Pesanan Terbaru</div><div class="card-sub">5 pesanan terakhir masuk</div></div>
            <button class="btn-sm" onclick="setView('orders')">Lihat Semua →</button>
          </div>
          <table>
            <thead><tr><th>ID</th><th>Pelanggan</th><th>Produk</th><th>Total</th><th>Status</th></tr></thead>
            <tbody id="recent-orders-tbody">
              <tr><td colspan="5" style="text-align:center;padding:1rem;">Memuat...</td></tr>
            </tbody>
          </table>
        </div>
        <div class="card">
          <div class="card-hd"><div><div class="card-title">Produk Terlaris</div><div class="card-sub">Minggu ini</div></div></div>
          <div class="prod-list">
            <div class="prod-row"><div class="prod-rank">1</div><img class="prod-img" src="https://i.pinimg.com/1200x/5e/3d/51/5e3d51622e72eb06fbb39fe89a769086.jpg" alt=""><div style="flex:1"><div class="prod-name">Risol Mayo</div><div class="prod-units">340 pcs terjual</div><div class="prod-bar"><div class="prod-bar-fill" style="width:100%;background:var(--gold);"></div></div></div><div class="prod-rev">Rp 1,19Jt</div></div>
            <div class="prod-row"><div class="prod-rank">2</div><img class="prod-img" src="https://i.pinimg.com/1200x/f6/2b/67/f62b67ac108f21e3dcf1780318d1c8a6.jpg" alt=""><div style="flex:1"><div class="prod-name">Nasi Kotak</div><div class="prod-units">87 box terjual</div><div class="prod-bar"><div class="prod-bar-fill" style="width:75%;background:var(--brown);"></div></div></div><div class="prod-rev">Rp 3,04Jt</div></div>
            <div class="prod-row"><div class="prod-rank">3</div><img class="prod-img" src="https://i.pinimg.com/1200x/37/63/7f/37637f82ed9ecb1843e4873b48a7409f.jpg" alt=""><div style="flex:1"><div class="prod-name">Sosis Solo</div><div class="prod-units">210 pcs terjual</div><div class="prod-bar"><div class="prod-bar-fill" style="width:62%;background:var(--sand);"></div></div></div><div class="prod-rev">Rp 840rb</div></div>
            <div class="prod-row"><div class="prod-rank">4</div><img class="prod-img" src="https://i.pinimg.com/736x/ce/c0/a9/cec0a9788d0e997e27414f6b1ad1b305.jpg" alt=""><div style="flex:1"><div class="prod-name">Donat Premium</div><div class="prod-units">158 pcs terjual</div><div class="prod-bar"><div class="prod-bar-fill" style="width:46%;"></div></div></div><div class="prod-rev">Rp 948rb</div></div>
          </div>
        </div>
      </div>
    </div><!-- end view-dashboard -->
