/* ============================================================
   DAPURMELIA_ — app.js (VERSI DINAMIS)
   Perubahan dari versi lama:
   - Tambah fungsi loadMenuDariDB() untuk ambil data dari PHP
   - Halaman menu sekarang tampil dari database, bukan hardcode
   - Semua fungsi lain (routing, nav, filter) tetap sama
   ============================================================ */

// ── Page Router ─────────────────────────────────────────────
const PAGES = ["home", "menu", "about", "contact"];

function showPage(id) {
  document
    .querySelectorAll(".page")
    .forEach((p) => p.classList.remove("active"));
  document
    .querySelectorAll(".nav-links a")
    .forEach((a) => a.classList.remove("active"));

  const page = document.getElementById("page-" + id);
  if (page) {
    page.classList.add("active");
    window.scrollTo({ top: 0, behavior: "smooth" });

    const link = document.querySelector(`.nav-links a[data-page="${id}"]`);
    if (link) link.classList.add("active");

    setTimeout(() => initReveal(page), 60);

    // ── BARU: Kalau buka halaman menu, ambil data dari database
    if (id === "menu") {
      loadMenuDariDB();
    }
  }

  history.pushState(null, "", "#" + id);
}

// ── FUNGSI BARU: Ambil data menu dari database via PHP ───────
function loadMenuDariDB() {
  const grid = document.getElementById("mgrid");

  // Tampilkan loading dulu
  grid.innerHTML = `
    <div style="grid-column:1/-1;text-align:center;padding:3rem;color:var(--muted);">
      <div style="font-size:1.5rem;margin-bottom:0.5rem;">⏳</div>
      <p style="font-size:0.85rem;">Memuat menu...</p>
    </div>`;

  // Fetch data dari api_menu.php
  // Ganti URL di bawah jika folder berbeda
  fetch("?page=menu&action=index")
    .then((response) => {
      if (!response.ok) throw new Error("Gagal terhubung ke server");
      return response.json();
    })
    .then((menus) => {
      if (menus.length === 0) {
        grid.innerHTML = `
          <div style="grid-column:1/-1;text-align:center;padding:3rem;color:var(--muted);">
            <p>Belum ada menu tersedia.</p>
          </div>`;
        return;
      }

      // Simpan data global untuk filter tabs
      window._allMenus = menus;
      renderMenuCards(menus);

      // Reset filter tab ke "Semua"
      document.querySelectorAll(".ftab").forEach((t) => t.classList.remove("on"));
      document.querySelector(".ftab").classList.add("on");
    })
    .catch((err) => {
      // Kalau fetch gagal (misal jalankan langsung dari file, bukan localhost)
      // fallback ke data statis
      console.warn("API tidak tersedia, pakai data statis:", err.message);
      renderMenuStatis();
    });
}

// ── Render kartu menu dari data array ───────────────────────
function renderMenuCards(menus) {
  const grid = document.getElementById("mgrid");

  // Mapping kategori database → data-c untuk filter
  const katMap = {
    Snack:       "snack",
    Catering:    "catering",
    Dessert:     "dessert",
    "Nasi Kotak":"catering",
    Paket:       "catering",
  };

  // Mapping kategori → gambar default (kalau tidak ada gambar di DB)
  const imgDefault = {
    snack:    "https://i.pinimg.com/1200x/5e/3d/51/5e3d51622e72eb06fbb39fe89a769086.jpg",
    catering: "https://i.pinimg.com/1200x/f6/2b/67/f62b67ac108f21e3dcf1780318d1c8a6.jpg",
    dessert:  "https://i.pinimg.com/736x/ce/c0/a9/cec0a9788d0e997e27414f6b1ad1b305.jpg",
  };

  grid.innerHTML = menus
    .map((m) => {
      const katFilter = katMap[m.kategori] || "snack";
      const harga     = Number(m.harga).toLocaleString("id-ID");
      // Pakai gambar dari DB kalau ada, kalau tidak pakai default
      const gambar    = m.gambar || imgDefault[katFilter] || imgDefault.snack;

      return `
      <div class="mcard rv" data-c="${katFilter}">
        <div class="mcard-img">
          <img src="${gambar}" alt="${m.nama_menu}" loading="lazy">
        </div>
        <div class="mcard-body">
          <div class="mcat">${m.kategori}</div>
          <div class="mname">${m.nama_menu}</div>
          <div class="mdesc">${m.deskripsi || ""}</div>
          <div class="mfoot">
            <div class="mprice">Rp ${harga} <span>${m.satuan}</span></div>
            <a href="#contact" class="mbtn" onclick="showPage('contact');return false;">Pesan</a>
          </div>
        </div>
      </div>`;
    })
    .join("");

  // Jalankan animasi reveal
  setTimeout(() => {
    const page = document.getElementById("page-menu");
    if (page) initReveal(page);
  }, 60);
}

// ── Filter tab menu (bekerja dengan data dari DB) ────────────
function fmenu(cat, btn) {
  document.querySelectorAll(".ftab").forEach((t) => t.classList.remove("on"));
  btn.classList.add("on");

  // Kalau ada data dari DB, filter dari sana
  if (window._allMenus) {
    const filtered =
      cat === "all"
        ? window._allMenus
        : window._allMenus.filter((m) => {
            const katMap = { Snack:"snack", Catering:"catering", Dessert:"dessert", "Nasi Kotak":"catering", Paket:"catering" };
            return (katMap[m.kategori] || "snack") === cat;
          });
    renderMenuCards(filtered);
  } else {
    // Fallback: sembunyikan/tampilkan card yang sudah ada
    document.querySelectorAll(".mcard").forEach((c) => {
      c.style.display = cat === "all" || c.dataset.c === cat ? "" : "none";
    });
  }
}

