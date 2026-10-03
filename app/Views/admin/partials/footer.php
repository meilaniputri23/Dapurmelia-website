
  </div><!-- end content -->
</div><!-- end main -->


<script>
/* ─── VIEW SWITCHER ─────────────────────────────────────── */
const TITLES = {
  dashboard:   ['Dashboard',           'Ringkasan aktivitas toko hari ini'],
  pendapatan:  ['Laporan Pendapatan',  'Analitik & diagram lengkap pendapatan toko'],
  orders:      ['Semua Pesanan',       'Kelola dan pantau pesanan masuk'],
  menu:        ['Kelola Menu',         'Tambah, edit, dan hapus produk'],
  customers:   ['Data Pelanggan',      'Kelola informasi pelanggan'],
  testimoni:   ['Kelola Testimoni',    'Pantau & kelola ulasan pelanggan'],
};
let chartsInited = false;
let customerCache = [];

function setView(id) {
  document.querySelectorAll('.view').forEach(v => v.classList.remove('show'));
  document.querySelectorAll('.sb-nav a').forEach(a => a.classList.remove('on'));
  document.getElementById('view-' + id).classList.add('show');
  document.querySelectorAll('.sb-nav a').forEach(a => {
    if (a.getAttribute('onclick') && a.getAttribute('onclick').includes("'"+id+"'")) a.classList.add('on');
  });
  if (TITLES[id]) {
    document.getElementById('topbar-title').textContent = TITLES[id][0];
    document.getElementById('topbar-sub').textContent   = TITLES[id][1];
  }
  if (id === 'pendapatan' && !chartsInited) { initPendapatanCharts(); chartsInited = true; }
  if (id === 'customers' && customerCache.length === 0) { loadCustomers(); }
  if (id === 'testimoni') { loadTestimoniAdmin(); }
  window.scrollTo({ top: 0, behavior: 'smooth' });
}

/* ─── CHART.JS GLOBAL DEFAULTS ──────────────────────────── */
Chart.defaults.font.family = "'Poppins', sans-serif";
Chart.defaults.font.size   = 11;
Chart.defaults.color       = '#7A6652';

const GOLD    = '#C9A96E';
const GOLD_D  = '#A8843A';
const BROWN   = '#7A5C3C';
const SAND    = '#D1BC9E';
const TAN     = '#E6D9C8';
const DARK    = '#2E1D0E';
const GREEN   = '#27ae60';
const BLUE    = '#2980b9';
const ORANGE  = '#e67e22';

/* ─── SUMBER DATA TUNGGAL: Laporan Pendapatan ───────────────
   Diagram di Dashboard (Beranda) TIDAK pakai data dummy lagi —
   semuanya ditarik dari endpoint yang sama dengan tab
   "Laporan Pendapatan" (?page=dashboard&action=laporan).        */
let laporanCache = null;
async function fetchLaporanCached() {
  if (laporanCache) return laporanCache;
  try {
    const res  = await fetch('?page=dashboard&action=laporan');
    const json = await res.json();
    if (json.success) laporanCache = json.data;
  } catch (e) { console.error('Gagal memuat data laporan pendapatan:', e); }
  return laporanCache;
}
function buildDailyArray(harian) {
  const now = new Date();
  const lastDay = new Date(now.getFullYear(), now.getMonth() + 1, 0).getDate();
  const map = {};
  (harian || []).forEach(r => map[r.tgl] = Number(r.total));
  const labels = [], values = [];
  for (let i = 1; i <= lastDay; i++) { labels.push(i + ''); values.push(map[i] || 0); }
  return { labels, values };
}

let dashLineChartObj  = null;
let dashDonutChartObj = null;

async function initBerandaCharts() {
  const data   = await fetchLaporanCached();
  const harian = buildDailyArray(data ? data.harian : []);
  window.__dashHarian = harian; // dipakai ulang oleh toggle chip "30 Hari" / "Minggu Ini"

  const last7Labels = harian.labels.slice(-7);
  const last7Values = harian.values.slice(-7);

  const ctx = document.getElementById('lineChart').getContext('2d');
  const grad = ctx.createLinearGradient(0,0,0,200);
  grad.addColorStop(0,'rgba(201,169,110,0.25)');
  grad.addColorStop(1,'rgba(201,169,110,0)');
  dashLineChartObj = new Chart(ctx, {
    type:'line',
    data:{
      labels: last7Labels.length ? last7Labels : ['-'],
      datasets:[{
        label:'Pendapatan',
        data: last7Values.length ? last7Values : [0],
        borderColor:GOLD_D, backgroundColor:grad,
        borderWidth:2.5, tension:0.4, fill:true,
        pointBackgroundColor:GOLD_D, pointRadius:4, pointHoverRadius:6,
      }]
    },
    options:{
      responsive:true, maintainAspectRatio:false,
      plugins:{legend:{display:false},tooltip:{callbacks:{label:v=>'Rp '+Number(v.raw).toLocaleString('id-ID')}}},
      scales:{
        x:{grid:{display:false},border:{display:false}},
        y:{grid:{color:'rgba(230,217,200,0.5)'},border:{display:false},ticks:{callback:v=>'Rp'+(v/1000)+'k'}},
      }
    }
  });

  // Donut kategori — dari laporan pendapatan (SUM omzet per kategori, status Selesai)
  const kategori      = (data && data.kategori) || [];
  const totalKategori  = kategori.reduce((s, r) => s + Number(r.total), 0);
  const colors = [GOLD, BROWN, SAND, TAN, '#b8a07a'];

  const donutCtx = document.getElementById('donutChart').getContext('2d');
  dashDonutChartObj = new Chart(donutCtx, {
    type:'doughnut',
    data:{
      labels: kategori.map(r => r.kategori),
      datasets:[{ data: kategori.map(r => Number(r.total)), backgroundColor: kategori.map((r,i)=>colors[i % colors.length]), borderWidth:0, hoverOffset:6 }]
    },
    options:{
      responsive:false, cutout:'72%',
      plugins:{legend:{display:false},tooltip:{callbacks:{label:v=>v.label+': Rp '+Number(v.raw).toLocaleString('id-ID')}}},
    }
  });

  const legend = document.getElementById('dashKategoriLegend');
  if (kategori.length === 0) {
    legend.innerHTML = '<div style="color:var(--muted);font-size:0.78rem;">Belum ada data.</div>';
  } else {
    legend.innerHTML = kategori.map((r, i) => {
      const pct = totalKategori > 0 ? Math.round((r.total / totalKategori) * 100) : 0;
      return `<div class="leg-item"><div class="leg-dot" style="background:${colors[i % colors.length]};"></div>${r.kategori}<div class="leg-pct">${pct}%</div></div>`;
    }).join('');
  }
}
initBerandaCharts();

