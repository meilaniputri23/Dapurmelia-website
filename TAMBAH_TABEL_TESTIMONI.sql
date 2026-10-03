-- ============================================================
--  TAMBAH_TABEL_TESTIMONI.sql
--  Jalankan file ini di phpMyAdmin:
--  1. Buka phpMyAdmin → pilih database "dapurmelia"
--  2. Klik tab "Import" → pilih file ini → klik "Go"
--  ATAU klik tab "SQL" → paste isi file ini → klik "Go"
-- ============================================================

USE `dapurmelia`;

-- ─────────────────────────────────────────────────────────
--  Buat tabel testimoni jika belum ada
-- ─────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS `testimoni` (
  `id`         INT(11)    NOT NULL AUTO_INCREMENT,
  `pesanan_id` INT(11)    NOT NULL,
  `user_id`    INT(11)    DEFAULT NULL,
  `rating`     TINYINT(1) NOT NULL DEFAULT 5,
  `pesan`      TEXT       NOT NULL,
  `visible`    TINYINT(1) NOT NULL DEFAULT 1,
  `created_at` DATETIME   NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_pesanan` (`pesanan_id`),
  KEY `fk_testi_user` (`user_id`),
  CONSTRAINT `fk_testi_pesanan`
    FOREIGN KEY (`pesanan_id`) REFERENCES `pesanan` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_testi_user`
    FOREIGN KEY (`user_id`)    REFERENCES `users`   (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ─────────────────────────────────────────────────────────
--  Jika tabel sudah ada, tambahkan kolom visible
--  (aman dijalankan berulang kali)
-- ─────────────────────────────────────────────────────────
ALTER TABLE `testimoni`
  ADD COLUMN IF NOT EXISTS `visible` TINYINT(1) NOT NULL DEFAULT 1 AFTER `pesan`;

-- Konfirmasi
SELECT 'Tabel testimoni siap dengan kolom visible!' AS status;
