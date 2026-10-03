  </div><!-- end content -->
</div><!-- end main -->


<!-- ══ MODAL: SUKSES ════════════════════════════════════════ -->
<div class="modal-overlay" id="modalOverlay">
  <div class="modal">
    <div class="modal-icon">✓</div>
    <div class="modal-title">Pesanan Terkirim!</div>
    <div class="modal-sub">Semua item dalam pesanan Anda sudah masuk ke dapur kami dan sedang menunggu konfirmasi admin.</div>
    <div class="modal-id" id="modalOrderId">#ORD-0000</div>
    <div class="modal-items" id="modalItemsList"></div>
    <div class="modal-steps">
      <div class="mstep"><div class="mstep-n">1</div><span><strong>Pesanan Diterima</strong> — Admin kami akan segera memproses pesanan Anda</span></div>
      <div class="mstep"><div class="mstep-n">2</div><span><strong>Status Terupdate</strong> — Pantau perkembangan di Riwayat Pesanan</span></div>
      <div class="mstep"><div class="mstep-n">3</div><span><strong>Dikirim Tepat Waktu</strong> — Pesanan fresh dikirim sesuai jadwal</span></div>
    </div>
    <div class="modal-btn-row">
      <button class="modal-btn secondary" onclick="closeModal()">Tutup</button>
      <button class="modal-btn primary" onclick="closeModal();sv('riwayat')">Lihat Riwayat →</button>
    </div>
  </div>
</div>

<!-- ══ DRAWER: DETAIL PESANAN ════════════════════════════════ -->
<div class="drawer-overlay" id="drawerOverlay" onclick="closeDrawer(event)">
  <div class="drawer" id="drawerPanel">
    <div class="drawer-close" onclick="closeDrawer()">✕</div>
    <div class="drawer-title">Detail Pesanan</div>
    <div id="drawerContent"></div>
  </div>
</div>


<!-- ══════════════════════════════════════════════════════════
     JAVASCRIPT
══════════════════════════════════════════════════════════ -->
<script>
/* ── USER INFO ──────────────────────────────────────────── */
const mName  = sessionStorage.getItem('member_name')  || 'Pelanggan';
const mEmail = sessionStorage.getItem('member_email') || 'pelanggan@email.com';
const mPhone = <?= json_encode($user['no_hp'] ?? '') ?>;
const mInit  = mName.trim().charAt(0).toUpperCase();
['sbAv','pfAv'].forEach(id => { const el=document.getElementById(id); if(el) el.textContent=mInit; });
['sbName','wbName','pfName'].forEach(id => { const el=document.getElementById(id); if(el) el.textContent=mName; });
['pfEmail'].forEach(id => { const el=document.getElementById(id); if(el) el.textContent=mEmail; });
document.getElementById('pf-nama').value        = mName;
document.getElementById('pf-email-input').value = mEmail;

/* ── KATALOG DATA (diambil dari database) ───────────────── */
let MENU = []; // akan diisi dari API saat halaman load

/* ── CART STATE ─────────────────────────────────────────── */
// cart = { [menuId]: qty }
let cart = {};
let currentCatFilter = 'semua';

/* ── RENDER CATALOG ─────────────────────────────────────── */
function renderCatalog(filter='semua') {
  const grid = document.getElementById('catalogGrid');
  const items = filter==='semua' ? MENU : MENU.filter(m=>m.cat===filter);
  grid.innerHTML = items.map(m => {
    const inCart = cart[m.id] || 0;
    return `<div class="menu-card" id="card-${m.id}">
      ${m.badge ? `<div style="position:relative;"><img src="${m.img}" alt="${m.name}"><div style="position:absolute;top:8px;left:8px;background:var(--gold);color:var(--white);font-size:0.56rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;padding:2px 7px;border-radius:2px;">${m.badge}</div></div>` : `<img src="${m.img}" alt="${m.name}">`}
      <div class="mc-body">
        <div class="mc-cat">${m.cat}</div>
        <div class="mc-name">${m.name}</div>
        <div class="mc-price">Rp ${m.price.toLocaleString('id-ID')} / ${m.unit}</div>
        <div class="mc-action">
          <div class="mc-action-row">
            <button class="qb" onclick="catalogQty('${m.id}',-1)">−</button>
            <div class="qn" id="cq-${m.id}">${inCart}</div>
            <button class="qb" onclick="catalogQty('${m.id}',1)">+</button>
          </div>
          <button class="add-btn ${inCart>0?'in-cart':''}" id="addbtn-${m.id}" onclick="addToCart('${m.id}')">
            ${inCart>0 ? '✓ Ditambahkan' : '+ Tambah ke Keranjang'}
          </button>
        </div>
      </div>
    </div>`;
  }).join('');
}