/* ─── PENDAPATAN CHARTS (lazy init) ─────────────────────── */
function initPendapatanCharts(){

  /* 1. Daily Line Chart */
  const dailyCtx = document.getElementById('dailyLineChart').getContext('2d');
  const dailyGrad = dailyCtx.createLinearGradient(0,0,0,260);
  dailyGrad.addColorStop(0,'rgba(201,169,110,0.3)');
  dailyGrad.addColorStop(1,'rgba(201,169,110,0)');
  window.dailyLineChartObj = new Chart(dailyCtx,{
    type:'line',
    data:{labels:[],datasets:[{
      label:'Pendapatan Harian',
      data:[],borderColor:GOLD_D,backgroundColor:dailyGrad,
      borderWidth:2.5,tension:0.4,fill:true,
      pointBackgroundColor:GOLD_D,pointRadius:3,pointHoverRadius:6,
    }]},
    options:{
      responsive:true,maintainAspectRatio:false,
      plugins:{legend:{display:false},tooltip:{callbacks:{label:v=>'Rp '+Number(v.raw).toLocaleString('id-ID')}}},
      scales:{
        x:{grid:{display:false},border:{display:false},title:{display:true,text:'Tanggal',color:BROWN}},
        y:{grid:{color:'rgba(230,217,200,0.5)'},border:{display:false},ticks:{callback:v=>'Rp'+(v/1000)+'k'}},
      }
    }
  });

  /* 2. Monthly Bar Chart */
  window.monthlyBarChartObj = new Chart(document.getElementById('monthlyBarChart').getContext('2d'),{
    type:'bar',
    data:{labels:[],datasets:[{
      label:'Pendapatan',
      data:[],
      backgroundColor:GOLD,
      borderRadius:5,borderSkipped:false,
    }]},
    options:{
      responsive:true,maintainAspectRatio:false,
      plugins:{
        legend:{display:false},
        tooltip:{callbacks:{label:v=>'Rp '+Number(v.raw).toLocaleString('id-ID')}},
      },
      scales:{
        x:{grid:{display:false},border:{display:false}},
        y:{grid:{color:'rgba(230,217,200,0.5)'},border:{display:false},ticks:{callback:v=>'Rp'+(v/1000000)+'Jt'}},
      }
    }
  });

  /* 3. Donut Kategori (ukuran kecil, rapi) */
  window.donutBigObj = new Chart(document.getElementById('donutBig').getContext('2d'),{
    type:'doughnut',
    data:{
      labels:[],
      datasets:[{data:[],backgroundColor:[GOLD_D,BROWN,SAND,TAN,'#b8a07a'],borderWidth:0,hoverOffset:6}]
    },
    options:{
      responsive:false,cutout:'70%',
      plugins:{legend:{display:false},tooltip:{callbacks:{label:v=>v.label+': Rp '+Number(v.raw).toLocaleString('id-ID')}}},
    }
  });

  loadLaporan();

  /* 4. Horizontal Bar (top produk dari DB — diisi saat loadLaporan) */
  window.hbarChartObj = new Chart(document.getElementById('hbarChart').getContext('2d'),{
    type:'bar',
    data:{labels:[],datasets:[{label:'Pendapatan',data:[],backgroundColor:[GOLD_D,GOLD,SAND,BROWN,TAN],borderRadius:4,borderSkipped:false}]},
    options:{
      indexAxis:'y',
      responsive:true,maintainAspectRatio:false,
      plugins:{
        legend:{display:false},
        tooltip:{callbacks:{label:v=>'Rp '+Number(v.raw).toLocaleString('id-ID')}},
      },
      scales:{
        x:{grid:{color:'rgba(230,217,200,0.5)'},border:{display:false},ticks:{callback:v=>{if(v>=1000000)return'Rp'+(v/1000000).toFixed(1)+'Jt';if(v>=1000)return'Rp'+(v/1000).toFixed(0)+'rb';return'Rp'+v;}}},
        y:{grid:{display:false},border:{display:false}},
      }
    }
  });
}

