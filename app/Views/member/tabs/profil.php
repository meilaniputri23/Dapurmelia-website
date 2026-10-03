    <!-- ══════════════════════════════════════════════════
         VIEW: PROFIL
    ══════════════════════════════════════════════════ -->
    <div class="view" id="view-profil">
      <div class="str"><div class="stitle">Profil Saya</div></div>
      <div class="profile-wrap">
        <div class="profile-card">
          <div class="pf-av" id="pfAv">?</div>
          <div class="pf-name" id="pfName">Pelanggan</div>
          <div class="pf-email" id="pfEmail">—</div>
          <div class="pf-stat">
            <div class="pf-stat-item"><div class="pf-stat-val" id="pfTot">0</div><div class="pf-stat-lbl">Pesanan</div></div>
            <div class="pf-stat-item"><div class="pf-stat-val" id="pfDone">0</div><div class="pf-stat-lbl">Selesai</div></div>
            <div class="pf-stat-item"><div class="pf-stat-val">5.0</div><div class="pf-stat-lbl">Rating</div></div>
          </div>
          <div class="pf-since">📅 Member sejak Mei 2025</div>
        </div>
        <div>
          <div class="profile-card">
            <div style="font-family:var(--serif);font-size:1rem;font-weight:600;color:var(--dark);margin-bottom:1.1rem;">Edit Profil</div>
            <div class="frow2">
              <div class="fgroup"><label class="flabel">Nama Lengkap</label><input type="text" class="finput" id="pf-nama" placeholder="Nama lengkap"></div>
              <div class="fgroup"><label class="flabel">No. WhatsApp</label><input type="tel" class="finput" placeholder="08xx-xxxx-xxxx"></div>
            </div>
            <div class="fgroup"><label class="flabel">Email</label><input type="email" class="finput" id="pf-email-input" placeholder="email@contoh.com"></div>
            <div class="fgroup"><label class="flabel">Alamat Default</label><input type="text" class="finput" id="pf-alamat-def" placeholder="Jl. Rumah No. 1, Surabaya"></div>
            <div class="fgroup"><label class="flabel">Password Baru (kosongkan jika tidak diubah)</label><input type="password" class="finput" placeholder="••••••••"></div>
            <button class="flow-next" onclick="saveProfil(event)" style="width:100%;margin-top:0.5rem;">Simpan Perubahan</button>
          </div>
        </div>
      </div>
    </div>

