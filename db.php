<?php

declare(strict_types=1);

session_set_cookie_params(['httponly' => true, 'samesite' => 'Lax']);
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$dbHost = getenv('DB_HOST') ?: '127.0.0.1';
$dbName = getenv('DB_NAME') ?: 'events_city';
$dbUser = getenv('DB_USER') ?: 'root';
$dbPass = getenv('DB_PASS') ?: '';

try {
    $pdo = new PDO("mysql:host={$dbHost};dbname={$dbName};charset=utf8mb4", $dbUser, $dbPass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
    if ((int) $pdo->query('SELECT COUNT(*) FROM users')->fetchColumn() === 0) {
        $seedAdmin = $pdo->prepare('INSERT INTO users (username, password) VALUES (?, ?)');
        $seedAdmin->execute(['admin', password_hash('admin', PASSWORD_DEFAULT)]);
    }
} catch (PDOException $exception) {
    http_response_code(500);
    exit('تعذّر الاتصال بقاعدة البيانات. استورد ملف database.sql وتأكد من إعدادات الاتصال في db.php.');
}

function e(mixed $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function csrf_token(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function verify_csrf(): void
{
    $token = $_POST['csrf_token'] ?? '';
    if (!is_string($token) || !hash_equals(csrf_token(), $token)) {
        http_response_code(419);
        exit('انتهت صلاحية الطلب. أعد تحميل الصفحة وحاول مرة أخرى.');
    }
}

function require_admin(): void
{
    if (empty($_SESSION['admin_id'])) {
        header('Location: login.php');
        exit;
    }
}

function event_categories(): array
{
    return ['ثقافة', 'رياضة', 'موسيقى', 'عائلي', 'أكاديمي', 'تقنية'];
}

function format_event_date(string $date): string
{
    return date('d/m/Y', strtotime($date));
}

function image_url(?string $image): string
{
    return $image ?: 'https://images.unsplash.com/photo-1506157786151-b8491531f063?auto=format&fit=crop&w=1000&q=85';
}