/* ─── CHIP toggle untuk mini line chart (data asli dari Laporan Pendapatan) ─── */
function redrawDashLine(labels, values) {
  if (!dashLineChartObj) return;
  dashLineChartObj.data.labels = labels;
  dashLineChartObj.data.datasets[0].data = values;
  dashLineChartObj.update();
}
function switchWeek(btn) {
  document.querySelectorAll('.chip').forEach(c=>c.classList.remove('on'));
  btn.classList.add('on');
  const h = window.__dashHarian || {labels:[],values:[]};
  const labels = h.labels.slice(-7);
  const values = h.values.slice(-7);
  redrawDashLine(labels.length ? labels : ['-'], values.length ? values : [0]);
}
function switchMonth(btn) {
  document.querySelectorAll('.chip').forEach(c=>c.classList.remove('on'));
  btn.classList.add('on');
  const h = window.__dashHarian || {labels:[],values:[]};
  redrawDashLine(h.labels.length ? h.labels : ['-'], h.values.length ? h.values : [0]);
}

/* ─── KONEKSI KE DATABASE (PESANAN & STATS) ────────────────── */
const BADGE_CLASS = {
  'Baru':'s-new', 'Diproses':'s-proses', 'Siap':'s-proses', 'Dikirim':'s-proses',
  'Selesai':'s-selesai', 'Dibatalkan':'s-batal'
};

function formatRupiah(num) {
  return 'Rp ' + Number(num).toLocaleString('id-ID');
}
function formatTanggal(dateStr) {
  const d = new Date(dateStr);
  return d.toLocaleDateString('id-ID', { day:'numeric', month:'short', year:'numeric' });
}

async function loadStats() {
  try {
    const res = await fetch('?page=dashboard&action=stats&_=' + Date.now(), { cache: 'no-store' });
    const data = await res.json();
    if (!data.success) return;
    document.getElementById('stat-pendapatan').textContent   = formatRupiah(data.total_pendapatan);
    document.getElementById('stat-pesanan-baru').textContent = data.pesanan_baru;
    document.getElementById('stat-member').textContent       = data.total_member;
    document.getElementById('stat-total-pesanan').textContent= data.total_pesanan;
  } catch (e) { console.error('Gagal memuat stats:', e); }
}

let pesananCache = [];

async function loadPesanan() {
  try {
    const res = await fetch('?page=dashboard&action=pesanan&_=' + Date.now(), { cache: 'no-store' });
    const data = await res.json();
    if (!data.success) return;
    pesananCache = data.data; // simpan SEMUA pesanan (tanpa limit) untuk pencarian

    renderOrdersTable(pesananCache);

    // Recent orders (dashboard view) - first 5
    const recentTbody = document.getElementById('recent-orders-tbody');
    const recent = pesananCache.slice(0, 5);
    if (recent.length === 0) {
      recentTbody.innerHTML = '<tr><td colspan="5" style="text-align:center;padding:1rem;">Belum ada pesanan.</td></tr>';
    } else {
      recentTbody.innerHTML = recent.map(r => `
        <tr>
          <td>#${r.id}</td>
          <td>${r.nama_pemesan}</td>
          <td>${r.item_list || '-'}</td>
          <td>${formatRupiah(r.total)}</td>
          <td><span class="sbadge ${BADGE_CLASS[r.status] || 's-new'}"><span class="dot-s"></span>${r.status}</span></td>
        </tr>
      `).join('');
    }
  } catch (e) { console.error('Gagal memuat pesanan:', e); }
}

// ── Render tabel "Semua Pesanan" — dipakai oleh loadPesanan() & filterPesanan() ──
function renderOrdersTable(rows) {
  const tbody = document.getElementById('orders-tbody');
  if (rows.length === 0) {
    tbody.innerHTML = '<tr><td colspan="7" style="text-align:center;padding:2rem;">Belum ada pesanan.</td></tr>';
  } else {
    tbody.innerHTML = rows.map(r => `
      <tr>
        <td>#${r.id}</td>
        <td>${r.nama_pemesan}</td>
        <td>${r.item_list || '-'}</td>
        <td>${formatRupiah(r.total)}</td>
        <td>${formatTanggal(r.created_at)}</td>
        <td><span class="sbadge ${BADGE_CLASS[r.status] || 's-new'}"><span class="dot-s"></span>${r.status}</span></td>
        <td>
          <div class="act-wrap">
            <button onclick="lihatDetailPesanan(${r.id})" style="padding:0.3rem 0.7rem;border-radius:6px;border:1px solid var(--gold-dark);background:var(--gold-dark);color:#fff;cursor:pointer;font-size:0.75rem;margin-bottom:0.3rem;width:100%;">🔍 Detail</button>
            ${r.status === 'Dibatalkan'
              ? `<div style="padding:0.3rem 0.5rem;border-radius:6px;border:1px solid #f5c6cb;background:#fff5f5;color:#c0392b;font-size:0.8rem;text-align:center;width:100%;box-sizing:border-box;">🚫 Dibatalkan Pelanggan</div>`
              : `<select onchange="ubahStatus(${r.id}, this.value)" style="padding:0.3rem 0.5rem;border-radius:6px;border:1px solid #ddd;width:100%;">
                <option value="">Ubah Status</option>
                <option value="Baru" ${r.status==='Baru'?'selected':''}>Baru</option>
                <option value="Diproses" ${r.status==='Diproses'?'selected':''}>Diproses</option>
                <option value="Selesai" ${r.status==='Selesai'?'selected':''}>Selesai</option>
              </select>`
            }
          </div>
        </td>
      </tr>
    `).join('');
  }
}

