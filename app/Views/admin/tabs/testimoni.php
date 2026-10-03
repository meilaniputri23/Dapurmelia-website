    <div class="view" id="view-testimoni">
      <div class="str">
        <div class="stitle">Kelola Testimoni</div>
        <div class="search-box"><span>🔍</span><input type="text" id="testi-search" placeholder="Cari nama atau ulasan..." oninput="renderTestimoniCards()"></div>
      </div>

      <!-- Rating Overview (ala Google Play) -->
      <div class="testi-overview" id="testi-overview">
        <div class="testi-ov-left">
          <div class="testi-big-score" id="testi-big-score">—</div>
          <div class="testi-big-stars" id="testi-big-stars"></div>
          <div class="testi-big-total" id="testi-big-total">0 ulasan</div>
        </div>
        <div class="testi-ov-bars" id="testi-ov-bars">
          <!-- diisi JS -->
        </div>
      </div>

      <!-- Filter bintang -->
      <div class="testi-filter-bar">
        <button class="testi-filter-btn tf-active" data-r="0" onclick="filterTesti(0)">Semua</button>
        <button class="testi-filter-btn" data-r="5" onclick="filterTesti(5)">★ 5</button>
        <button class="testi-filter-btn" data-r="4" onclick="filterTesti(4)">★ 4</button>
        <button class="testi-filter-btn" data-r="3" onclick="filterTesti(3)">★ 3</button>
        <button class="testi-filter-btn" data-r="2" onclick="filterTesti(2)">★ 2</button>
        <button class="testi-filter-btn" data-r="1" onclick="filterTesti(1)">★ 1</button>
      </div>

      <!-- List kartu ulasan -->
      <div id="testi-cards-list">
        <div class="testi-empty">Memuat ulasan...</div>
      </div>
    </div><!-- end view-testimoni -->
