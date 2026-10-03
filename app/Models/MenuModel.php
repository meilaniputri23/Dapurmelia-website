<?php
// ============================================================
//  Models/MenuModel.php — Operasi database tabel `menu`
// ============================================================

require_once __DIR__ . '/../Core/Model.php';

class MenuModel extends Model {

    // ── Ambil semua menu aktif (untuk halaman publik) ────────
    public static function getAll(): array {
        return self::query(
            "SELECT id, nama_menu, kategori, deskripsi, harga, satuan, gambar
             FROM menu WHERE aktif = 1 ORDER BY id ASC"
        );
    }

    // ── Ambil semua menu termasuk yang nonaktif (admin) ──────
    public static function getAllAdmin(): array {
        return self::query(
            "SELECT * FROM menu ORDER BY id DESC"
        );
    }

    // ── Cari menu berdasarkan ID ─────────────────────────────
    public static function findById(int $id): ?array {
        return self::queryOne(
            "SELECT * FROM menu WHERE id = ?",
            [$id]
        );
    }

    // ── Tambah menu baru ─────────────────────────────────────
    public static function create(array $data): int {
        return self::insert(
            "INSERT INTO menu (nama_menu, kategori, deskripsi, harga, satuan, gambar, aktif)
             VALUES (?, ?, ?, ?, ?, ?, 1)",
            [
                $data['nama_menu'],
                $data['kategori'],
                $data['deskripsi'] ?? '',
                (float) $data['harga'],
                $data['satuan'] ?? '/pcs',
                $data['gambar'] ?? null,
            ]
        );
    }

    // ── Update menu ──────────────────────────────────────────
    public static function update(int $id, array $data): void {
        self::execute(
            "UPDATE menu SET nama_menu=?, kategori=?, deskripsi=?, harga=?, satuan=?, gambar=?, aktif=?
             WHERE id=?",
            [
                $data['nama_menu'],
                $data['kategori'],
                $data['deskripsi'] ?? '',
                (float) $data['harga'],
                $data['satuan'] ?? '/pcs',
                $data['gambar'] ?? null,
                (int) ($data['aktif'] ?? 1),
                $id,
            ]
        );
    }

    // ── Hapus menu ───────────────────────────────────────────
    public static function delete(int $id): void {
        self::execute("DELETE FROM menu WHERE id = ?", [$id]);
    }
}