// ── Cari Pesanan — cari di SELURUH data (tanpa limit), bukan hanya yang tampil ──
function filterPesanan() {
  const q = (document.getElementById('orders-search').value || '').trim().toLowerCase();
  if (!q) { renderOrdersTable(pesananCache); return; }

  const filtered = pesananCache.filter(r => {
    const haystack = [
      r.id, r.nama_pemesan, r.no_hp, r.item_list, r.status,
      r.email_member, r.jenis_acara, r.metode_bayar, r.alamat
    ].filter(Boolean).join(' ').toLowerCase();
    return haystack.includes(q);
  });

  renderOrdersTable(filtered);
}

// ── Detail Pesanan Modal ─────────────────────────────────
async function lihatDetailPesanan(id) {
  const overlay = document.getElementById('detail-pesanan-overlay');
  const body    = document.getElementById('detail-pesanan-body');
  document.getElementById('detail-pesanan-title').textContent = `Detail Pesanan #${id}`;
  body.innerHTML = '<div style="text-align:center;padding:2rem;color:var(--muted);">Memuat...</div>';
  overlay.classList.add('show');

  try {
    const res  = await fetch(`?page=dashboard&action=pesananDetail&id=${id}`);
    const data = await res.json();
    if (!data.success) { body.innerHTML = '<p style="color:red;">Gagal memuat data.</p>'; return; }
    const p = data.data;

    const fmtRp  = v => 'Rp ' + Number(v).toLocaleString('id-ID');
    const fmtTgl = v => v ? new Date(v+'T00:00:00').toLocaleDateString('id-ID',{day:'numeric',month:'long',year:'numeric'}) : '-';

    body.innerHTML = `
      <div style="background:var(--beige);border-radius:8px;padding:1rem;margin-bottom:1rem;">
        <div style="font-weight:700;font-size:0.85rem;color:var(--muted);text-transform:uppercase;letter-spacing:.06em;margin-bottom:.6rem;">Info Pemesan</div>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:.4rem .8rem;font-size:.88rem;">
          <div><span style="color:var(--muted);">Nama</span><br><b>${p.nama_pemesan}</b></div>
          <div><span style="color:var(--muted);">No. HP</span><br><b>${p.no_hp || '-'}</b></div>
          <div style="grid-column:1/-1;"><span style="color:var(--muted);">Alamat Pengiriman</span><br><b>${p.alamat || '-'}</b></div>
        </div>
      </div>
      <div style="background:var(--beige);border-radius:8px;padding:1rem;margin-bottom:1rem;">
        <div style="font-weight:700;font-size:0.85rem;color:var(--muted);text-transform:uppercase;letter-spacing:.06em;margin-bottom:.6rem;">Detail Acara & Pengiriman</div>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:.4rem .8rem;font-size:.88rem;">
          <div><span style="color:var(--muted);">Jenis Acara</span><br><b>${p.jenis_acara || '-'}</b></div>
          <div><span style="color:var(--muted);">Tanggal Acara</span><br><b>${fmtTgl(p.tanggal_acara)}</b></div>
          <div><span style="color:var(--muted);">Waktu Pengiriman</span><br><b>${p.waktu_pengiriman || '-'}</b></div>
          <div><span style="color:var(--muted);">Metode Bayar</span><br><b>${p.metode_bayar || '-'}</b></div>
        </div>
        ${p.catatan ? `<div style="margin-top:.6rem;font-size:.88rem;"><span style="color:var(--muted);">📝 Catatan Tambahan</span><br><b style="color:#c0392b;">${p.catatan}</b></div>` : ''}
      </div>
      <div style="background:var(--beige);border-radius:8px;padding:1rem;margin-bottom:1rem;">
        <div style="font-weight:700;font-size:0.85rem;color:var(--muted);text-transform:uppercase;letter-spacing:.06em;margin-bottom:.6rem;">Item Pesanan</div>
        <table style="width:100%;font-size:.86rem;border-collapse:collapse;">
          <thead><tr style="color:var(--muted);font-size:.78rem;">
            <th style="text-align:left;padding:.3rem 0;">Menu</th>
            <th style="text-align:center;">Qty</th>
            <th style="text-align:right;">Harga</th>
            <th style="text-align:right;">Subtotal</th>
          </tr></thead>
          <tbody>
            ${(p.items||[]).map(i=>`
              <tr style="border-top:1px solid var(--tan);">
                <td style="padding:.35rem 0;">${i.nama_menu}</td>
                <td style="text-align:center;">×${i.qty}</td>
                <td style="text-align:right;">${fmtRp(i.harga)}</td>
                <td style="text-align:right;font-weight:600;">${fmtRp(i.subtotal)}</td>
              </tr>`).join('')}
          </tbody>
        </table>
        <div style="border-top:2px solid var(--gold-dark);margin-top:.6rem;padding-top:.6rem;text-align:right;font-weight:700;font-size:1rem;">
          Total: ${fmtRp(p.total)}
        </div>
      </div>
      <div style="font-size:.82rem;color:var(--muted);text-align:right;">
        Dipesan: ${new Date(p.created_at).toLocaleString('id-ID')} · Status: <b>${p.status}</b>
      </div>
    `;
  } catch(e) {
    body.innerHTML = '<p style="color:red;">Terjadi kesalahan jaringan.</p>';
  }
}