function filterCat(cat, btn) {
  currentCatFilter = cat;
  document.querySelectorAll('.cat-tab').forEach(t=>t.classList.remove('on'));
  btn.classList.add('on');
  renderCatalog(cat);
}

/* ── CART OPERATIONS ────────────────────────────────────── */
function catalogQty(id, delta) {
  const cur = cart[id] || 0;
  const nv  = Math.max(0, cur + delta);
  if(nv === 0) { delete cart[id]; } else { cart[id] = nv; }
  // Update display in catalog
  const qnEl = document.getElementById('cq-'+id);
  if(qnEl) qnEl.textContent = nv;
  const btnEl = document.getElementById('addbtn-'+id);
  if(btnEl) { btnEl.textContent = nv>0 ? '✓ Ditambahkan' : '+ Tambah ke Keranjang'; btnEl.classList.toggle('in-cart', nv>0); }
  renderCart();
}

function addToCart(id) {
  cart[id] = (cart[id]||0) + 1;
  const qnEl = document.getElementById('cq-'+id);
  if(qnEl) qnEl.textContent = cart[id];
  const btnEl = document.getElementById('addbtn-'+id);
  if(btnEl) { btnEl.textContent = '✓ Ditambah'; btnEl.classList.add('in-cart'); }
  renderCart();
  // Bounce animation on cart badge
  const badge = document.getElementById('cartBadge');
  badge.style.transform='scale(1.4)';
  setTimeout(()=>badge.style.transform='',220);
}

function cartRemove(id) {
  delete cart[id];
  renderCatalog(currentCatFilter);
  renderCart();
}
function clearCart() {
  if(Object.keys(cart).length===0) return;
  if(!confirm('Kosongkan semua item dari keranjang?')) return;
  cart = {};
  renderCatalog(currentCatFilter);
  renderCart();
}

/* ── RENDER CART PANEL ──────────────────────────────────── */
function renderCart() {
  const ids    = Object.keys(cart);
  const total  = ids.reduce((s,id)=>{ const m=MENU.find(x=>x.id===id); return s+(m?m.price*cart[id]:0); }, 0);
  const totalQ = ids.reduce((s,id)=>s+cart[id], 0);
  const ongkir = totalQ >= 50 ? 0 : 10000;
  const grand  = total + ongkir;

  // Badges
  const showBadge = ids.length > 0;
  ['cartBadge','cartBadgeSb'].forEach(bid=>{ const b=document.getElementById(bid); if(b){b.textContent=totalQ;b.style.display=showBadge?'':'none';}});
  const top = document.getElementById('cartCountTop'); if(top){top.textContent=totalQ;top.style.display=showBadge?'':'none';}

  if(ids.length === 0) {
    document.getElementById('cartBody').innerHTML = `<div class="cart-empty"><span>🧺</span><p>Keranjang masih kosong.<br>Pilih menu di sebelah kiri.</p></div>`;
    document.getElementById('cartSummary').style.display = 'none';
    return;
  }

  document.getElementById('cartBody').innerHTML = `<div class="cart-items">${
    ids.map(id => {
      const m = MENU.find(x=>x.id===id);
      if(!m) return '';
      return `<div class="cart-item">
        <img class="ci-img" src="${m.img}" alt="${m.name}">
        <div class="ci-info">
          <div class="ci-name">${m.name}</div>
          <div class="ci-price">Rp ${m.price.toLocaleString('id-ID')} / ${m.unit}</div>
        </div>
        <div class="ci-qty">
          <button class="cqb" onclick="catalogQty('${id}',-1)">−</button>
          <div class="cqn">${cart[id]}</div>
          <button class="cqb" onclick="catalogQty('${id}',1)">+</button>
        </div>
        <div class="ci-sub">Rp ${(m.price*cart[id]).toLocaleString('id-ID')}</div>
        <button class="ci-del" onclick="cartRemove('${id}')" title="Hapus">✕</button>
      </div>`;
    }).join('')
  }</div>`;

  document.getElementById('totalQty').textContent   = totalQ;
  document.getElementById('subtotalVal').textContent = 'Rp '+total.toLocaleString('id-ID');
  const ongTag = document.getElementById('ongkirTag');
  if(ongkir===0){ ongTag.innerHTML='<span class="promo-tag">GRATIS ≥50 pcs</span>'; document.getElementById('ongkirVal').textContent='Rp 0';}
  else { ongTag.innerHTML=''; document.getElementById('ongkirVal').textContent='Rp '+ongkir.toLocaleString('id-ID'); }
  document.getElementById('grandTotalVal').textContent = 'Rp '+grand.toLocaleString('id-ID');
  document.getElementById('cartSummary').style.display = 'block';
}

