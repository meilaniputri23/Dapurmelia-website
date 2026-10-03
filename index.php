<?php
// ============================================================
//  public/index.php — Entry Point (Front Controller)
//  Semua request masuk ke sini via .htaccess
//  URL: http://localhost/dapurmelia/
// ============================================================

ob_start(); // Buffer output agar header tidak pernah terlambat

// ── Bootstrap ────────────────────────────────────────────────
define('BASE_PATH', __DIR__);

// Auto-detect BASE_URL dari nama folder (tidak perlu hardcode)
$scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
$baseUrl   = rtrim($scriptDir, '/');
define('BASE_URL', $baseUrl);

// ── Session settings (sebelum session_start) ─────────────────
ini_set('session.cookie_httponly', 1);
ini_set('session.use_strict_mode', 1);
ini_set('session.cookie_samesite', 'Lax');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ── Autoload core files ───────────────────────────────────────
require_once BASE_PATH . '/app/Core/App.php';
require_once BASE_PATH . '/app/Core/Controller.php';
require_once BASE_PATH . '/app/Core/Model.php';

// ── Jalankan router ───────────────────────────────────────────
$app = new App();
$app->run();
