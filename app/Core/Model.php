<?php
// ============================================================
//  Model.php — Base Model
//  Menyediakan koneksi PDO dan helper query
// ============================================================

abstract class Model {

    protected static ?PDO $pdo = null;

    // ── Singleton PDO connection ─────────────────────────────
    protected static function db(): PDO {
        if (self::$pdo === null) {
            $cfg = require __DIR__ . '/../../config/database.php';
            try {
                self::$pdo = new PDO(
                    "mysql:host={$cfg['host']};dbname={$cfg['dbname']};charset=utf8mb4",
                    $cfg['user'],
                    $cfg['pass'],
                    [
                        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                        PDO::ATTR_EMULATE_PREPARES   => false,
                    ]
                );
            } catch (PDOException $e) {
                http_response_code(500);
                die(json_encode(['error' => 'Database error: ' . $e->getMessage()]));
            }
        }
        return self::$pdo;
    }

    // ── Helper: query SELECT (kembalikan banyak baris) ───────
    protected static function query(string $sql, array $params = []): array {
        $stmt = self::db()->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    // ── Helper: query SELECT satu baris ─────────────────────
    protected static function queryOne(string $sql, array $params = []): ?array {
        $stmt = self::db()->prepare($sql);
        $stmt->execute($params);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    // ── Helper: query scalar (COUNT, SUM, dll) ───────────────
    protected static function scalar(string $sql, array $params = []): mixed {
        $stmt = self::db()->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchColumn();
    }

    // ── Helper: INSERT, UPDATE, DELETE ───────────────────────
    protected static function execute(string $sql, array $params = []): int {
        $stmt = self::db()->prepare($sql);
        $stmt->execute($params);
        return (int) $stmt->rowCount();
    }

    // ── Helper: INSERT dan ambil lastInsertId ────────────────
    protected static function insert(string $sql, array $params = []): int {
        $stmt = self::db()->prepare($sql);
        $stmt->execute($params);
        return (int) self::db()->lastInsertId();
    }

    // ── Transaksi ────────────────────────────────────────────
    protected static function transaction(callable $callback): mixed {
        self::db()->beginTransaction();
        try {
            $result = $callback(self::db());
            self::db()->commit();
            return $result;
        } catch (Throwable $e) {
            self::db()->rollBack();
            throw $e;
        }
    }
}