function tutupDetailPesanan(e) {
  if (!e || e.target === document.getElementById('detail-pesanan-overlay')) {
    document.getElementById('detail-pesanan-overlay').classList.remove('show');
  }
}

async function ubahStatus(id, status) {
  if (!status) return;
  try {
    const res = await fetch('?page=dashboard&action=updateStatus', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ id, status })
    });
    const data = await res.json();
    if (data.success) {
      loadPesanan();
      loadStats();
    } else {
      alert(data.message || 'Gagal mengubah status.');
    }
  } catch (e) { alert('Terjadi kesalahan koneksi.'); }
}

// Inisialisasi saat halaman dimuat
loadStats();
loadPesanan();
loadMenu();

/* ─── MENU MANAGEMENT ────────────────────────────────────── */
let menuCache = [];

async function loadMenu() {
  const grid = document.getElementById('menu-admin-grid');
  try {
    const res = await fetch('?page=dashboard&action=menuList');
    const data = await res.json();
    if (!data.success) return;
    menuCache = data.data;

    if (menuCache.length === 0) {
      grid.innerHTML = '<div style="padding:2rem;text-align:center;color:var(--muted);">Belum ada menu.</div>';
    } else {
      grid.innerHTML = menuCache.map(m => `
        <div class="mac">
          <div class="mac-img"><img src="${m.gambar || 'https://via.placeholder.com/300x225?text=No+Image'}" alt=""></div>
          <div class="mac-body">
            <div class="mac-name">${m.nama_menu}${m.aktif == 0 ? ' <span style="color:var(--red);font-size:0.7rem;">(Nonaktif)</span>' : ''}</div>
            <div class="mac-price">Rp ${Number(m.harga).toLocaleString('id-ID')} ${m.satuan || ''}</div>
            <div class="mac-acts">
              <button class="mac-btn mac-edit" onclick="openMenuModal(${m.id})">✏ Edit</button>
              <button class="mac-btn mac-del" onclick="hapusMenu(${m.id})">✕ Hapus</button>
            </div>
          </div>
        </div>
      `).join('') + '<div class="mac-add" onclick="openMenuModal()"><span>＋</span>Tambah Menu Baru</div>';
    }
  } catch (e) {
    console.error('Gagal memuat menu:', e);
    grid.innerHTML = '<div style="padding:2rem;text-align:center;color:var(--red);">Gagal memuat menu.</div>';
  }
}

function openMenuModal(id) {
  const overlay = document.getElementById('menu-modal-overlay');
  const title    = document.getElementById('menu-modal-title');

  if (id) {
    const m = menuCache.find(x => x.id == id);
    if (!m) return;
    title.textContent = 'Edit Menu';
    document.getElementById('menu-id').value        = m.id;
    document.getElementById('menu-nama').value       = m.nama_menu || '';
    document.getElementById('menu-kategori').value   = m.kategori || '';
    document.getElementById('menu-deskripsi').value  = m.deskripsi || '';
    document.getElementById('menu-harga').value      = m.harga || '';
    document.getElementById('menu-satuan').value     = m.satuan || '';
    document.getElementById('menu-gambar').value     = m.gambar || '';
    document.getElementById('menu-aktif').value      = m.aktif ?? 1;
  } else {
    title.textContent = 'Tambah Menu Baru';
    document.getElementById('menu-id').value        = '';
    document.getElementById('menu-nama').value       = '';
    document.getElementById('menu-kategori').value   = '';
    document.getElementById('menu-deskripsi').value  = '';
    document.getElementById('menu-harga').value      = '';
    document.getElementById('menu-satuan').value     = '/pcs';
    document.getElementById('menu-gambar').value     = '';
  resetUploadArea();
    document.getElementById('menu-aktif').value      = 1;
  }

  overlay.classList.add('show');
}

function closeMenuModal() {
  document.getElementById('menu-modal-overlay').classList.remove('show');
}

// ── Upload Gambar ─────────────────────────────────────────
function handleDrop(e) {
  e.preventDefault();
  document.getElementById('upload-area').style.borderColor = 'var(--tan)';
  const file = e.dataTransfer.files[0];
  if (file) prosesFile(file);
}

function handleFileSelect(input) {
  if (input.files[0]) prosesFile(input.files[0]);
}

