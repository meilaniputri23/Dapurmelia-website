<?php
// ============================================================
//  Controllers/MenuController.php
//  Menangani: daftar menu aktif (publik, dipanggil app.js)
//  URL: ?page=menu&action=index  → JSON list menu
// ============================================================

require_once __DIR__ . '/../Core/Controller.php';
require_once __DIR__ . '/../Models/MenuModel.php';

class MenuController extends Controller {

    // ── GET: semua menu aktif (JSON untuk app.js) ────────────
    public function index(): void {
        $menus = MenuModel::getAll();

        // Pastikan harga bertipe float
        foreach ($menus as &$m) {
            $m['harga'] = (float) $m['harga'];
        }

        $this->json($menus);
    }
}