/* ── CHECKOUT FLOW ──────────────────────────────────────── */
function goToCheckout() {
  if(Object.keys(cart).length === 0) { alert('Keranjang masih kosong!'); return; }
  // Render mini cart summary
  const ids = Object.keys(cart);
  const total = ids.reduce((s,id)=>{ const m=MENU.find(x=>x.id===id); return s+(m?m.price*cart[id]:0); }, 0);
  const totalQ = ids.reduce((s,id)=>s+cart[id], 0);
  document.getElementById('checkoutCartMini').innerHTML =
    `<div style="font-size:0.71rem;font-weight:600;color:var(--muted);letter-spacing:0.1em;text-transform:uppercase;margin-bottom:0.6rem;">Ringkasan Keranjang (${ids.length} menu, ${totalQ} item)</div>` +
    ids.map(id=>{ const m=MENU.find(x=>x.id===id); if(!m) return '';
      return `<div style="display:flex;align-items:center;gap:0.6rem;padding:0.3rem 0;font-size:0.78rem;color:var(--dark);">
        <img src="${m.img}" style="width:28px;height:28px;border-radius:3px;object-fit:cover;">
        <span style="flex:1;">${m.name}</span>
        <span style="color:var(--muted);">× ${cart[id]}</span>
        <span style="font-weight:600;color:var(--gold-dark);">Rp ${(m.price*cart[id]).toLocaleString('id-ID')}</span>
      </div>`;
    }).join('') +
    `<div style="font-size:0.82rem;font-weight:700;color:var(--dark);border-top:1px solid var(--tan);padding-top:0.5rem;margin-top:0.35rem;text-align:right;">Total: Rp ${total.toLocaleString('id-ID')}</div>`;

  document.getElementById('step-catalog').style.display  = 'none';
  document.getElementById('step-checkout').style.display = 'block';
  showFlowPanel('detail');
  window.scrollTo({top:0,behavior:'smooth'});
}

function backToCatalog() {
  document.getElementById('step-checkout').style.display = 'none';
  document.getElementById('step-catalog').style.display  = 'block';
  window.scrollTo({top:0,behavior:'smooth'});
}
function backToDetail() { showFlowPanel('detail'); }

function showFlowPanel(which) {
  document.querySelectorAll('.flow-panel').forEach(p=>p.classList.remove('show'));
  document.getElementById('panel-'+which).classList.add('show');
  ['fs2','fs3'].forEach(id=>document.getElementById(id).classList.remove('on','done'));
  if(which==='detail') { document.getElementById('fs2').classList.add('on'); }
  if(which==='confirm'){ document.getElementById('fs2').classList.add('done'); document.getElementById('fs3').classList.add('on'); }
}

function goConfirm() {
  // Validate
  let ok = true;
  const checks = [['f-acara','e-acara'],['f-tgl','e-tgl'],['f-waktu','e-waktu'],['f-bayar','e-bayar'],['f-alamat','e-alamat']];
  checks.forEach(([fid,eid])=>{
    const el=document.getElementById(fid), em=document.getElementById(eid);
    if(!el.value.trim()){el.classList.add('err');em.style.display='block';ok=false;}
    else{el.classList.remove('err');em.style.display='none';}
  });
  if(!ok) return;
  buildConfirmView();
  showFlowPanel('confirm');
  window.scrollTo({top:0,behavior:'smooth'});
}

