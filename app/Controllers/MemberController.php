<?php
// ============================================================
//  Controllers/MemberController.php
//  Menangani semua kebutuhan halaman member
//  URL: ?page=member&action=index | profil | pesanan | buat | updateProfil | gantiPassword
// ============================================================

require_once __DIR__ . '/../Core/Controller.php';
require_once __DIR__ . '/../Models/UserModel.php';
require_once __DIR__ . '/../Models/PesananModel.php';
require_once __DIR__ . '/../Models/MenuModel.php';

class MemberController extends Controller {

    // ── GET: render halaman member ───────────────────────────
    public function index(): void {
        $this->requireLogin();

        $user  = UserModel::findById($_SESSION['user_id']);
        $menus = MenuModel::getAll();

        $this->view('member/index', [
            'title' => 'Akun Saya — Dapurmelia_',
            'user'  => $user,
            'menus' => $menus,
        ], 'none');
    }

    // ── GET API: data profil ─────────────────────────────────
    public function profil(): void {
        $this->requireLogin();
        $user = UserModel::findById($_SESSION['user_id']);
        if (!$user) { $this->json(['success' => false, 'message' => 'User tidak ditemukan.'], 404); }
        $this->json(['success' => true, 'data' => $user]);
    }

    // ── GET API: daftar menu publik (dari database) ──────────
    public function menuPublik(): void {
        $this->requireLogin();
        $menus = MenuModel::getAll();
        // Mapping ke format yang dipakai front-end member
        $data = array_map(function($m) {
            return [
                'id'    => 'm' . $m['id'],   // prefix 'm' agar konsisten dg cart key
                'db_id' => (int) $m['id'],
                'name'  => $m['nama_menu'],
                'cat'   => strtolower($m['kategori'] ?? 'lainnya'),
                'price' => (float) $m['harga'],
                'unit'  => ltrim($m['satuan'] ?? 'pcs', '/'),
                'img'   => $m['gambar'] ?: 'https://via.placeholder.com/300x225?text=No+Image',
                'badge' => null,
            ];
        }, $menus);
        $this->json(['success' => true, 'data' => $data]);
    }

    // ── GET API: riwayat pesanan ─────────────────────────────
    public function pesanan(): void {
        $this->requireLogin();
        $data = PesananModel::getByUserId($_SESSION['user_id']);
        $this->json(['success' => true, 'data' => $data]);
    }

    // ── POST API: buat pesanan baru ──────────────────────────
    public function buat(): void {
        $this->requireLogin();
        $body  = $this->getBody();
        $items = $body['items'] ?? [];

        if (empty($body['hp']) || empty($items)) {
            $this->json(['success' => false, 'message' => 'No. HP dan item pesanan wajib diisi.'], 400);
        }

        try {
            $pesananId = PesananModel::create(
                $_SESSION['user_id'],
                [
                    'nama'             => $body['nama']             ?? $_SESSION['user_nama'],
                    'hp'               => $body['hp'],
                    'alamat'           => $body['alamat']           ?? '',
                    'catatan'          => $body['catatan']          ?? '',
                    'jenis_acara'      => $body['jenis_acara']      ?? '',
                    'tanggal_acara'    => $body['tanggal_acara']    ?: null,
                    'waktu_pengiriman' => $body['waktu_pengiriman'] ?? '',
                    'metode_bayar'     => $body['metode_bayar']     ?? '',
                ],
                $items
            );

            $this->json(['success' => true, 'pesanan_id' => $pesananId]);
        } catch (\Throwable $e) {
            $this->json(['success' => false, 'message' => 'Gagal menyimpan pesanan: ' . $e->getMessage()], 500);
        }
    }

    // ── POST API: batalkan pesanan milik sendiri ─────────────
    public function batalkan(): void {
        $this->requireLogin();
        $body = $this->getBody();
        $id   = (int) ($body['id'] ?? 0);

        if (!$id) {
            $this->json(['success' => false, 'message' => 'ID tidak valid.'], 400);
        }

        // Pastikan pesanan ini milik user yang login
        $pesanan = PesananModel::getWithDetail($id);
        if (!$pesanan || (int)$pesanan['user_id'] !== (int)$_SESSION['user_id']) {
            $this->json(['success' => false, 'message' => 'Pesanan tidak ditemukan.'], 404);
        }
        if ($pesanan['status'] !== 'Baru') {
            $this->json(['success' => false, 'message' => 'Pesanan tidak dapat dibatalkan.'], 400);
        }

        // ── Cek batas waktu pembatalan: maksimal 5 menit sejak pesanan dibuat ──
        $createdAt  = new \DateTime($pesanan['created_at']);
        $now        = new \DateTime();
        $selisihDetik = ($now->getTimestamp() - $createdAt->getTimestamp());
        if ($selisihDetik > 300) { // 300 detik = 5 menit
            $this->json(['success' => false, 'message' => 'Pesanan sudah tidak bisa dibatalkan karena lebih dari 5 menit.'], 400);
        }

        PesananModel::updateStatus($id, 'Dibatalkan');
        $this->json(['success' => true]);
    }