async function prosesFile(file) {
  const maxSize = 2 * 1024 * 1024;
  if (!file.type.match(/image\/(jpeg|png|webp)/)) {
    setUploadStatus('❌ Format harus JPG, PNG, atau WEBP', 'red'); return;
  }
  if (file.size > maxSize) {
    setUploadStatus('❌ Ukuran file maks 2MB', 'red'); return;
  }

  // Preview langsung
  const reader = new FileReader();
  reader.onload = e => {
    document.getElementById('upload-img-preview').src = e.target.result;
    document.getElementById('upload-preview').style.display = 'block';
    document.getElementById('upload-placeholder').style.display = 'none';
  };
  reader.readAsDataURL(file);

  setUploadStatus('⏳ Mengupload...', 'var(--gold-dark)');

  const fd = new FormData();
  fd.append('gambar', file);

  try {
    const res  = await fetch('?page=dashboard&action=menuUploadGambar', {
      method: 'POST',
      body: fd
    });
    const data = await res.json();
    if (data.success) {
      document.getElementById('menu-gambar').value = data.url;
      setUploadStatus('✅ Gambar berhasil diupload!', 'green');
    } else {
      setUploadStatus('❌ ' + (data.message || 'Gagal upload'), 'red');
    }
  } catch(e) {
    setUploadStatus('❌ Gagal koneksi ke server', 'red');
  }
}

function setUploadStatus(msg, color) {
  const el = document.getElementById('upload-status');
  el.textContent = msg;
  el.style.color = color;
  el.style.display = 'block';
}

function resetUploadArea() {
  document.getElementById('upload-preview').style.display   = 'none';
  document.getElementById('upload-placeholder').style.display = 'block';
  document.getElementById('upload-status').style.display    = 'none';
  document.getElementById('menu-file').value                = '';
}

async function simpanMenu() {
  const id = document.getElementById('menu-id').value;
  const payload = {
    nama_menu: document.getElementById('menu-nama').value.trim(),
    kategori:  document.getElementById('menu-kategori').value.trim(),
    deskripsi: document.getElementById('menu-deskripsi').value.trim(),
    harga:     document.getElementById('menu-harga').value,
    satuan:    document.getElementById('menu-satuan').value.trim(),
    gambar:    document.getElementById('menu-gambar').value.trim(),
    aktif:     document.getElementById('menu-aktif').value,
  };

  if (!payload.nama_menu || !payload.harga) {
    alert('Nama menu dan harga wajib diisi.');
    return;
  }

  const isEdit = !!id;
  if (isEdit) payload.id = id;

  try {
    const res = await fetch('?page=dashboard&action=' + (isEdit ? 'menuEdit' : 'menuTambah'), {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(payload)
    });
    const data = await res.json();
    if (data.success) {
      closeMenuModal();
      loadMenu();
    } else {
      alert(data.message || 'Gagal menyimpan menu.');
    }
  } catch (e) { alert('Terjadi kesalahan koneksi.'); }
}

async function hapusMenu(id) {
  if (!confirm('Hapus menu ini?')) return;
  try {
    const res = await fetch('?page=dashboard&action=menuHapus', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ id })
    });
    const data = await res.json();
    if (data.success) {
      loadMenu();
    } else {
      alert(data.message || 'Gagal menghapus menu.');
    }
  } catch (e) { alert('Terjadi kesalahan koneksi.'); }
}

/* ─── LAPORAN PENDAPATAN ─────────────────────────────────── */
const MONTH_NAMES = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des'];