function buildConfirmView() {
  const ids    = Object.keys(cart);
  const total  = ids.reduce((s,id)=>{ const m=MENU.find(x=>x.id===id); return s+(m?m.price*cart[id]:0); }, 0);
  const totalQ = ids.reduce((s,id)=>s+cart[id], 0);
  const ongkir = totalQ >= 50 ? 0 : 10000;
  const grand  = total + ongkir;

  document.getElementById('confirmItemsTable').innerHTML = `
    <table class="oi-table">
      <thead><tr><th>Menu</th><th>Harga Satuan</th><th>Jml</th><th>Subtotal</th></tr></thead>
      <tbody>
        ${ids.map(id=>{ const m=MENU.find(x=>x.id===id); if(!m) return '';
          return `<tr>
            <td><div style="display:flex;align-items:center;gap:0.6rem;">
              <img src="${m.img}" style="width:36px;height:36px;border-radius:3px;object-fit:cover;">
              <span style="font-weight:600;">${m.name}</span></div></td>
            <td>Rp ${m.price.toLocaleString('id-ID')}</td>
            <td>${cart[id]} ${m.unit}</td>
            <td style="font-weight:600;color:var(--gold-dark);">Rp ${(m.price*cart[id]).toLocaleString('id-ID')}</td>
          </tr>`;
        }).join('')}
        <tr class="total-row"><td colspan="3">Ongkos Kirim ${totalQ>=50?'<span style="color:var(--green);font-size:0.7rem;">(GRATIS)</span>':''}</td><td>Rp ${ongkir.toLocaleString('id-ID')}</td></tr>
        <tr class="total-row"><td colspan="3" style="color:var(--dark);font-size:0.92rem;">TOTAL PEMBAYARAN</td><td style="color:var(--gold-dark);font-size:1rem;">Rp ${grand.toLocaleString('id-ID')}</td></tr>
      </tbody>
    </table>`;

  document.getElementById('confirmDetailBox').innerHTML = `
    <div class="cb-row"><span>Jenis Acara</span><span>${document.getElementById('f-acara').value}</span></div>
    <div class="cb-row"><span>Tanggal Acara</span><span>${formatDate(document.getElementById('f-tgl').value)}</span></div>
    <div class="cb-row"><span>Waktu Pengiriman</span><span>${document.getElementById('f-waktu').value}</span></div>
    <div class="cb-row"><span>Metode Pembayaran</span><span>${document.getElementById('f-bayar').value}</span></div>
    <div class="cb-row"><span>Alamat</span><span style="max-width:240px;text-align:right;">${document.getElementById('f-alamat').value}</span></div>
    ${document.getElementById('f-note').value ? `<div class="cb-row"><span>Catatan</span><span style="max-width:230px;text-align:right;">${document.getElementById('f-note').value}</span></div>` : ''}
    <div class="cb-row total"><span>Total Pembayaran</span><span>Rp ${grand.toLocaleString('id-ID')}</span></div>`;
}

/* ── SUBMIT ORDER ───────────────────────────────────────── */
function submitOrder() {
  const btn = document.getElementById('submitBtn');
  btn.textContent='Mengirim pesanan...'; btn.disabled=true;

  const ids    = Object.keys(cart);
  const items  = ids.map(id=>{ const m=MENU.find(x=>x.id===id); return m?{...m,qty:cart[id],subtotal:m.price*cart[id]}:null; }).filter(Boolean);
  const total  = items.reduce((s,i)=>s+i.subtotal, 0);
  const totalQ = items.reduce((s,i)=>s+i.qty, 0);
  const ongkir = totalQ >= 50 ? 0 : 10000;
  const grand  = total + ongkir;

  const payload = {
    nama:    mName,
    hp:      mPhone || '0000000000',
    alamat:  document.getElementById('f-alamat').value,
    catatan:          document.getElementById('f-note').value,
    jenis_acara:      document.getElementById('f-acara').value,
    tanggal_acara:    document.getElementById('f-tgl').value,
    waktu_pengiriman: document.getElementById('f-waktu').value,
    metode_bayar:     document.getElementById('f-bayar').value,
    items: items.map(i => ({
      menu_id: i.db_id || null,
      nama_menu: i.name,
      harga: i.price,
      qty: i.qty,
    })),
  };

  fetch('?page=member&action=buat', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(payload)
  })
  .then(res => res.json())
  .then(data => {
    if (!data.success) {
      alert(data.message || 'Gagal mengirim pesanan.');
      btn.textContent='✦  Konfirmasi & Kirim Pesanan'; btn.disabled=false;
      return;
    }

    const orderId = '#ORD-' + data.pesanan_id;

    // Modal
    document.getElementById('modalOrderId').textContent = orderId;
    document.getElementById('modalItemsList').innerHTML = items.map(i=>`
      <div class="mi-row"><img src="${i.img}" alt="${i.name}"><span>${i.name} × ${i.qty} ${i.unit}</span><strong>Rp ${i.subtotal.toLocaleString('id-ID')}</strong></div>
    `).join('');
    document.getElementById('modalOverlay').classList.add('show');

    // Reset
    cart = {};
    ['f-acara','f-tgl','f-waktu','f-bayar','f-note'].forEach(id=>{const el=document.getElementById(id); if(el) el.value='';});
    if (document.getElementById('f-alamat')) document.getElementById('f-alamat').value='';
    if (document.getElementById('f-hp')) document.getElementById('f-hp').value='';
    renderCart();
    renderCatalog(currentCatFilter);
    document.getElementById('step-checkout').style.display='none';
    document.getElementById('step-catalog').style.display='block';
    btn.textContent='✦  Konfirmasi & Kirim Pesanan'; btn.disabled=false;
    renderBeranda();
  })
  .catch(() => {
    alert('Terjadi kesalahan koneksi.');
    btn.textContent='✦  Konfirmasi & Kirim Pesanan'; btn.disabled=false;
  });
}

