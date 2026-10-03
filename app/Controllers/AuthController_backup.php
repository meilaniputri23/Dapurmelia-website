<?php
// ============================================================
//  Controllers/AuthController.php
//  Menangani: login, register, logout, cekSession
//  URL: ?page=auth&action=login | register | logout | cekSession
// ============================================================

require_once __DIR__ . '/../Core/Controller.php';
require_once __DIR__ . '/../Models/UserModel.php';

class AuthController extends Controller {

    // ── GET: tampilkan halaman login/register ────────────────
    public function login(): void {
        // Jika sudah login, redirect sesuai role
        if (isset($_SESSION['user_id'])) {
            $this->redirectByRole($_SESSION['user_role']);
        }
        $this->view('auth/login', ['title' => 'Masuk / Daftar — Dapurmelia_'], 'none');
    }

    // ── POST: proses login (dipanggil via fetch JSON) ────────
    public function doLogin(): void {
        $body  = $this->getBody();
        $email = trim($body['email']    ?? '');
        $pass  =      $body['password'] ?? '';

        if (!$email || !$pass) {
            $this->json(['success' => false, 'message' => 'Email dan password wajib diisi.'], 400);
        }

        $user = UserModel::findByEmail($email);

        if (!$user || !UserModel::verifyPassword($pass, $user['password'])) {
            $this->json(['success' => false, 'message' => 'Email atau password salah.'], 401);
        }

        // Buat session
        $_SESSION['user_id']    = $user['id'];
        $_SESSION['user_nama']  = $user['nama'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_role']  = $user['role'];

        $redirect = $user['role'] === 'admin'
            ? '/dapurmelia/?page=dashboard'
            : '/dapurmelia/?page=member';

        $this->json([
            'success'  => true,
            'role'     => $user['role'],
            'nama'     => $user['nama'],
            'email'    => $user['email'],
            'redirect' => $redirect,
        ]);
    }

    // ── POST: proses register ────────────────────────────────
    public function doRegister(): void {
        $body  = $this->getBody();
        $fname = trim($body['fname']    ?? '');
        $lname = trim($body['lname']    ?? '');
        $email = trim($body['email']    ?? '');
        $hp    = trim($body['hp']       ?? '');
        $pass  =      $body['password'] ?? '';

        // Validasi
        if (!$fname || !$email || !$pass) {
            $this->json(['success' => false, 'message' => 'Nama, email, dan password wajib diisi.'], 400);
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->json(['success' => false, 'message' => 'Format email tidak valid.'], 400);
        }
        if (strlen($pass) < 8) {
            $this->json(['success' => false, 'message' => 'Password minimal 8 karakter.'], 400);
        }
        if (UserModel::emailExists($email)) {
            $this->json(['success' => false, 'message' => 'Email sudah terdaftar.'], 409);
        }

        $nama  = trim("$fname $lname");
        $newId = UserModel::create($nama, $email, $hp, $pass);

        // Auto-login setelah register
        $_SESSION['user_id']    = $newId;
        $_SESSION['user_nama']  = $nama;
        $_SESSION['user_email'] = $email;
        $_SESSION['user_role']  = 'member';

        $this->json([
            'success'  => true,
            'nama'     => $nama,
            'email'    => $email,
            'redirect' => '/dapurmelia/?page=member',
        ]);
    }

    // ── POST: logout ─────────────────────────────────────────
    public function logout(): void {
        session_destroy();
        $this->json(['success' => true, 'redirect' => '/dapurmelia/?page=auth&action=login']);
    }

    // ── GET: logout via link klik biasa (redirect ke beranda) ─
    public function logoutDirect(): void {
        session_destroy();
        $this->redirect('/dapurmelia/');
    }

    // ── GET: cek status session ──────────────────────────────
    public function cekSession(): void {
        if (isset($_SESSION['user_id'])) {
            $this->json([
                'login' => true,
                'id'    => $_SESSION['user_id'],
                'nama'  => $_SESSION['user_nama'],
                'email' => $_SESSION['user_email'],
                'role'  => $_SESSION['user_role'],
            ]);
        } else {
            $this->json(['login' => false]);
        }
    }

    // ── Helper: redirect berdasarkan role ────────────────────
    private function redirectByRole(string $role): void {
        $this->redirect(
            $role === 'admin'
                ? '/dapurmelia/?page=dashboard'
                : '/dapurmelia/?page=member'
        );
    }
}