// ── Fallback: data statis jika PHP tidak tersedia ────────────
// (Ini sama persis dengan menu di index.html kamu sebelumnya)
function renderMenuStatis() {
  const grid = document.getElementById("mgrid");
  grid.innerHTML = `
    <div class="mcard rv" data-c="snack"><div class="mcard-img"><img src="https://i.pinimg.com/1200x/5e/3d/51/5e3d51622e72eb06fbb39fe89a769086.jpg" alt="Risol Mayo" loading="lazy"><div class="mbadge">Bestseller</div></div><div class="mcard-body"><div class="mcat">Snack Tradisional</div><div class="mname">Risol Mayo Spesial</div><div class="mdesc">Kulit tipis renyah, isian creamy mayo dengan wortel &amp; daging sapi pilihan.</div><div class="mfoot"><div class="mprice">Rp 3.500 <span>/pcs</span></div><a href="#contact" class="mbtn" onclick="showPage('contact');return false;">Pesan</a></div></div></div>
    <div class="mcard rv" data-c="snack"><div class="mcard-img"><img src="https://i.pinimg.com/736x/9c/3a/0f/9c3a0f6cfdae3d8d2bbe13f6e4231c49.jpg" alt="Onde-onde" loading="lazy"></div><div class="mcard-body"><div class="mcat">Snack Tradisional</div><div class="mname">Onde-onde Kacang Hijau</div><div class="mdesc">Bulat lembut berbalut wijen, isian kacang hijau manis resep turun-temurun.</div><div class="mfoot"><div class="mprice">Rp 3.000 <span>/pcs</span></div><a href="#contact" class="mbtn" onclick="showPage('contact');return false;">Pesan</a></div></div></div>
    <div class="mcard rv" data-c="snack"><div class="mcard-img"><img src="https://i.pinimg.com/1200x/37/63/7f/37637f82ed9ecb1843e4873b48a7409f.jpg" alt="Sosis Solo" loading="lazy"><div class="mbadge">Favorit</div></div><div class="mcard-body"><div class="mcat">Snack Tradisional</div><div class="mname">Sosis Solo Ayam</div><div class="mdesc">Dadar tipis halus, isian ragout ayam berbumbu rempah yang khas.</div><div class="mfoot"><div class="mprice">Rp 4.000 <span>/pcs</span></div><a href="#contact" class="mbtn" onclick="showPage('contact');return false;">Pesan</a></div></div></div>
    <div class="mcard rv" data-c="catering"><div class="mcard-img"><img src="https://i.pinimg.com/1200x/f6/2b/67/f62b67ac108f21e3dcf1780318d1c8a6.jpg" alt="Nasi Kotak" loading="lazy"><div class="mbadge">Popular</div></div><div class="mcard-body"><div class="mcat">Nasi Kotak</div><div class="mname">Nasi Kotak Premium</div><div class="mdesc">Nasi putih pulen + lauk lengkap, dikemas elegan untuk acara &amp; hajatan.</div><div class="mfoot"><div class="mprice">Rp 35.000 <span>/box</span></div><a href="#contact" class="mbtn" onclick="showPage('contact');return false;">Pesan</a></div></div></div>
    <div class="mcard rv" data-c="dessert"><div class="mcard-img"><img src="https://i.pinimg.com/736x/ce/c0/a9/cec0a9788d0e997e27414f6b1ad1b305.jpg" alt="Donat" loading="lazy"><div class="mbadge">New!</div></div><div class="mcard-body"><div class="mcat">Dessert</div><div class="mname">Donat Premium</div><div class="mdesc">Kenyal lembut dengan varian: red velvet, matcha, &amp; taro cream.</div><div class="mfoot"><div class="mprice">Rp 6.000 <span>/pcs</span></div><a href="#contact" class="mbtn" onclick="showPage('contact');return false;">Pesan</a></div></div></div>`;
}

// ── Reveal on scroll / on show ───────────────────────────────
function initReveal(root) {
  const rvs = root.querySelectorAll(".rv:not(.in)");
  const obs = new IntersectionObserver(
    (entries) => {
      entries.forEach((e, i) => {
        if (e.isIntersecting) {
          setTimeout(() => e.target.classList.add("in"), i * 55);
          obs.unobserve(e.target);
        }
      });
    },
    { threshold: 0.08 }
  );
  rvs.forEach((el) => obs.observe(el));
}

// ── Nav scroll effect ────────────────────────────────────────
function initNav() {
  const nav = document.getElementById("nav");
  window.addEventListener("scroll", () => {
    nav.classList.toggle("scrolled", window.scrollY > 60);
  });
}

// ── Mobile nav ───────────────────────────────────────────────
function openMob() {
  document.getElementById("mobNav").classList.add("open");
}
function closeMob() {
  document.getElementById("mobNav").classList.remove("open");
}
function goPage(id) {
  closeMob();
  showPage(id);
}

// ── Handle browser back/forward ──────────────────────────────
window.addEventListener("popstate", () => {
  const id = location.hash.replace("#", "") || "home";
  if (PAGES.includes(id)) showPage(id);
});

// ── Init on load ─────────────────────────────────────────────
document.addEventListener("DOMContentLoaded", () => {
  initNav();
  const startPage = location.hash.replace("#", "") || "home";
  showPage(PAGES.includes(startPage) ? startPage : "home");
});