/* ── MODAL ──────────────────────────────────────────────── */
function closeModal() { document.getElementById('modalOverlay').classList.remove('show'); }

/* ── RENDER ORDERS ──────────────────────────────────────── */
let ordersCache = [];

async function fetchOrders() {
  try {
    const res = await fetch('?page=member&action=pesanan');
    const data = await res.json();
    if (!data.success) return [];
    return data.data.map(o => ({
      id:        '#ORD-' + o.id,
      rawId:     o.id,
      items:     [],
      itemList:  o.item_list || '-',
      totalItems: (o.item_list || '').split(',').filter(Boolean).length,
      totalQty:  null,
      total:     parseFloat(o.total) || 0,
      status:    mapStatus(o.status),
      createdAt: o.created_at,
      tgl:       (o.created_at || '').slice(0,10),
      acara:     '',
      waktu:     '',
      bayar:     '',
      alamat:    '',
      note:      '',
    }));
  } catch (e) { console.error('Gagal memuat pesanan:', e); return []; }
}

// Mapping status DB -> label tampilan
function mapStatus(s) {
  const map = { 'Baru':'Menunggu Konfirmasi', 'Diproses':'Diproses', 'Selesai':'Selesai', 'Dibatalkan':'Dibatalkan' };
  return map[s] || s;
}
function statusClass(s) {
  if(s==='Selesai') return 's-selesai';
  if(['Diproses','Dimasak','Siap Kirim','Dikonfirmasi'].includes(s)) return 's-proses';
  if(s==='Dibatalkan') return 's-batal';
  return 's-new';
}

function renderOrderCard(o) {
  const sc = statusClass(o.status);
  const orderAge   = o.createdAt ? (Date.now() - new Date(o.createdAt).getTime()) / 1000 : Infinity;
  const canCancel  = o.status==='Menunggu Konfirmasi' && orderAge <= 300; // 300 detik = 5 menit
  return `<div class="ocard">
    <div class="ocard-top">
      <div class="ocard-info">
        <div class="ocard-title">${o.id}</div>
        <div class="ocard-meta">${o.totalItems} item · ${o.acara||'—'}</div>
        <div><span class="sbadge ${sc}"><span class="dot-s"></span>${o.status}</span></div>
        <div class="ocard-items">
          <span style="font-size:0.7rem;color:var(--muted);margin-left:4px;">${o.itemList.length>55?o.itemList.slice(0,55)+'…':o.itemList}</span>
        </div>
      </div>
      <div class="ocard-right">
        <div class="ocard-price">Rp ${(o.total||0).toLocaleString('id-ID')}</div>
        <div class="ocard-date">${formatDate(o.tgl)}</div>
        <div class="ocard-actions">
          <button class="btn-sm btn-sm-g" style="font-size:0.62rem;padding:0.33rem 0.72rem;" onclick='openDrawer(${JSON.stringify(o).replace(/'/g,"&#39;")})'>Detail</button>
          ${canCancel?`<button class="btn-sm" style="background:rgba(231,76,60,0.1);color:var(--red);font-size:0.62rem;padding:0.33rem 0.72rem;border:none;" onclick="cancelOrder(${o.rawId})">Batalkan</button>`:''}
        </div>
      </div>
    </div>
  </div>`;
}

