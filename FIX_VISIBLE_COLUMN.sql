-- ============================================================
--  FIX_VISIBLE_COLUMN.sql
--  Jalankan file ini di phpMyAdmin jika testimoni tidak muncul
--  di landing page padahal sudah ada data di tabel.
--
--  Cara: phpMyAdmin → pilih database dapurmelia → tab SQL
--        paste isi file ini → klik Go
-- ============================================================

USE `dapurmelia`;

-- Tambah kolom visible jika belum ada
ALTER TABLE `testimoni`
  ADD COLUMN IF NOT EXISTS `visible` TINYINT(1) NOT NULL DEFAULT 1 AFTER `pesan`;

-- Set semua testimoni yang ada menjadi visible
UPDATE `testimoni` SET `visible` = 1 WHERE `visible` IS NULL OR `visible` = 0;

-- Konfirmasi
SELECT 
  COUNT(*) AS total_testimoni,
  SUM(visible = 1) AS testimoni_tampil,
  SUM(visible = 0) AS testimoni_disembunyikan
FROM testimoni;
