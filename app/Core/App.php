<?php
// ============================================================
//  App.php — Front Controller / Router
//  Membaca ?page=xxx&action=xxx dari URL dan dispatch ke Controller
// ============================================================

class App {

    private string $defaultController = 'HomeController';
    private string $defaultAction     = 'index';

    public function run(): void {
        $page   = $_GET['page']   ?? 'home';
        $action = $_GET['action'] ?? 'index';

        // Sanitasi: hanya huruf, angka, underscore
        $page   = preg_replace('/[^a-zA-Z0-9_]/', '', $page);
        $action = preg_replace('/[^a-zA-Z0-9_]/', '', $action);

        $controllerName = ucfirst($page) . 'Controller';
        $controllerFile = __DIR__ . '/../Controllers/' . $controllerName . '.php';

        if (!file_exists($controllerFile)) {
            http_response_code(404);
            include __DIR__ . '/../Views/layouts/404.php';
            return;
        }

        require_once $controllerFile;
        $controller = new $controllerName();

        if (!method_exists($controller, $action)) {
            http_response_code(404);
            include __DIR__ . '/../Views/layouts/404.php';
            return;
        }

        $controller->$action();
    }
}
