<?php
require_once __DIR__ . '/../db.php';
require_admin();
$events = $pdo->query('SELECT * FROM events ORDER BY event_date DESC, id DESC')->fetchAll();
$flash = $_SESSION['admin_flash'] ?? '';
unset($_SESSION['admin_flash']);
$total = count($events);
$upcoming = count(array_filter($events, static fn($event) => $event['event_date'] >= date('Y-m-d')));
$categories = count(array_unique(array_column($events, 'category')));
?>
<!doctype html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>لوحة الإدارة | دليل الفعاليات</title>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link href="../assets/css/styles.css" rel="stylesheet">
</head>

<body class="admin-page">
    <header class="admin-topbar"><a class="navbar-brand d-flex align-items-center gap-2" href="dashboard.php"><span class="brand-mark">SVU</span><span class="brand-copy"><strong>إدارة الفعاليات</strong><small>لوحة التحكم</small></span></a>
        <div class="admin-top-actions"><a href="../index.php" target="_blank" rel="noopener">عرض الموقع ↗</a><span class="admin-user">مرحبًا، <?= e($_SESSION['admin_name'] ?? 'admin') ?></span><a class="logout-link" href="logout.php">تسجيل الخروج</a></div>
    </header>
    <main class="admin-content">
        <div class="admin-heading">
            <div><span class="eyebrow">مساحة الإدارة</span>
                <h1>الفعاليات</h1>
                <p>أدر محتوى دليل مجتمع الجامعة من هنا.</p>
            </div><a class="button-primary" href="add_event.php">＋ فعالية جديدة</a>
        </div>
        <?php if ($flash): ?><div class="alert alert-success" role="status"><?= e($flash) ?></div><?php endif; ?>
        <section class="admin-stats">
            <article><span>إجمالي الفعاليات</span><strong><?= $total ?></strong></article>
            <article><span>فعاليات قادمة</span><strong><?= $upcoming ?></strong></article>
            <article><span>التصنيفات</span><strong><?= $categories ?></strong></article>
        </section>
        <section class="admin-table-section">
            <div class="admin-table-heading">
                <div>
                    <h2>قائمة الفعاليات</h2><span><?= $total ?> سجل</span>
                </div><a class="button-outline button-small" href="add_event.php">إضافة فعالية <span aria-hidden="true">＋</span></a>
            </div>
            <?php if ($events): ?><div class="table-responsive">
                    <table class="table admin-table">
                        <thead>
                            <tr>
                                <th>الفعالية</th>
                                <th>التصنيف</th>
                                <th>التاريخ</th>
                                <th>المكان</th>
                                <th>الحالة</th>
                                <th><span class="visually-hidden">الإجراءات</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($events as $event): ?><tr>
                                    <td>
                                        <div class="table-event"><img src="<?= e(image_url($event['image'])) ?>" alt=""><strong><?= e($event['title']) ?></strong></div>
                                    </td>
                                    <td><span class="table-category"><?= e($event['category']) ?></span></td>
                                    <td><?= e(format_event_date($event['event_date'])) ?></td>
                                    <td><?= e($event['location']) ?></td>
                                    <td><span class="status-pill <?= $event['event_date'] >= date('Y-m-d') ? 'status-upcoming' : 'status-past' ?>"><?= $event['event_date'] >= date('Y-m-d') ? 'قادمة' : 'منتهية' ?></span></td>
                                    <td>
                                        <div class="table-actions"><a href="edit_event.php?id=<?= (int) $event['id'] ?>" aria-label="تعديل <?= e($event['title']) ?>">تعديل</a>
                                            <form action="delete_event.php" method="post" onsubmit="return confirm('هل أنت متأكد من حذف هذه الفعالية؟');"><input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>"><input type="hidden" name="id" value="<?= (int) $event['id'] ?>"><button type="submit" aria-label="حذف <?= e($event['title']) ?>">حذف</button></form>
                                        </div>
                                    </td>
                                </tr><?php endforeach; ?>
                        </tbody>
                    </table>
                </div><?php else: ?><div class="empty-panel">لا توجد فعاليات بعد. أضف أول فعالية للبدء.</div><?php endif; ?>
        </section>
    </main>
</body>

</html>