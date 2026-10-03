<?php
// ============================================================
//  Controllers/HomeController.php
//  Menangani halaman utama (index.html)
//  URL: ?page=home atau / (root)
// ============================================================

require_once __DIR__ . '/../Core/Controller.php';

class HomeController extends Controller {

    public function index(): void {
        // Ambil testimoni yang visible dari database
        $testimoni = [];
        try {
            require_once __DIR__ . '/../Models/TestimoniModel.php';
            $testimoni = TestimoniModel::getVisible();
        } catch (\Throwable $e) {
            // Jika tabel belum ada, halaman tetap tampil (kosong)
            $testimoni = [];
        }

        $this->view('home/index', [
            'title'     => 'Dapurmelia_ — Snack & Catering Premium',
            'testimoni' => $testimoni,
        ], 'none');
    }
}
