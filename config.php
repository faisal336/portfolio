<?php
session_start();

// ─── ADMIN CREDENTIALS ───
// IMPORTANT: Change these after first login!
define('ADMIN_USER', 'admin');
define('ADMIN_PASS_HASH', password_hash('admin123', PASSWORD_DEFAULT)); // Change this password!

// ─── DATA FILE ───
define('DATA_FILE', __DIR__ . '/data/portfolio.json');

// ─── HELPERS ───
function is_logged_in(): bool {
    return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
}

function require_login(): void {
    if (!is_logged_in()) {
        header('Location: login.php');
        exit;
    }
}

function load_data(): array {
    if (!file_exists(DATA_FILE)) {
        $default = [
            'projects' => [],
            'skills' => [],
            'about' => [],
            'stats' => ['experience' => '5+', 'projects' => '30+', 'clients' => '15+']
        ];
        save_data($default);
        return $default;
    }
    $json = file_get_contents(DATA_FILE);
    return json_decode($json, true) ?: [];
}

function save_data(array $data): bool {
    $dir = dirname(DATA_FILE);
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
    return file_put_contents(DATA_FILE, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)) !== false;
}
