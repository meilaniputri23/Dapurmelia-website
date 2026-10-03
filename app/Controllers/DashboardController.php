<?php
// ============================================================
//  Controllers/DashboardController.php
//  Menangani semua kebutuhan admin dashboard
//  URL: ?page=dashboard&action=index | stats | pesanan | updateStatus | members | menuList | menuTambah | menuHapus
// ============================================================

require_once __DIR__ . '/../Core/Controller.php';
require_once __DIR__ . '/../Models/UserModel.php';
require_once __DIR__ . '/../Models/MenuModel.php';
require_once __DIR__ . '/../Models/PesananModel.php';

class DashboardController extends Controller {

    // ── GET: render halaman dashboard admin ──────────────────
    public function index(): void {
        $this->requireAdmin();

        $this->view('admin/dashboard', [
            'title' => 'Dashboard Admin — Dapurmelia_',
            'user'  => [
                'nama'  => $_SESSION['user_nama'],
                'email' => $_SESSION['user_email'],
            ],
        ], 'none');
    }

    // ── GET API: statistik ringkas ───────────────────────────
    public function stats(): void {
        $this->requireAdmin();
        header('Cache-Control: no-store, no-cache, must-revalidate');
        header('Pragma: no-cache');
        $stats = PesananModel::getStats();
        $this->json(array_merge(['success' => true], $stats));
    }

    // ── GET API: semua pesanan ───────────────────────────────
    public function pesanan(): void {
        $this->requireAdmin();
        header('Cache-Control: no-store, no-cache, must-revalidate');
        header('Pragma: no-cache');
        $data = PesananModel::getAll();
        $this->json(['success' => true, 'data' => $data]);
    }

    // ── GET API: detail satu pesanan (popup admin) ───────────
    public function pesananDetail(): void {
        $this->requireAdmin();
        $id = (int) ($_GET['id'] ?? 0);
        if (!$id) {
            $this->json(['success' => false, 'message' => 'ID tidak valid.'], 400);
        }
        $data = PesananModel::getDetailLengkap($id);
        if (!$data) {
            $this->json(['success' => false, 'message' => 'Pesanan tidak ditemukan.'], 404);
        }
        $this->json(['success' => true, 'data' => $data]);
    }

