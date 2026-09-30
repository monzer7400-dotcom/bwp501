<?php
require_once __DIR__ . '/../db.php';
require_admin();
$error = '';
$event = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $event = [
        'title' => trim((string) ($_POST['title'] ?? '')),
        'description' => trim((string) ($_POST['description'] ?? '')),
        'category' => trim((string) ($_POST['category'] ?? '')),
        'location' => trim((string) ($_POST['location'] ?? '')),
        'event_date' => trim((string) ($_POST['event_date'] ?? '')),
        'image' => trim((string) ($_POST['image'] ?? '')),
        'is_featured' => isset($_POST['is_featured']) ? 1 : 0,
    ];
    $validDate = DateTime::createFromFormat('Y-m-d', $event['event_date']);
    if ($event['title'] === '' || $event['description'] === '' || $event['location'] === '' || !in_array($event['category'], event_categories(), true) || !$validDate || $validDate->format('Y-m-d') !== $event['event_date'] || !filter_var($event['image'], FILTER_VALIDATE_URL) || !str_starts_with($event['image'], 'https://')) {
        $error = 'تحقق من إدخال جميع الحقول، واختر تصنيفًا صالحًا ورابط صورة HTTPS.';
    } else {
        $statement = $pdo->prepare('INSERT INTO events (title, description, category, location, event_date, image, is_featured) VALUES (:title, :description, :category, :location, :event_date, :image, :is_featured)');
        $statement->execute($event);
        $_SESSION['admin_flash'] = 'تمت إضافة الفعالية بنجاح.';
        header('Location: dashboard.php');
        exit;
    }
}
$pageHeading = 'إضافة فعالية';
$formAction = 'add_event.php';
$submitLabel = 'حفظ الفعالية';
require __DIR__ . '/event-form-page.php';
