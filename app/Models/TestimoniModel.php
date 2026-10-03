<?php
// ============================================================
//  Models/TestimoniModel.php — Operasi database tabel `testimoni`
// ============================================================

require_once __DIR__ . '/../Core/Model.php';

class TestimoniModel extends Model {

    // Simpan testimoni baru
    public static function create(int $pesananId, int $userId, int $rating, string $pesan): void {
        self::execute("
            INSERT INTO testimoni (pesanan_id, user_id, rating, pesan)
            VALUES (?, ?, ?, ?)
        ", [$pesananId, $userId, $rating, trim($pesan)]);
    }

    // Cek apakah pesanan sudah punya testimoni
    public static function getByPesanan(int $pesananId): ?array {
        return self::queryOne("SELECT * FROM testimoni WHERE pesanan_id = ?", [$pesananId]);
    }

    // Ambil semua testimoni (untuk admin — termasuk yang disembunyikan)
    public static function getAll(): array {
        return self::query("
            SELECT t.*, u.nama AS nama_user, p.id AS no_pesanan
            FROM testimoni t
            LEFT JOIN users u ON u.id = t.user_id
            LEFT JOIN pesanan p ON p.id = t.pesanan_id
            ORDER BY t.created_at DESC
        ");
    }

    // Ambil hanya testimoni yang visible=1 (untuk landing page)
    public static function getVisible(): array {
        return self::query("
            SELECT t.*, u.nama AS nama_user
            FROM testimoni t
            LEFT JOIN users u ON u.id = t.user_id
            WHERE t.visible = 1
            ORDER BY t.created_at DESC
            LIMIT 6
        ");
    }

    // Toggle visible (admin sembunyikan / tampilkan)
    public static function toggleVisible(int $id): void {
        self::execute("
            UPDATE testimoni SET visible = IF(visible = 1, 0, 1) WHERE id = ?
        ", [$id]);
    }

    // Hapus testimoni (admin)
    public static function delete(int $id): void {
        self::execute("DELETE FROM testimoni WHERE id = ?", [$id]);
    }
}