async function renderBeranda() {
  const orders = ordersCache.length ? ordersCache : (ordersCache = await fetchOrders());
  const selesai = orders.filter(o=>o.status==='Selesai').length;
  const proses  = orders.filter(o=>!['Selesai','Dibatalkan'].includes(o.status)).length;
  const total   = orders.reduce((s,o)=>s+(o.total||0), 0);
  document.getElementById('statTotal').textContent   = orders.length;
  document.getElementById('statSelesai').textContent = selesai;
  document.getElementById('statProses').textContent  = proses;
  document.getElementById('statBelanja').textContent = total>0 ? 'Rp '+total.toLocaleString('id-ID') : 'Rp 0';
  const wrap = document.getElementById('berandaOrders');
  wrap.innerHTML = orders.length===0
    ? `<div class="empty"><span>🛒</span><p>Belum ada pesanan.</p><button class="btn-sm" onclick="sv('pesan')">Buat Pesanan Pertama →</button></div>`
    : orders.slice(0,3).map(o=>renderOrderCard(o)).join('');
  const waiting = orders.filter(o=>o.status==='Menunggu Konfirmasi').length;
  const nb = document.getElementById('notifBadge'); nb.textContent=waiting; nb.style.display=waiting>0?'':'none';
}

async function renderRiwayat() {
  ordersCache = await fetchOrders();
  const orders = ordersCache;
  document.getElementById('allOrders').innerHTML = orders.length===0
    ? `<div class="empty"><span>📋</span><p>Belum ada pesanan.</p><button class="btn-sm" onclick="sv('pesan')">Mulai Pesan Sekarang</button></div>`
    : orders.map(o=>renderOrderCard(o)).join('');
}

/* ── CANCEL ─────────────────────────────────────────────── */
async function cancelOrder(rawId) {
  if(!confirm('Batalkan pesanan #ORD-'+rawId+'?')) return;
  try {
    const res = await fetch('?page=member&action=batalkan', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ id: rawId })
    });
    const data = await res.json();
    if (!data.success) { alert(data.message || 'Gagal membatalkan pesanan.'); return; }
    ordersCache = [];
    renderRiwayat(); renderBeranda();
  } catch (e) { alert('Terjadi kesalahan koneksi.'); }
}

/* ── DRAWER ─────────────────────────────────────────────── */
function openDrawer(o) {
  const sc = statusClass(o.status);
  const steps = ['Menunggu Konfirmasi','Diproses','Selesai'];
  const ci = Math.max(0, steps.indexOf(o.status));
  document.getElementById('drawerContent').innerHTML = `
    <div class="d-section">
      <div class="d-label">Status Pesanan</div>
      <span class="sbadge ${sc}" style="margin-bottom:0.5rem;"><span class="dot-s"></span>${o.status}</span>
      <div class="stepper">${steps.map((s,i)=>`
        <div class="step ${i<ci?'done':i===ci?'active':''}">
          <div class="step-dot">${i<ci?'✓':i+1}</div>
          <div class="step-lbl">${s}</div>
        </div>`).join('')}
      </div>
    </div>
    <div class="d-section">
      <div class="d-label">Item Pesanan</div>
      <div style="font-size:0.8rem;color:var(--dark);padding:0.5rem 0;">${o.itemList}</div>
    </div>
    <div class="d-section">
      <div class="d-label">Detail Pesanan</div>
      <div class="d-row"><span>No. Pesanan</span><span>${o.id}</span></div>
      <div class="d-row"><span>Total Pembayaran</span><span style="color:var(--gold-dark);font-size:0.9rem;">Rp ${(o.total||0).toLocaleString('id-ID')}</span></div>
      <div class="d-row"><span>Tanggal Pesan</span><span>${o.createdAt ? new Date(o.createdAt).toLocaleDateString('id-ID',{day:'numeric',month:'long',year:'numeric',hour:'2-digit',minute:'2-digit'}) : '-'}</span></div>
    </div>
    ${(o.status==='Menunggu Konfirmasi' && (Date.now() - new Date(o.createdAt).getTime())/1000 <= 300)?`<button class="cancel-btn" onclick="cancelOrder(${o.rawId});closeDrawer()">Batalkan Pesanan Ini</button>`:''
    }${o.status==='Selesai' ? `<div class="testi-box" id="testiBox-${o.rawId}"></div>` : ''}`;
  document.getElementById('drawerOverlay').classList.add('show');
  if (o.status === 'Selesai') loadTestimoni(o.rawId);
}
function closeDrawer(e) {
  if(!e||e.target===document.getElementById('drawerOverlay')) document.getElementById('drawerOverlay').classList.remove('show');
}

