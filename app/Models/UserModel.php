<?php
// ============================================================
//  Models/UserModel.php — Operasi database tabel `users`
// ============================================================

require_once __DIR__ . '/../Core/Model.php';

class UserModel extends Model {

    // ── Cari user berdasarkan email ──────────────────────────
    public static function findByEmail(string $email): ?array {
        return self::queryOne(
            "SELECT * FROM users WHERE email = ? LIMIT 1",
            [$email]
        );
    }

    // ── Cari user berdasarkan ID ─────────────────────────────
    public static function findById(int $id): ?array {
        return self::queryOne(
            "SELECT id, nama, email, no_hp, role, created_at FROM users WHERE id = ?",
            [$id]
        );
    }

    // ── Ambil semua member (bukan admin) ─────────────────────
    public static function getAllMembers(): array {
        return self::query("
            SELECT u.id, u.nama, u.email, u.no_hp, u.created_at,
                   COUNT(p.id) AS total_pesanan,
                   COALESCE(SUM(CASE WHEN p.status='Selesai' THEN p.total ELSE 0 END),0) AS total_belanja
            FROM users u
            LEFT JOIN pesanan p ON p.user_id = u.id
            WHERE u.role = 'member' AND EXISTS (SELECT 1 FROM pesanan p2 WHERE p2.user_id = u.id)
            GROUP BY u.id
            ORDER BY u.created_at DESC
        ");
    }

    // ── Daftarkan user baru ──────────────────────────────────
    public static function create(string $nama, string $email, string $hp, string $password): int {
        $hash = password_hash($password, PASSWORD_BCRYPT);
        return self::insert(
            "INSERT INTO users (nama, email, no_hp, password, role) VALUES (?, ?, ?, ?, 'member')",
            [$nama, $email, $hp, $hash]
        );
    }

    // ── Cek apakah email sudah terdaftar ─────────────────────
    public static function emailExists(string $email): bool {
        return (bool) self::scalar(
            "SELECT COUNT(*) FROM users WHERE email = ?",
            [$email]
        );
    }

    // ── Update profil ────────────────────────────────────────
    public static function updateProfile(int $id, string $nama, string $hp): void {
        self::execute(
            "UPDATE users SET nama = ?, no_hp = ? WHERE id = ?",
            [$nama, $hp, $id]
        );
    }

    // ── Ganti password ───────────────────────────────────────
    public static function updatePassword(int $id, string $newPassword): void {
        $hash = password_hash($newPassword, PASSWORD_BCRYPT);
        self::execute(
            "UPDATE users SET password = ? WHERE id = ?",
            [$hash, $id]
        );
    }

    // ── Verifikasi password ──────────────────────────────────
    public static function verifyPassword(string $plain, string $hash): bool {
        return password_verify($plain, $hash);
    }
}
