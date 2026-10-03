-- ============================================================
--  FIX_DATABASE.sql
--  Jalankan file ini di phpMyAdmin jika masih "Akses ditolak"
--  Caranya: phpMyAdmin → database dapurmelia → tab SQL → paste → Go
-- ============================================================

-- 1. Lihat semua user dan role-nya
SELECT id, nama, email, role FROM users;

-- 2. Tambah support role 'owner' di ENUM
ALTER TABLE users 
  MODIFY COLUMN role ENUM('admin','owner','member') NOT NULL DEFAULT 'member';

-- 3. Pastikan user Melia/Admin punya role admin
UPDATE users SET role = 'admin' 
WHERE nama LIKE '%Melia%' OR nama LIKE '%Admin%' OR email LIKE '%admin%';

-- 4. Tambah kolom baru di pesanan (kalau belum ada)
ALTER TABLE `pesanan`
  ADD COLUMN IF NOT EXISTS `jenis_acara`      VARCHAR(100) DEFAULT NULL AFTER `catatan`,
  ADD COLUMN IF NOT EXISTS `tanggal_acara`    DATE         DEFAULT NULL AFTER `jenis_acara`,
  ADD COLUMN IF NOT EXISTS `waktu_pengiriman` VARCHAR(50)  DEFAULT NULL AFTER `tanggal_acara`,
  ADD COLUMN IF NOT EXISTS `metode_bayar`     VARCHAR(50)  DEFAULT NULL AFTER `waktu_pengiriman`;

-- 5. Cek hasilnya
SELECT id, nama, email, role FROM users;