async function loadLaporan() {
  try {
    const res = await fetch('?page=dashboard&action=laporan');
    const json = await res.json();
    if (!json.success) return;
    laporanCache = json.data; // sinkronkan cache yang juga dipakai diagram di tab Dashboard
    const d = json.data;

    // Stat cards
    document.getElementById('lap-total-bulan').textContent    = formatRupiah(d.total_bulan_ini);
    document.getElementById('lap-total-bulan-2').textContent  = formatRupiah(d.total_bulan_ini);
    document.getElementById('lap-total-transaksi').textContent= d.total_transaksi;
    document.getElementById('lap-rata-rata').textContent      = formatRupiah(d.rata_rata);

    const trendTxt = (d.persen_vs_bulan_lalu >= 0 ? '↑ ' : '↓ ') + Math.abs(d.persen_vs_bulan_lalu) + '%';
    document.getElementById('lap-trend-bulan').textContent   = trendTxt;
    document.getElementById('lap-trend-bulan-2').textContent = trendTxt + ' dari bulan lalu';

    const now = new Date();
    document.getElementById('lap-bulan-label').textContent = MONTH_NAMES[now.getMonth()] + ' ' + now.getFullYear();

    // Hari paling ramai
    if (d.hari_tertinggi) {
      const tgl = new Date(d.hari_tertinggi.tgl);
      document.getElementById('lap-hari-ramai').textContent = tgl.getDate() + ' ' + MONTH_NAMES[tgl.getMonth()];
      document.getElementById('lap-hari-ramai-total').textContent = formatRupiah(d.hari_tertinggi.total);
      document.getElementById('lap-tertinggi').textContent = formatRupiah(d.hari_tertinggi.total);
    } else {
      document.getElementById('lap-hari-ramai').textContent = '-';
      document.getElementById('lap-hari-ramai-total').textContent = 'Rp 0';
      document.getElementById('lap-tertinggi').textContent = 'Rp 0';
    }

    // Rata-rata per hari (dari total bulan ini / jumlah hari yg ada transaksi)
    const jumlahHariAktif = d.harian.length || 1;
    document.getElementById('lap-rata-hari').textContent = formatRupiah(d.total_bulan_ini / jumlahHariAktif);

    // Daily line chart
    const lastDay = new Date(now.getFullYear(), now.getMonth() + 1, 0).getDate();
    const dailyMap = {};
    d.harian.forEach(r => dailyMap[r.tgl] = Number(r.total));
    const labels = [];
    const values = [];
    for (let i = 1; i <= lastDay; i++) {
      labels.push(i + '');
      values.push(dailyMap[i] || 0);
    }
    window.dailyLineChartObj.data.labels = labels;
    window.dailyLineChartObj.data.datasets[0].data = values;
    window.dailyLineChartObj.update();

    // Monthly bar chart
    const monthLabels = d.bulanan.map(r => MONTH_NAMES[r.bln - 1] + ' ' + String(r.thn).slice(2));
    const monthValues = d.bulanan.map(r => Number(r.total));
    window.monthlyBarChartObj.data.labels = monthLabels;
    window.monthlyBarChartObj.data.datasets[0].data = monthValues;
    window.monthlyBarChartObj.update();

    // Donut kategori
    const kategoriData = (d.kategori || []).filter(r => r.kategori && r.kategori.trim() !== '');
    const totalKategori = kategoriData.reduce((s, r) => s + Number(r.total), 0);
    const kategoriLabels = kategoriData.map(r => r.kategori);
    const kategoriValues = kategoriData.map(r => Number(r.total));
    const colors = [GOLD_D, BROWN, SAND, TAN, '#b8a07a', '#c9a96e', '#8b6914', '#d4b896'];
    window.donutBigObj.data.labels = kategoriLabels;
    window.donutBigObj.data.datasets[0].data = kategoriValues;
    window.donutBigObj.data.datasets[0].backgroundColor = kategoriLabels.map((_,i)=>colors[i % colors.length]);
    window.donutBigObj.update();

    document.getElementById('lap-donut-total').textContent = formatRupiah(totalKategori);

    const legend = document.getElementById('lap-kategori-legend');
    if (kategoriData.length === 0) {
      legend.innerHTML = '<div style="color:var(--muted);font-size:0.8rem;">Belum ada data.</div>';
    } else {
      legend.innerHTML = kategoriData.map((r, i) => {
        const pct = totalKategori > 0 ? Math.round((r.total / totalKategori) * 100) : 0;
        return `<div style="display:flex;align-items:center;gap:0.5rem;font-size:0.83rem;">
          <div style="width:10px;height:10px;border-radius:50%;background:${colors[i%colors.length]};flex-shrink:0;"></div>
          <div style="flex:1;">${r.kategori}</div>
          <div style="font-weight:600;">${pct}%</div>
        </div>
        <div style="margin-left:1.2rem;font-size:0.78rem;color:var(--muted);margin-bottom:0.3rem;">${formatRupiah(r.total)}</div>`;
      }).join('');
    }

    // Top produk (dari DB real)
    if (d.top_produk && d.top_produk.length > 0 && window.hbarChartObj) {
      const barColors = [GOLD_D, GOLD, SAND, BROWN, TAN];
      window.hbarChartObj.data.labels = d.top_produk.map(r => r.nama_menu);
      window.hbarChartObj.data.datasets[0].data = d.top_produk.map(r => Number(r.total));
      window.hbarChartObj.data.datasets[0].backgroundColor = d.top_produk.map((_,i) => barColors[i % barColors.length]);
      window.hbarChartObj.options.scales.x.min = 0;
      window.hbarChartObj.update();
    } else if (window.hbarChartObj) {
      window.hbarChartObj.data.labels = [];
      window.hbarChartObj.data.datasets[0].data = [];
      window.hbarChartObj.update();
    }
  } catch (e) { console.error('Gagal memuat laporan:', e); }
}

/* ─── DATA PELANGGAN ─────────────────────────────────────── */
async function loadCustomers() {
  const list = document.getElementById('cust-list');
  try {
    const res = await fetch('?page=dashboard&action=members');
    const json = await res.json();
    if (!json.success) return;
    customerCache = json.data;
    renderCustomers();
  } catch (e) {
    console.error('Gagal memuat pelanggan:', e);
    list.innerHTML = '<div style="padding:2rem;text-align:center;color:var(--red);">Gagal memuat data pelanggan.</div>';
  }
}

function renderCustomers() {
  const list = document.getElementById('cust-list');
  const q = (document.getElementById('cust-search').value || '').toLowerCase();
  const filtered = customerCache.filter(c =>
    (c.nama || '').toLowerCase().includes(q) || (c.email || '').toLowerCase().includes(q)
  );

  if (filtered.length === 0) {
    list.innerHTML = '<div style="padding:2rem;text-align:center;color:var(--muted);">Belum ada pelanggan.</div>';
    return;
  }

  list.innerHTML = filtered.map(c => {
    const initials = (c.nama || '?').split(' ').map(w => w[0]).slice(0, 2).join('').toUpperCase();
    return `
      <div class="cust-row">
        <div class="cust-av">${initials}</div>
        <div><div class="cust-name">${c.nama}</div><div class="cust-email">${c.email}${c.no_hp ? ' · ' + c.no_hp : ''}</div></div>
        <div class="cust-orders"><div class="cust-n">${c.total_pesanan}</div><div class="cust-l">pesanan</div></div>
        <div class="cust-total">${formatRupiah(c.total_belanja)}</div>
      </div>
    `;
  }).join('');
}

