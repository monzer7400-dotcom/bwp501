<?php
require_once __DIR__ . '/../db.php';
if (!empty($_SESSION['admin_id'])) {
    header('Location: dashboard.php');
    exit;
}
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $username = trim((string) ($_POST['username'] ?? ''));
    $password = (string) ($_POST['password'] ?? '');
    $statement = $pdo->prepare('SELECT id, username, password FROM users WHERE username = ? LIMIT 1');
    $statement->execute([$username]);
    $user = $statement->fetch();
    if ($user && password_verify($password, $user['password'])) {
        session_regenerate_id(true);
        $_SESSION['admin_id'] = (int) $user['id'];
        $_SESSION['admin_name'] = $user['username'];
        header('Location: dashboard.php');
        exit;
    }
    $error = 'اسم المستخدم أو كلمة المرور غير صحيحة.';
}
?>
<!doctype html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>دخول الإدارة | دليل الفعاليات</title>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link href="../assets/css/styles.css" rel="stylesheet">
</head>

<body class="admin-login-page">
    <main class="login-layout"><a class="login-back" href="../index.php">← العودة إلى الموقع</a>
        <section class="login-panel"><span class="brand-mark" aria-hidden="true">SVU</span><span class="eyebrow">مساحة فريق الدليل</span>
            <h1>مرحبًا بعودتك.</h1>
            <p>سجّل الدخول لإدارة فعاليات الجامعة.</p>
            <?php if ($error): ?><div class="alert alert-danger" role="alert"><?= e($error) ?></div><?php endif; ?>
            <form method="post" action="login.php"><input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
                <div class="form-field"><label for="username">اسم المستخدم</label><input class="form-control" id="username" name="username" type="text" autocomplete="username" required autofocus></div>
                <div class="form-field"><label for="password">كلمة المرور</label><input class="form-control" id="password" name="password" type="password" autocomplete="current-password" required></div><button class="button-primary w-100" type="submit">تسجيل الدخول <span aria-hidden="true">←</span></button>
            </form>
            <small class="login-hint">بيانات البداية: admin / admin. غيّر كلمة المرور قبل النشر.</small>
        </section>
        <div class="login-decoration"><span class="eyebrow">SVU · EVENTS</span><strong>كل لقاء<br>يبدأ بفكرة.</strong><span class="decoration-circle" aria-hidden="true">✳</span></div>
    </main>
</body>

</html>