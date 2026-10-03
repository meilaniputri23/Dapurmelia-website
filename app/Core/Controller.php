<?php
// ============================================================
//  Controller.php — Base Controller
//  Semua controller extend class ini
// ============================================================

abstract class Controller {

    // ── Render view dengan layout ────────────────────────────
    protected function view(string $viewPath, array $data = [], string $layout = 'main'): void {
        // Ekstrak $data ke variabel lokal (supaya view bisa pakai $title, $user, dll)
        extract($data);

        $viewFile   = __DIR__ . '/../Views/' . $viewPath . '.php';
        $layoutFile = __DIR__ . '/../Views/layouts/' . $layout . '.php';

        if (!file_exists($viewFile)) {
            throw new \RuntimeException("View tidak ditemukan: $viewPath");
        }

        // Render konten view ke buffer
        ob_start();
        include $viewFile;
        $content = ob_get_clean();

        // Render layout (jika ada), inject $content ke dalamnya
        if ($layout && file_exists($layoutFile)) {
            include $layoutFile;
        } else {
            echo $content;
        }
    }

    // ── Kirim JSON response (untuk API call) ─────────────────
    protected function json(array $data, int $code = 200): void {
        http_response_code($code);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        exit;
    }

    // ── Redirect ─────────────────────────────────────────────
    protected function redirect(string $url): void {
        header('Location: ' . $url);
        exit;
    }

    // ── Ambil body JSON dari request ─────────────────────────
    protected function getBody(): array {
        $raw = file_get_contents('php://input');
        return json_decode($raw, true) ?? [];
    }

    // ── Cek apakah user sudah login ──────────────────────────
    protected function requireLogin(): void {
        if (!isset($_SESSION['user_id'])) {
            if ($this->isApiRequest()) {
                $this->json(['success' => false, 'message' => 'Belum login.'], 401);
            }
            $this->redirect(BASE_URL . '/?page=auth&action=login');
        }
    }

    // ── Cek apakah user adalah admin ─────────────────────────
    protected function requireAdmin(): void {
        // Pastikan session aktif
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->requireLogin();
        $role = strtolower(trim($_SESSION['user_role'] ?? ''));
        $adminRoles = ['admin', 'owner'];
        if (!in_array($role, $adminRoles)) {
            if ($this->isApiRequest()) {
                $this->json([
                    'success' => false,
                    'message' => 'Akses ditolak. Role: ' . ($role ?: 'kosong') . '. Silakan logout dan login ulang.'
                ], 403);
            }
            $this->redirect(BASE_URL . '/?page=member&action=index');
        }
    }

    // ── Cek apakah ini API request (expect JSON) ─────────────
    protected function isApiRequest(): bool {
        $accept      = $_SERVER['HTTP_ACCEPT'] ?? '';
        $contentType = $_SERVER['CONTENT_TYPE'] ?? '';
        return str_contains($accept, 'application/json')
            || str_contains($contentType, 'application/json')
            || ($_GET['format'] ?? '') === 'json';
    }
}