/* ─── TESTIMONI ADMIN ────────────────────────────────────── */
let testimoniCache = [];
let testiFilterRating = 0;

async function loadTestimoniAdmin() {
  const list = document.getElementById('testi-cards-list');
  list.innerHTML = '<div class="testi-empty">Memuat ulasan...</div>';
  try {
    const res  = await fetch('?page=dashboard&action=testimoniList');
    const data = await res.json();
    if (!data.success) throw new Error(data.message || 'Gagal');
    testimoniCache = data.data || [];
    renderTestimoniOverview();
    renderTestimoniCards();
  } catch(e) {
    list.innerHTML = `<div class="testi-empty" style="color:red;">Gagal memuat: ${e.message}</div>`;
  }
}

function renderTestimoniOverview() {
  const total  = testimoniCache.length;
  const avgRaw = total ? (testimoniCache.reduce((s,t)=>s+parseInt(t.rating),0)/total) : 0;
  const avg    = avgRaw.toFixed(1);

  document.getElementById('testi-big-score').textContent = total ? avg : '—';
  document.getElementById('testi-big-total').textContent = total + ' ulasan';

  // Bintang besar (biru ala Google Play)
  const filled = Math.round(avgRaw);
  document.getElementById('testi-big-stars').textContent = '★'.repeat(filled) + '☆'.repeat(5 - filled);

  // Bar per bintang
  const bars = document.getElementById('testi-ov-bars');
  bars.innerHTML = [5,4,3,2,1].map(n => {
    const cnt = testimoniCache.filter(t => parseInt(t.rating) === n).length;
    const pct = total ? Math.round((cnt / total) * 100) : 0;
    return `
      <div class="testi-bar-row">
        <span>${n}</span>
        <div class="testi-bar-track"><div class="testi-bar-fill" style="width:${pct}%"></div></div>
        <span class="testi-bar-count">${cnt}</span>
      </div>
    `;
  }).join('');
}

function filterTesti(r) {
  testiFilterRating = r;
  document.querySelectorAll('.testi-filter-btn').forEach(b => {
    b.classList.toggle('tf-active', parseInt(b.dataset.r) === r);
  });
  renderTestimoniCards();
}

function renderTestimoniCards() {
  const list = document.getElementById('testi-cards-list');
  const q    = (document.getElementById('testi-search')?.value || '').toLowerCase();

  let filtered = testimoniCache;
  if (testiFilterRating > 0) filtered = filtered.filter(t => parseInt(t.rating) === testiFilterRating);
  if (q) filtered = filtered.filter(t =>
    (t.nama_user||'').toLowerCase().includes(q) ||
    (t.pesan||'').toLowerCase().includes(q)
  );

  if (!filtered.length) {
    list.innerHTML = '<div class="testi-empty">Belum ada ulasan yang sesuai.</div>';
    return;
  }

  const fmt = s => new Date(s).toLocaleDateString('id-ID',{day:'2-digit',month:'long',year:'numeric'});
  const initials = n => (n||'?').split(' ').map(w=>w[0]).slice(0,2).join('').toUpperCase();
  const starHtml = n => `<span style="color:#fbbc04;">${'★'.repeat(n)}</span><span style="color:#dadce0;">${'★'.repeat(5-n)}</span>`;

  list.innerHTML = filtered.map(t => `
    <div class="testi-card-item ${parseInt(t.visible) === 0 ? 'testi-hidden' : ''}">
      <div class="testi-card-head">
        <div class="testi-avatar">${initials(t.nama_user)}</div>
        <div class="testi-card-meta">
          <div class="testi-card-name">${t.nama_user || '—'} ${parseInt(t.visible) === 0 ? '<span class="testi-badge-hidden">Disembunyikan</span>' : '<span class="testi-badge-visible">Tampil</span>'}</div>
          <div class="testi-card-order">#ORD-${t.no_pesanan}</div>
        </div>
        <div class="testi-card-actions">
          <button class="testi-card-toggle ${parseInt(t.visible) === 0 ? 'btn-show' : 'btn-hide'}" onclick="toggleTestimoni(${t.id})">${parseInt(t.visible) === 0 ? '👁️ Tampilkan' : '🙈 Sembunyikan'}</button>
        </div>
      </div>
      <div class="testi-card-stars">
        ${starHtml(parseInt(t.rating))}
        <span class="testi-card-date">${fmt(t.created_at)}</span>
      </div>
      <div class="testi-card-text">${t.pesan}</div>
    </div>
  `).join('');
}


async function toggleTestimoni(id) {
  try {
    const res  = await fetch('?page=dashboard&action=testimoniToggle', {
      method: 'POST',
      headers: {'Content-Type':'application/json'},
      body: JSON.stringify({id})
    });
    const data = await res.json();
    if (data.success) {
      // Flip nilai visible di cache lokal
      testimoniCache = testimoniCache.map(t =>
        t.id == id ? {...t, visible: t.visible == 1 ? 0 : 1} : t
      );
      renderTestimoniCards();
    } else {
      alert(data.message || 'Gagal mengubah status.');
    }
  } catch(e) {
    alert('Koneksi bermasalah.');
  }
}
</script>
</body>
</html>