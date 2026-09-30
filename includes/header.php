<?php
$pageTitle = $pageTitle ?? 'دليل فعاليات الجامعة الافتراضية';
$activePage = $activePage ?? '';
?>
<!doctype html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="اكتشف الفعاليات والأنشطة الطلابية في الجامعة الافتراضية السورية.">
    <title><?= e($pageTitle) ?> | دليل الفعاليات</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link href="assets/css/styles.css" rel="stylesheet">
</head>

<body>
    <a class="skip-link" href="#main-content">انتقل إلى المحتوى</a>
    <header class="site-header">
        <nav class="navbar navbar-expand-lg container py-3" aria-label="التنقل الرئيسي">
            <a class="navbar-brand d-flex align-items-center gap-2" href="index.php" aria-label="دليل فعاليات الجامعة، الرئيسية">
                <span class="brand-mark" aria-hidden="true">SVU</span>
                <span class="brand-copy"><strong>دليل الفعاليات</strong><small>الجامعة الافتراضية السورية</small></span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavigation" aria-controls="mainNavigation" aria-expanded="false" aria-label="فتح القائمة">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNavigation">
                <ul class="navbar-nav me-auto align-items-lg-center gap-lg-2">
                    <li class="nav-item"><a class="nav-link <?= $activePage === 'home' ? 'active' : '' ?>" href="index.php">الرئيسية</a></li>
                    <li class="nav-item"><a class="nav-link <?= $activePage === 'events' ? 'active' : '' ?>" href="events.php">الفعاليات</a></li>
                    <li class="nav-item"><a class="nav-link <?= $activePage === 'about' ? 'active' : '' ?>" href="about.php">عن الدليل</a></li>
                    <li class="nav-item"><a class="nav-link <?= $activePage === 'contact' ? 'active' : '' ?>" href="contact.php">اتصل بنا</a></li>
                    <li class="nav-item d-flex align-items-center gap-2 me-lg-3 mt-3 mt-lg-0">
                        <button class="icon-button" type="button" data-theme-toggle aria-label="تبديل الوضع الليلي" title="تبديل الوضع الليلي">◐</button>
                        <a class="admin-link" href="admin/login.php">لوحة الإدارة <span aria-hidden="true">↗</span></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <main id="main-content">