    // ── POST API: update status pesanan ─────────────────────
    public function updateStatus(): void {
        $this->requireAdmin();
        $body   = $this->getBody();
        $id     = (int) ($body['id']     ?? 0);
        $status =        $body['status'] ?? '';

        if (!$id || !$status) {
            $this->json(['success' => false, 'message' => 'ID dan status wajib diisi.'], 400);
        }

        try {
            PesananModel::updateStatus($id, $status);
            $this->json(['success' => true]);
        } catch (\InvalidArgumentException $e) {
            $this->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }

    // ── GET API: laporan pendapatan ──────────────────────────
    public function laporan(): void {
        $this->requireAdmin();
        $data = PesananModel::getLaporan();
        $this->json(['success' => true, 'data' => $data]);
    }

    // ── GET API: daftar member ───────────────────────────────
    public function members(): void {
        $this->requireAdmin();
        $data = UserModel::getAllMembers();
        $this->json(['success' => true, 'data' => $data]);
    }

    // ── GET API: daftar menu (admin) ─────────────────────────
    public function menuList(): void {
        $this->requireAdmin();
        $data = MenuModel::getAllAdmin();
        $this->json(['success' => true, 'data' => $data]);
    }

    // ── POST API: upload gambar menu ─────────────────────────
    public function menuUploadGambar(): void {
        $this->requireAdmin();

        if (empty($_FILES['gambar'])) {
            $this->json(['success' => false, 'message' => 'Tidak ada file yang dikirim.'], 400);
        }

        $file    = $_FILES['gambar'];
        $allowed = ['image/jpeg', 'image/png', 'image/webp'];
        $maxSize = 2 * 1024 * 1024; // 2MB

        if (!in_array($file['type'], $allowed)) {
            $this->json(['success' => false, 'message' => 'Format harus JPG, PNG, atau WEBP.'], 400);
        }

        if ($file['size'] > $maxSize) {
            $this->json(['success' => false, 'message' => 'Ukuran file maksimal 2MB.'], 400);
        }

        if ($file['error'] !== UPLOAD_ERR_OK) {
            $this->json(['success' => false, 'message' => 'Terjadi kesalahan saat upload.'], 500);
        }

        // Buat nama file unik
        $ext      = pathinfo($file['name'], PATHINFO_EXTENSION) ?: 'jpg';
        $filename = 'menu_' . time() . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
        $uploadDir = BASE_PATH . '/assets/menu/';

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        if (!move_uploaded_file($file['tmp_name'], $uploadDir . $filename)) {
            $this->json(['success' => false, 'message' => 'Gagal menyimpan file.'], 500);
        }

        $url = BASE_URL . '/assets/menu/' . $filename;
        $this->json(['success' => true, 'url' => $url]);
    }

    // ── POST API: tambah menu baru ───────────────────────────
    public function menuTambah(): void {
        $this->requireAdmin();
        $body = $this->getBody();

        if (empty($body['nama_menu']) || empty($body['harga'])) {
            $this->json(['success' => false, 'message' => 'Nama menu dan harga wajib diisi.'], 400);
        }

        $newId = MenuModel::create($body);
        $this->json(['success' => true, 'id' => $newId]);
    }

    // ── POST API: edit menu ───────────────────────────────────
    public function menuEdit(): void {
        $this->requireAdmin();
        $body = $this->getBody();
        $id   = (int) ($body['id'] ?? 0);

        if (!$id) {
            $this->json(['success' => false, 'message' => 'ID menu tidak valid.'], 400);
        }

        MenuModel::update($id, $body);
        $this->json(['success' => true]);
    }

    // ── POST API: hapus menu ─────────────────────────────────
    public function menuHapus(): void {
        $this->requireAdmin();
        $body = $this->getBody();
        $id   = (int) ($body['id'] ?? 0);

        if (!$id) {
            $this->json(['success' => false, 'message' => 'ID tidak valid.'], 400);
        }

        MenuModel::delete($id);
        $this->json(['success' => true]);
    }

    // ── GET API: semua testimoni (admin) ─────────────────────
    public function testimoniList(): void {
        $this->requireAdmin();
        require_once __DIR__ . '/../Models/TestimoniModel.php';
        try {
            $data = TestimoniModel::getAll();
            $this->json(['success' => true, 'data' => $data]);
        } catch (\Throwable $e) {
            $this->json(['success' => false, 'message' => 'Tabel testimoni belum ada: ' . $e->getMessage()], 500);
        }
    }

    // ── POST API: hapus testimoni (admin) ────────────────────
    public function testimoniHapus(): void {
        $this->requireAdmin();
        require_once __DIR__ . '/../Models/TestimoniModel.php';
        $body = $this->getBody();
        $id   = (int) ($body['id'] ?? 0);
        if (!$id) {
            $this->json(['success' => false, 'message' => 'ID tidak valid.'], 400);
        }
        try {
            TestimoniModel::delete($id);
            $this->json(['success' => true]);
        } catch (\Throwable $e) {
            $this->json(['success' => false, 'message' => 'Gagal hapus: ' . $e->getMessage()], 500);
        }
    }

    // ── POST API: toggle visible testimoni (admin) ────────────
    public function testimoniToggle(): void {
        $this->requireAdmin();
        require_once __DIR__ . '/../Models/TestimoniModel.php';
        $body = $this->getBody();
        $id   = (int) ($body['id'] ?? 0);
        if (!$id) {
            $this->json(['success' => false, 'message' => 'ID tidak valid.'], 400);
        }
        try {
            TestimoniModel::toggleVisible($id);
            $this->json(['success' => true]);
        } catch (\Throwable $e) {
            $this->json(['success' => false, 'message' => 'Gagal toggle: ' . $e->getMessage()], 500);
        }
    }
}