/* ── VIEW SWITCHER ──────────────────────────────────────── */
const VMETA = {
  beranda:['Beranda',          'Ringkasan aktivitas akun Anda'],
  pesan:  ['Buat Pesanan',     'Pilih beberapa menu sekaligus dalam satu pesanan'],
  riwayat:['Riwayat Pesanan',  'Pantau status semua pesanan Anda'],
  profil: ['Profil Saya',      'Kelola data akun Anda'],
  katalog:['Katalog Menu',     'Jelajahi semua menu yang tersedia di Dapurmelia_'],
};
function sv(id) {
  document.querySelectorAll('.view').forEach(v=>v.classList.remove('show'));

  document.querySelectorAll('.sb-nav a').forEach(a=>a.classList.remove('on'));
  document.getElementById('view-'+id).classList.add('show');
  document.querySelectorAll('.sb-nav a').forEach(a=>{ if(a.getAttribute('onclick')&&a.getAttribute('onclick').includes("'"+id+"'")) a.classList.add('on'); });
  document.getElementById('tbTitle').textContent = VMETA[id][0];
  document.getElementById('tbSub').textContent   = VMETA[id][1];
  if(id==='beranda') renderBeranda();
  if(id==='riwayat') renderRiwayat();
  if(id==='profil')  { document.getElementById('pfTot').textContent=ordersCache.length; document.getElementById('pfDone').textContent=ordersCache.filter(o=>o.status==='Selesai').length; }
  if(id==='pesan')   { renderCatalog(currentCatFilter); renderCart(); document.getElementById('step-checkout').style.display='none'; document.getElementById('step-catalog').style.display='block'; }
  if(id==='katalog') renderKatalog();
  window.scrollTo({top:0,behavior:'smooth'});
}

/* ── PROFIL SAVE ────────────────────────────────────────── */
function saveProfil(e) {
  const nama = document.getElementById('pf-nama').value;
  if(nama){sessionStorage.setItem('member_name',nama);['sbName','wbName','pfName'].forEach(id=>{const el=document.getElementById(id);if(el)el.textContent=nama;});['sbAv','pfAv'].forEach(id=>{const el=document.getElementById(id);if(el)el.textContent=nama.charAt(0).toUpperCase();});}
  const btn=e.target; btn.textContent='✓ Tersimpan!'; btn.style.background='var(--green)'; btn.style.color='#fff';
  setTimeout(()=>{btn.textContent='Simpan Perubahan';btn.style.background='';btn.style.color='';},2200);
}

/* ── UTILS ──────────────────────────────────────────────── */
function formatDate(d) {
  if(!d) return '—';
  return new Date(d+'T00:00:00').toLocaleDateString('id-ID',{day:'numeric',month:'long',year:'numeric'});
}

// Init
async function initPage() {
  try {
    const res  = await fetch('?page=member&action=menuPublik');
    const data = await res.json();
    if (data.success && data.data.length > 0) {
      MENU = data.data;
    }
  } catch(e) {
    console.error('Gagal memuat menu dari server:', e);
  }
  renderBeranda();
  renderCatalog();
  renderCart();
}
initPage();

/* \u2500\u2500 TESTIMONI \u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500\u2500 */
let testiRating = 5;

