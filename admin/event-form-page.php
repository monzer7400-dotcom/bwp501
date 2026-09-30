<!doctype html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($pageHeading) ?> | دليل الفعاليات</title>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link href="../assets/css/styles.css" rel="stylesheet">
</head>

<body class="admin-page">
    <header class="admin-topbar"><a class="navbar-brand d-flex align-items-center gap-2" href="dashboard.php"><span class="brand-mark">SVU</span><span class="brand-copy"><strong>إدارة الفعاليات</strong><small>لوحة التحكم</small></span></a>
        <div class="admin-top-actions"><a href="dashboard.php">قائمة الفعاليات</a><a class="logout-link" href="logout.php">تسجيل الخروج</a></div>
    </header>
    <main class="admin-content admin-form-content"><a class="breadcrumb-admin" href="dashboard.php">← العودة إلى قائمة الفعاليات</a>
        <div class="admin-heading">
            <div><span class="eyebrow">إدارة المحتوى</span>
                <h1><?= e($pageHeading) ?></h1>
                <p>أدخل معلومات واضحة ومحدثة لتظهر للطلاب.</p>
            </div>
        </div><?php if ($error): ?><div class="alert alert-danger" role="alert"><?= e($error) ?></div><?php endif; ?><section class="admin-form-panel"><?php require __DIR__ . '/event-form.php'; ?></section>
    </main>
</body>

</html>