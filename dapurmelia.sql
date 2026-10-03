-- ============================================================
--  DATABASE: dapurmelia
--  Import ke XAMPP: buka phpMyAdmin → Import → pilih file ini
-- ============================================================

CREATE DATABASE IF NOT EXISTS `dapurmelia`
  DEFAULT CHARACTER SET utf8mb4
  DEFAULT COLLATE utf8mb4_unicode_ci;

USE `dapurmelia`;

-- ─────────────────────────────────────────────────────────
--  TABEL: users (admin & member)
-- ─────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS `users` (
  `id`         INT(11)      NOT NULL AUTO_INCREMENT,
  `nama`       VARCHAR(100) NOT NULL,
  `email`      VARCHAR(150) NOT NULL,
  `no_hp`      VARCHAR(20)  DEFAULT NULL,
  `password`   VARCHAR(255) NOT NULL,       -- disimpan sebagai hash bcrypt
  `role`       ENUM('admin','owner','member')  NOT NULL DEFAULT 'member',
  `created_at` DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ─────────────────────────────────────────────────────────
--  TABEL: menu
-- ─────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS `menu` (
  `id`         INT(11)       NOT NULL AUTO_INCREMENT,
  `nama_menu`  VARCHAR(150)  NOT NULL,
  `kategori`   ENUM('Snack','Catering','Dessert','Nasi Kotak','Paket') NOT NULL DEFAULT 'Snack',
  `deskripsi`  TEXT          DEFAULT NULL,
  `harga`      DECIMAL(12,2) NOT NULL DEFAULT 0,
  `satuan`     VARCHAR(30)   NOT NULL DEFAULT '/pcs',
  `gambar`     VARCHAR(500)  DEFAULT NULL,
  `aktif`      TINYINT(1)    NOT NULL DEFAULT 1,
  `created_at` DATETIME      NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ─────────────────────────────────────────────────────────
--  TABEL: pesanan (orders)
-- ─────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS `pesanan` (
  `id`           INT(11)       NOT NULL AUTO_INCREMENT,
  `user_id`      INT(11)       DEFAULT NULL,
  `nama_pemesan` VARCHAR(100)  NOT NULL,
  `no_hp`        VARCHAR(20)   NOT NULL,
  `jenis_acara`       VARCHAR(100)  DEFAULT NULL,
  `tanggal_acara`     DATE          DEFAULT NULL,
  `waktu_pengiriman`  VARCHAR(50)   DEFAULT NULL,
  `metode_bayar`      VARCHAR(50)   DEFAULT NULL,
  `alamat`            TEXT          DEFAULT NULL,
  `catatan`           TEXT          DEFAULT NULL,
  `total`        DECIMAL(14,2) NOT NULL DEFAULT 0,
  `status`       ENUM('Baru','Diproses','Siap','Dikirim','Selesai','Dibatalkan')
                               NOT NULL DEFAULT 'Baru',
  `created_at`   DATETIME      NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_pesanan_user` (`user_id`),
  CONSTRAINT `fk_pesanan_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ─────────────────────────────────────────────────────────
--  TABEL: detail_pesanan
-- ─────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS `detail_pesanan` (
  `id`         INT(11)       NOT NULL AUTO_INCREMENT,
  `pesanan_id` INT(11)       NOT NULL,
  `menu_id`    INT(11)       DEFAULT NULL,
  `nama_menu`  VARCHAR(150)  NOT NULL,
  `harga`      DECIMAL(12,2) NOT NULL,
  `qty`        INT(11)       NOT NULL DEFAULT 1,
  `subtotal`   DECIMAL(14,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_detail_pesanan` (`pesanan_id`),
  KEY `fk_detail_menu`    (`menu_id`),
  CONSTRAINT `fk_detail_pesanan` FOREIGN KEY (`pesanan_id`) REFERENCES `pesanan` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_detail_menu`    FOREIGN KEY (`menu_id`)    REFERENCES `menu`    (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ─────────────────────────────────────────────────────────
--  DATA AWAL: Admin default
--  Password: admin123  (hash bcrypt)
-- ─────────────────────────────────────────────────────────
INSERT INTO `users` (`nama`, `email`, `password`, `role`) VALUES
('Admin Dapurmelia', 'admin@dapurmelia.com',
 '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', -- password: password
 'admin');

-- ─────────────────────────────────────────────────────────
--  DATA AWAL: Contoh menu
-- ─────────────────────────────────────────────────────────
INSERT INTO `menu` (`nama_menu`, `kategori`, `deskripsi`, `harga`, `satuan`, `gambar`) VALUES
('Risol Mayo Spesial',   'Snack',     'Kulit tipis renyah, isian creamy mayo dengan wortel & daging sapi pilihan.',  3500,  '/pcs',  'https://i.pinimg.com/1200x/5e/3d/51/5e3d51622e72eb06fbb39fe89a769086.jpg'),
('Onde-onde Kacang Hijau','Snack',    'Bulat lembut berbalut wijen, isian kacang hijau manis resep turun-temurun.',  3000,  '/pcs',  'https://i.pinimg.com/736x/9c/3a/0f/9c3a0f6cfdae3d8d2bbe13f6e4231c49.jpg'),
('Sosis Solo Ayam',      'Snack',     'Dadar tipis halus, isian ragout ayam berbumbu rempah yang khas.',             4000,  '/pcs',  'https://i.pinimg.com/1200x/37/63/7f/37637f82ed9ecb1843e4873b48a7409f.jpg'),
('Nasi Kotak Premium',   'Nasi Kotak','Nasi putih pulen + lauk lengkap, dikemas elegan untuk acara & hajatan.',     35000, '/box',  'https://i.pinimg.com/1200x/f6/2b/67/f62b67ac108f21e3dcf1780318d1c8a6.jpg'),
('Donat Premium',        'Dessert',   'Kenyal lembut dengan varian: red velvet, matcha, & taro cream.',              6000,  '/pcs',  'https://i.pinimg.com/736x/ce/c0/a9/cec0a9788d0e997e27414f6b1ad1b305.jpg');

-- ─────────────────────────────────────────────────────────
--  UPDATE: Tambah kolom detail pesanan (jalankan jika DB sudah ada)
--  Jika import ulang dari awal, bagian ini bisa diabaikan
-- ─────────────────────────────────────────────────────────
ALTER TABLE `pesanan`
  ADD COLUMN IF NOT EXISTS `jenis_acara`      VARCHAR(100) DEFAULT NULL AFTER `catatan`,
  ADD COLUMN IF NOT EXISTS `tanggal_acara`    DATE         DEFAULT NULL AFTER `jenis_acara`,
  ADD COLUMN IF NOT EXISTS `waktu_pengiriman` VARCHAR(50)  DEFAULT NULL AFTER `tanggal_acara`,
  ADD COLUMN IF NOT EXISTS `metode_bayar`     VARCHAR(50)  DEFAULT NULL AFTER `waktu_pengiriman`;

ALTER TABLE `users`
  MODIFY COLUMN `role` ENUM('admin','owner','member') NOT NULL DEFAULT 'member';

-- ─────────────────────────────────────────────────────────
--  TABEL: testimoni
-- ─────────────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS `testimoni` (
  `id`         INT(11)       NOT NULL AUTO_INCREMENT,
  `pesanan_id` INT(11)       NOT NULL,
  `user_id`    INT(11)       DEFAULT NULL,
  `rating`     TINYINT(1)    NOT NULL DEFAULT 5,
  `pesan`      TEXT          NOT NULL,
  `visible`    TINYINT(1)    NOT NULL DEFAULT 1,
  `created_at` DATETIME      NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_pesanan` (`pesanan_id`),
  KEY `fk_testi_user` (`user_id`),
  CONSTRAINT `fk_testi_pesanan` FOREIGN KEY (`pesanan_id`) REFERENCES `pesanan` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_testi_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
