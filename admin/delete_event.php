<?php
require_once __DIR__ . '/../db.php';
require_admin();
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    header('Allow: POST');
    exit('طريقة الطلب غير مسموحة.');
}
verify_csrf();
$eventId = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
if ($eventId) {
    $statement = $pdo->prepare('DELETE FROM events WHERE id = ?');
    $statement->execute([$eventId]);
    $_SESSION['admin_flash'] = $statement->rowCount() ? 'تم حذف الفعالية.' : 'الفعالية غير موجودة.';
}
header('Location: dashboard.php');
exit;
