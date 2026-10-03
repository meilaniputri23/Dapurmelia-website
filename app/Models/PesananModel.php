<?php
// ============================================================
//  Models/PesananModel.php — Operasi database tabel `pesanan`
// ============================================================

require_once __DIR__ . '/../Core/Model.php';

class PesananModel extends Model {

    // ── Pesanan milik satu member ────────────────────────────
    public static function getByUserId(int $userId): array {
        return self::query("
            SELECT p.id, p.nama_pemesan, p.no_hp, p.total, p.status, p.created_at,
                   GROUP_CONCAT(dp.nama_menu ORDER BY dp.id SEPARATOR ', ') AS item_list
            FROM pesanan p
            LEFT JOIN detail_pesanan dp ON dp.pesanan_id = p.id
            WHERE p.user_id = ?
            GROUP BY p.id
            ORDER BY p.created_at DESC
            LIMIT 50
        ", [$userId]);
    }

    // ── Semua pesanan (admin) ────────────────────────────────
    public static function getAll(): array {
        return self::query("
            SELECT p.id, p.nama_pemesan, p.no_hp, p.total, p.status, p.created_at,
                   p.jenis_acara, p.tanggal_acara, p.waktu_pengiriman, p.metode_bayar,
                   p.alamat, p.catatan,
                   u.email AS email_member,
                   GROUP_CONCAT(dp.nama_menu ORDER BY dp.id SEPARATOR ', ') AS item_list
            FROM pesanan p
            LEFT JOIN users u           ON u.id = p.user_id
            LEFT JOIN detail_pesanan dp ON dp.pesanan_id = p.id
            GROUP BY p.id
            ORDER BY p.created_at DESC
        ");
    }

    // ── Detail satu pesanan lengkap (admin popup) ────────────
    public static function getDetailLengkap(int $id): ?array {
        $pesanan = self::queryOne("
            SELECT p.*, u.email AS email_member
            FROM pesanan p
            LEFT JOIN users u ON u.id = p.user_id
            WHERE p.id = ?
        ", [$id]);
        if (!$pesanan) return null;
        $pesanan['items'] = self::query(
            "SELECT nama_menu, harga, qty, subtotal FROM detail_pesanan WHERE pesanan_id = ? ORDER BY id",
            [$id]
        );
        return $pesanan;
    }

    // ── Pesanan dengan detail item ───────────────────────────
    public static function getWithDetail(int $id): ?array {
        $pesanan = self::queryOne("SELECT * FROM pesanan WHERE id = ?", [$id]);
        if (!$pesanan) return null;

        $pesanan['items'] = self::query(
            "SELECT * FROM detail_pesanan WHERE pesanan_id = ?",
            [$id]
        );
        return $pesanan;
    }

    // ── Buat pesanan baru (dengan detail item) ───────────────
    public static function create(int $userId, array $data, array $items): int {
        return self::transaction(function () use ($userId, $data, $items) {
            $total = array_sum(array_map(
                fn($it) => (float)$it['harga'] * (int)$it['qty'],
                $items
            ));

            $pesananId = self::insert(
                "INSERT INTO pesanan (user_id, nama_pemesan, no_hp, jenis_acara, tanggal_acara, waktu_pengiriman, metode_bayar, alamat, catatan, total)
                 VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
                [
                    $userId,
                    $data['nama'],
                    $data['hp'],
                    $data['jenis_acara']      ?? '',
                    $data['tanggal_acara']    ?: null,
                    $data['waktu_pengiriman'] ?? '',
                    $data['metode_bayar']     ?? '',
                    $data['alamat']           ?? '',
                    $data['catatan']          ?? '',
                    $total,
                ]
            );

            foreach ($items as $it) {
                $subtotal = (float)$it['harga'] * (int)$it['qty'];
                self::execute(
                    "INSERT INTO detail_pesanan (pesanan_id, menu_id, nama_menu, harga, qty, subtotal)
                     VALUES (?, ?, ?, ?, ?, ?)",
                    [
                        $pesananId,
                        $it['menu_id'] ?? null,
                        $it['nama_menu'],
                        (float) $it['harga'],
                        (int)   $it['qty'],
                        $subtotal,
                    ]
                );
            }

            return $pesananId;
        });
    }

    // ── Update status pesanan ────────────────────────────────
    public static function updateStatus(int $id, string $status): void {
        $allowed = ['Baru','Diproses','Siap','Dikirim','Selesai','Dibatalkan'];
        if (!in_array($status, $allowed)) {
            throw new \InvalidArgumentException("Status tidak valid: $status");
        }
        self::execute(
            "UPDATE pesanan SET status = ? WHERE id = ?",
            [$status, $id]
        );
    }

    // ── Laporan pendapatan (hanya status Selesai) ────────────
    public static function getLaporan(): array {
        // Total bulan ini
        $totalBulanIni = (float) self::scalar(
            "SELECT COALESCE(SUM(total),0) FROM pesanan
             WHERE status='Selesai' AND YEAR(created_at)=YEAR(CURDATE()) AND MONTH(created_at)=MONTH(CURDATE())"
        );

        // Total bulan lalu (untuk perbandingan %)
        $totalBulanLalu = (float) self::scalar(
            "SELECT COALESCE(SUM(total),0) FROM pesanan
             WHERE status='Selesai'
               AND YEAR(created_at)=YEAR(CURDATE() - INTERVAL 1 MONTH)
               AND MONTH(created_at)=MONTH(CURDATE() - INTERVAL 1 MONTH)"
        );

        // Total transaksi selesai bulan ini
        $totalTransaksi = (int) self::scalar(
            "SELECT COUNT(*) FROM pesanan
             WHERE status='Selesai' AND YEAR(created_at)=YEAR(CURDATE()) AND MONTH(created_at)=MONTH(CURDATE())"
        );

        $rataRata = $totalTransaksi > 0 ? $totalBulanIni / $totalTransaksi : 0;

        // Pendapatan harian bulan ini
        $harian = self::query(
            "SELECT DAY(created_at) AS tgl, SUM(total) AS total
             FROM pesanan
             WHERE status='Selesai' AND YEAR(created_at)=YEAR(CURDATE()) AND MONTH(created_at)=MONTH(CURDATE())
             GROUP BY DAY(created_at)
             ORDER BY tgl ASC"
        );

        // Pendapatan per kategori (join detail_pesanan -> menu)
        $kategori = self::query(
            "SELECT m.kategori, SUM(dp.subtotal) AS total
             FROM detail_pesanan dp
             JOIN pesanan p ON p.id = dp.pesanan_id
             JOIN menu m ON m.id = dp.menu_id
             WHERE p.status='Selesai' AND m.id IS NOT NULL AND m.kategori IS NOT NULL AND m.kategori != ''
             GROUP BY m.kategori
             ORDER BY total DESC"
        );

        // Pendapatan per bulan (6 bulan terakhir)
        $bulanan = self::query(
            "SELECT YEAR(created_at) AS thn, MONTH(created_at) AS bln, SUM(total) AS total
             FROM pesanan
             WHERE status='Selesai' AND created_at >= (CURDATE() - INTERVAL 6 MONTH)
             GROUP BY YEAR(created_at), MONTH(created_at)
             ORDER BY thn ASC, bln ASC"
        );

        // Hari dengan pendapatan tertinggi bulan ini
        $hariTertinggi = self::queryOne(
            "SELECT DATE(created_at) AS tgl, SUM(total) AS total
             FROM pesanan
             WHERE status='Selesai' AND YEAR(created_at)=YEAR(CURDATE()) AND MONTH(created_at)=MONTH(CURDATE())
             GROUP BY DATE(created_at)
             ORDER BY total DESC
             LIMIT 1"
        );

        $persenVsBulanLalu = $totalBulanLalu > 0
            ? round((($totalBulanIni - $totalBulanLalu) / $totalBulanLalu) * 100, 1)
            : 0;

        // Top 5 produk terlaris berdasarkan omzet
        $topProduk = self::query(
            "SELECT dp.nama_menu, SUM(dp.subtotal) AS total, SUM(dp.qty) AS qty
             FROM detail_pesanan dp
             JOIN pesanan p ON p.id = dp.pesanan_id
             WHERE p.status='Selesai'
             GROUP BY dp.nama_menu
             ORDER BY total DESC
             LIMIT 5"
        );

        return [
            'total_bulan_ini'     => $totalBulanIni,
            'total_transaksi'     => $totalTransaksi,
            'rata_rata'           => $rataRata,
            'persen_vs_bulan_lalu'=> $persenVsBulanLalu,
            'harian'              => $harian,
            'kategori'            => $kategori,
            'bulanan'             => $bulanan,
            'hari_tertinggi'      => $hariTertinggi,
            'top_produk'          => $topProduk,
        ];
    }

    // ── Statistik ringkas untuk dashboard admin ──────────────
    public static function getStats(): array {
        return [
            'total_pesanan'    => (int)   self::scalar("SELECT COUNT(*) FROM pesanan WHERE status='Selesai'"),
            'total_member'     => (int)   self::scalar("SELECT COUNT(*) FROM users WHERE role='member'"),
            'total_pendapatan' => (float) self::scalar("SELECT COALESCE(SUM(total),0) FROM pesanan WHERE status='Selesai'"),
            'pesanan_baru'     => (int)   self::scalar("SELECT COUNT(*) FROM pesanan WHERE status='Baru'"),
        ];
    }
}
