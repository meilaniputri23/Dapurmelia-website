    <div class="view" id="view-menu">
      <div class="str"><div class="stitle">Kelola Menu</div><button class="btn-sm" onclick="openMenuModal()">+ Tambah Menu Baru</button></div>
      <div class="menu-admin-grid" id="menu-admin-grid">
        <div style="padding:2rem;text-align:center;color:var(--muted);">Memuat data...</div>
      </div>
    </div><!-- end view-menu -->

    <!-- ════════════════════════════════════════════════════
         MODAL: DETAIL PESANAN (ADMIN)
    ════════════════════════════════════════════════════ -->
    <div class="modal-overlay" id="detail-pesanan-overlay" onclick="tutupDetailPesanan(event)">
      <div class="modal-box" style="max-width:560px;max-height:90vh;overflow-y:auto;" onclick="event.stopPropagation()">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1.2rem;">
          <h3 style="margin:0;" id="detail-pesanan-title">Detail Pesanan</h3>
          <button onclick="tutupDetailPesanan()" style="background:none;border:none;font-size:1.4rem;cursor:pointer;color:var(--muted);">✕</button>
        </div>
        <div id="detail-pesanan-body">
          <div style="text-align:center;padding:2rem;color:var(--muted);">Memuat...</div>
        </div>
      </div>
    </div>

    <!-- ════════════════════════════════════════════════════
         MODAL: TAMBAH / EDIT MENU
    ════════════════════════════════════════════════════ -->
    <div class="modal-overlay" id="menu-modal-overlay">
      <div class="modal-box">
        <h3 id="menu-modal-title">Tambah Menu Baru</h3>
        <input type="hidden" id="menu-id">
        <label>Nama Menu</label>
        <input type="text" id="menu-nama">
        <label>Kategori</label>
        <input type="text" id="menu-kategori" placeholder="Snack, Catering, Dessert, dll">
        <label>Deskripsi</label>
        <textarea id="menu-deskripsi"></textarea>
        <label>Harga (Rp)</label>
        <input type="number" id="menu-harga" min="0">
        <label>Satuan</label>
        <input type="text" id="menu-satuan" placeholder="/pcs">
        <label>URL Gambar</label>
        <input type="text" id="menu-gambar" placeholder="https://...">
        <label style="margin-top:0.5rem;">— atau Upload Gambar dari File —</label>
        <div id="upload-area" style="border:2px dashed var(--tan);border-radius:8px;padding:1rem;text-align:center;cursor:pointer;transition:all 0.2s;background:var(--beige);" onclick="document.getElementById('menu-file').click()" ondragover="event.preventDefault();this.style.borderColor='var(--gold-dark)'" ondragleave="this.style.borderColor='var(--tan)'" ondrop="handleDrop(event)">
          <div id="upload-preview" style="display:none;margin-bottom:0.5rem;">
            <img id="upload-img-preview" src="" style="max-height:100px;border-radius:6px;object-fit:cover;">
          </div>
          <div id="upload-placeholder">
            <div style="font-size:2rem;">📷</div>
            <div style="font-size:0.82rem;color:var(--muted);margin-top:0.3rem;">Klik atau drag foto ke sini</div>
            <div style="font-size:0.75rem;color:var(--muted);">JPG, PNG, WEBP — maks 2MB</div>
          </div>
          <div id="upload-status" style="font-size:0.8rem;margin-top:0.4rem;color:var(--gold-dark);display:none;"></div>
        </div>
        <input type="file" id="menu-file" accept="image/jpeg,image/png,image/webp" style="display:none" onchange="handleFileSelect(this)">
        <label>Status</label>
        <select id="menu-aktif">
          <option value="1">Aktif</option>
          <option value="0">Nonaktif</option>
        </select>
        <div class="modal-acts">
          <button class="modal-cancel" onclick="closeMenuModal()">Batal</button>
          <button class="modal-save" onclick="simpanMenu()">Simpan</button>
        </div>
      </div>
    </div>