    // ── POST API: update profil ──────────────────────────────
    public function updateProfil(): void {
        $this->requireLogin();
        $body = $this->getBody();
        $nama = trim($body['nama'] ?? '');
        $hp   = trim($body['hp']   ?? '');

        if (!$nama) {
            $this->json(['success' => false, 'message' => 'Nama tidak boleh kosong.'], 400);
        }

        UserModel::updateProfile($_SESSION['user_id'], $nama, $hp);
        $_SESSION['user_nama'] = $nama;
        $this->json(['success' => true, 'nama' => $nama]);
    }

    // ── POST API: ganti password ─────────────────────────────
    public function gantiPassword(): void {
        $this->requireLogin();
        $body     = $this->getBody();
        $passLama = $body['pass_lama'] ?? '';
        $passBaru = $body['pass_baru'] ?? '';

        if (strlen($passBaru) < 8) {
            $this->json(['success' => false, 'message' => 'Password baru minimal 8 karakter.'], 400);
        }

        $user = UserModel::findByEmail($_SESSION['user_email']);
        if (!UserModel::verifyPassword($passLama, $user['password'])) {
            $this->json(['success' => false, 'message' => 'Password lama salah.'], 401);
        }

        UserModel::updatePassword($_SESSION['user_id'], $passBaru);
        $this->json(['success' => true, 'message' => 'Password berhasil diubah.']);
    }

    // ── GET API: cek testimoni pesanan ──────────────────────
    public function cekTestimoni(): void {
        $this->requireLogin();
        require_once __DIR__ . '/../Models/TestimoniModel.php';
        $id = (int) ($_GET['pesanan_id'] ?? 0);
        try {
            $data = $id ? TestimoniModel::getByPesanan($id) : null;
            $this->json(['success' => true, 'data' => $data]);
        } catch (\Throwable $e) {
            // Tabel belum ada / error lain — kembalikan null agar form tetap muncul
            $this->json(['success' => true, 'data' => null]);
        }
    }

    // ── POST API: simpan testimoni ───────────────────────────
    public function simpanTestimoni(): void {
        $this->requireLogin();
        require_once __DIR__ . '/../Models/TestimoniModel.php';
        $body      = $this->getBody();
        $pesananId = (int) ($body['pesanan_id'] ?? 0);
        $rating    = max(1, min(5, (int) ($body['rating'] ?? 5)));
        $pesan     = trim($body['pesan'] ?? '');

        if (!$pesananId || !$pesan) {
            $this->json(['success' => false, 'message' => 'Data tidak lengkap.'], 400);
            return;
        }

        // Pastikan pesanan milik user ini & statusnya Selesai
        $pesanan = PesananModel::getWithDetail($pesananId);
        if (!$pesanan || (int)$pesanan['user_id'] !== (int)$_SESSION['user_id']) {
            $this->json(['success' => false, 'message' => 'Pesanan tidak ditemukan.'], 404);
            return;
        }
        if ($pesanan['status'] !== 'Selesai') {
            $this->json(['success' => false, 'message' => 'Hanya pesanan selesai yang dapat diberi testimoni.'], 400);
            return;
        }

        // Cek sudah pernah kasih testimoni belum
        if (TestimoniModel::getByPesanan($pesananId)) {
            $this->json(['success' => false, 'message' => 'Testimoni sudah pernah diberikan untuk pesanan ini.'], 400);
            return;
        }

        try {
            TestimoniModel::create($pesananId, (int)$_SESSION['user_id'], $rating, $pesan);
            $this->json(['success' => true, 'message' => 'Terima kasih atas testimoni Anda!']);
        } catch (\Throwable $e) {
            $this->json(['success' => false, 'message' => 'Gagal menyimpan testimoni: ' . $e->getMessage()], 500);
        }
    }

}
