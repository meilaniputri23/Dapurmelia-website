    <div class="view" id="view-pendapatan">

      <!-- Summary boxes -->
      <div class="stat-grid" style="margin-bottom:1.4rem;">
        <div class="sc"><div class="sc-top"><div class="sc-icon ic-gold">💰</div><span class="sc-trend up" id="lap-trend-bulan">↑ 0%</span></div><div class="sc-val" id="lap-total-bulan">Rp 0</div><div class="sc-lbl">Pendapatan Bulan Ini</div></div>
        <div class="sc"><div class="sc-top"><div class="sc-icon ic-blue">📦</div></div><div class="sc-val" id="lap-total-transaksi">0</div><div class="sc-lbl">Total Transaksi</div></div>
        <div class="sc"><div class="sc-top"><div class="sc-icon ic-green">🧾</div></div><div class="sc-val" id="lap-rata-rata">Rp 0</div><div class="sc-lbl">Rata-rata per Pesanan</div></div>
        <div class="sc"><div class="sc-top"><div class="sc-icon ic-orange">🏆</div></div><div class="sc-val" id="lap-tertinggi">Rp 0</div><div class="sc-lbl">Pendapatan Tertinggi/Hari</div></div>
      </div>

      <!-- 1) Line chart — pendapatan harian bulan ini -->
      <div class="card" style="margin-bottom:1.2rem;">
        <div class="card-hd">
          <div>
            <div class="card-title">📈 Pendapatan Harian — <span id="lap-bulan-label">Bulan Ini</span></div>
            <div class="card-sub">Grafik tren pendapatan setiap hari dalam satu bulan (status Selesai)</div>
          </div>
        </div>
        <div class="chart-canvas-wrap" style="height:260px;">
          <canvas id="dailyLineChart"></canvas>
        </div>
        <div class="rev-summary">
          <div class="rs-box"><div class="rs-val" id="lap-total-bulan-2">Rp 0</div><div class="rs-lbl">Total Bulan Ini</div><div class="rs-diff" style="color:var(--green)" id="lap-trend-bulan-2">↑ 0%</div></div>
          <div class="rs-box"><div class="rs-val" id="lap-rata-hari">Rp 0</div><div class="rs-lbl">Rata-rata / Hari</div></div>
          <div class="rs-box"><div class="rs-val" id="lap-hari-ramai">-</div><div class="rs-lbl">Hari Paling Ramai</div><div class="rs-diff" style="color:var(--muted)" id="lap-hari-ramai-total">Rp 0</div></div>
        </div>
      </div>

      <!-- 2) Bar bulanan + 3) Kategori tabel -->
      <div class="rev-grid" style="margin-bottom:1.2rem;">
        <div class="card">
          <div class="card-hd">
            <div>
              <div class="card-title">📊 Pendapatan per Bulan</div>
              <div class="card-sub">Perbandingan pendapatan 6 bulan terakhir</div>
            </div>
          </div>
          <div class="chart-canvas-wrap" style="height:220px;">
            <canvas id="monthlyBarChart"></canvas>
          </div>
        </div>
        <div class="card">
          <div class="card-hd">
            <div>
              <div class="card-title">🍩 Kontribusi per Kategori</div>
              <div class="card-sub">Pendapatan berdasarkan jenis menu</div>
            </div>
          </div>
          <!-- Donut kecil + tabel rapi berdampingan -->
          <div style="display:flex;align-items:center;gap:1.5rem;flex-wrap:wrap;">
            <div style="position:relative;width:130px;height:130px;flex-shrink:0;">
              <canvas id="donutBig" width="130" height="130"></canvas>
            </div>
            <div style="flex:1;min-width:140px;display:flex;flex-direction:column;gap:0.55rem;" id="lap-kategori-legend">
              <div style="color:var(--muted);font-size:0.8rem;">Memuat data...</div>
            </div>
          </div>
          <div style="margin-top:0.8rem;text-align:right;font-size:0.8rem;color:var(--muted);">Total: <b id="lap-donut-total" style="color:var(--dark);">Rp 0</b></div>
        </div>
      </div>

      <!-- 4) Top produk (dari DB) -->
      <div class="card">
        <div class="card-hd">
          <div>
            <div class="card-title">🏆 Produk Terlaris — Pendapatan</div>
            <div class="card-sub">Top produk berdasarkan omzet (status Selesai)</div>
          </div>
        </div>
        <div class="chart-canvas-wrap" style="height:220px;">
          <canvas id="hbarChart"></canvas>
        </div>
      </div>

    </div><!-- end view-pendapatan -->