async function loadTestimoni(pesananId) {
  const box = document.getElementById(`testiBox-${pesananId}`);
  if (!box) return;
  box.innerHTML = `<div style="font-size:0.78rem;color:var(--muted);">Memuat...</div>`;

  try {
    const res  = await fetch(`?page=member&action=cekTestimoni&pesanan_id=${pesananId}`);
    const data = await res.json();

    if (data.data) {
      // Sudah pernah beri testimoni
      const stars = '\u2605'.repeat(data.data.rating) + '\u2606'.repeat(5 - data.data.rating);
      box.innerHTML = `
        <div class="testi-done">
          \u2705 Testimoni sudah diberikan<br>
          <span style="font-size:1.1rem;letter-spacing:2px;color:var(--gold);">${stars}</span><br>
          <span style="font-size:0.76rem;color:var(--muted);font-weight:400;">"${data.data.pesan}"</span>
        </div>`;
    } else {
      // Belum, tampilkan form
      testiRating = 5;
      box.innerHTML = `
        <h4>\u2b50 Berikan Testimoni</h4>
        <div class="star-row" id="starRow-${pesananId}">
          ${[1,2,3,4,5].map(i=>`<button class="star-btn on" data-val="${i}" onclick="setRating(${pesananId},${i})">\u2605</button>`).join('')}
        </div>
        <textarea class="testi-textarea" id="testiMsg-${pesananId}" placeholder="Bagaimana pengalaman Anda memesan di Dapurmelia_? Ceritakan di sini\u2026" maxlength="500"></textarea>
        <button class="testi-submit" onclick="submitTestimoni(${pesananId})">Kirim Testimoni \u2192</button>`;
    }
  } catch(e) {
    box.innerHTML = `<div style="font-size:0.78rem;color:red;">Gagal memuat.</div>`;
  }
}

function setRating(pesananId, val) {
  testiRating = val;
  document.querySelectorAll(`#starRow-${pesananId} .star-btn`).forEach(btn => {
    btn.classList.toggle('on', parseInt(btn.dataset.val) <= val);
  });
}

async function submitTestimoni(pesananId) {
  const msg  = document.getElementById(`testiMsg-${pesananId}`).value.trim();
  const btn  = document.querySelector(`#testiBox-${pesananId} .testi-submit`);
  if (!msg)  { alert('Tulis testimoni kamu dulu ya!'); return; }

  btn.disabled = true;
  btn.textContent = 'Mengirim\u2026';

  try {
    const res  = await fetch('?page=member&action=simpanTestimoni', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ pesanan_id: pesananId, rating: testiRating, pesan: msg })
    });
    const data = await res.json();
    if (data.success) {
      loadTestimoni(pesananId);
    } else {
      alert(data.message || 'Gagal mengirim testimoni.');
      btn.disabled = false;
      btn.textContent = 'Kirim Testimoni →';
    }
  } catch(e) {
    alert('Koneksi bermasalah. Silakan coba lagi.');
    btn.disabled = false;
    btn.textContent = 'Kirim Testimoni →';
  }
}

/* ── KATALOG ─────────────────────────────────────────────── */
let katalogFilter = 'semua';

function renderKatalog(cat) {
  if (cat !== undefined) katalogFilter = cat;
  const grid = document.getElementById('katalog-grid');
  if (!grid) return;
  const filtered = katalogFilter === 'semua' ? MENU : MENU.filter(m => m.cat === katalogFilter);

  // Update active filter button
  document.querySelectorAll('.katalog-filter-btn').forEach(b => {
    b.classList.toggle('kat-active', b.dataset.cat === katalogFilter);
  });

  if (!filtered.length) {
    grid.innerHTML = `<div class="empty"><span>🍱</span><p>Belum ada menu di kategori ini.</p></div>`;
    return;
  }

  const fmt = n => 'Rp ' + Number(n).toLocaleString('id-ID');
  grid.innerHTML = filtered.map(m => `
    <div class="kat-card">
      <div class="kat-img-wrap">
        <img src="${m.img}" alt="${m.name}" loading="lazy" onerror="this.src='https://via.placeholder.com/300x200?text=No+Image'">
        <span class="kat-badge">${m.cat.charAt(0).toUpperCase()+m.cat.slice(1)}</span>
      </div>
      <div class="kat-body">
        <div class="kat-name">${m.name}</div>
        <div class="kat-price">${fmt(m.price)} <span class="kat-unit">/ ${m.unit}</span></div>
        <button class="kat-order-btn" onclick="sv('pesan')">🛒 Pesan Sekarang</button>
      </div>
    </div>
  `).join('');
}

</script>
</body>
</html>