<?php
require_once __DIR__ . '/../db.php';
require_admin();
$eventId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$statement = $pdo->prepare('SELECT * FROM events WHERE id = ?');
$statement->execute([$eventId ?: 0]);
$event = $statement->fetch();
if (!$event) {
    http_response_code(404);
    exit('الفعالية غير موجودة.');
}
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $event = array_merge($event, [
        'title' => trim((string) ($_POST['title'] ?? '')),
        'description' => trim((string) ($_POST['description'] ?? '')),
        'category' => trim((string) ($_POST['category'] ?? '')),
        'location' => trim((string) ($_POST['location'] ?? '')),
        'event_date' => trim((string) ($_POST['event_date'] ?? '')),
        'image' => trim((string) ($_POST['image'] ?? '')),
        'is_featured' => isset($_POST['is_featured']) ? 1 : 0,
    ]);
    $validDate = DateTime::createFromFormat('Y-m-d', $event['event_date']);
    if ($event['title'] === '' || $event['description'] === '' || $event['location'] === '' || !in_array($event['category'], event_categories(), true) || !$validDate || $validDate->format('Y-m-d') !== $event['event_date'] || !filter_var($event['image'], FILTER_VALIDATE_URL) || !str_starts_with($event['image'], 'https://')) {
        $error = 'تحقق من إدخال جميع الحقول، واختر تصنيفًا صالحًا ورابط صورة HTTPS.';
    } else {
        $update = $pdo->prepare('UPDATE events SET title = :title, description = :description, category = :category, location = :location, event_date = :event_date, image = :image, is_featured = :is_featured WHERE id = :id');
        $update->execute([
            'title' => $event['title'],
            'description' => $event['description'],
            'category' => $event['category'],
            'location' => $event['location'],
            'event_date' => $event['event_date'],
            'image' => $event['image'],
            'is_featured' => $event['is_featured'],
            'id' => (int) $event['id'],
        ]);
        $_SESSION['admin_flash'] = 'تم تحديث الفعالية بنجاح.';
        header('Location: dashboard.php');
        exit;
    }
}
$pageHeading = 'تعديل فعالية';
$formAction = 'edit_event.php?id=' . (int) $event['id'];
$submitLabel = 'حفظ التعديلات';
require __DIR__ . '/event-form-page.php';
