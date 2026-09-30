<?php
require_once __DIR__ . '/db.php';
$pageTitle = 'كل الفعاليات';
$activePage = 'events';
$events = $pdo->query('SELECT * FROM events WHERE event_date >= CURDATE() ORDER BY event_date, created_at DESC')->fetchAll();
$selectedCategory = $_GET['category'] ?? '';
require __DIR__ . '/includes/header.php';
?>
<section class="page-intro">
    <div class="container page-intro-inner"><span class="eyebrow">مساحة مجتمع الجامعة</span>
        <h1>كل ما يحدث، <span>في مكان واحد.</span></h1>
        <p>ابحث عن اللقاء القادم، أو صفِّ النتائج حسب اهتمامك وتاريخك.</p>
    </div>
</section>
<section class="section-block events-list-section">
    <div class="container">
        <div class="filter-toolbar" role="search" aria-label="البحث في الفعاليات">
            <label class="filter-search"><span aria-hidden="true">⌕</span><input type="search" data-event-search placeholder="ابحث عن فعالية أو مكان" aria-label="ابحث عن فعالية أو مكان"></label>
            <label class="filter-select"><span>التصنيف</span><select data-event-category aria-label="تصفية حسب التصنيف">
                    <option value="">كل التصنيفات</option><?php foreach (event_categories() as $category): ?><option value="<?= e($category) ?>" <?= $selectedCategory === $category ? 'selected' : '' ?>><?= e($category) ?></option><?php endforeach; ?>
                </select></label>
            <label class="filter-select"><span>التاريخ</span><input type="date" data-event-date aria-label="تصفية حسب التاريخ"></label>
            <span class="results-count"><strong><?= count($events) ?></strong> فعالية قادمة</span>
        </div>
        <?php if ($events): ?>
            <div class="event-grid event-grid-filterable">
                <?php foreach ($events as $event) require __DIR__ . '/includes/event-card.php'; ?>
            </div>
            <p class="empty-panel" data-empty-state hidden>لا توجد نتائج تطابق خيارات البحث.</p>
        <?php else: ?>
            <div class="empty-panel">لا توجد فعاليات قادمة حاليًا. تابعنا قريبًا.</div>
        <?php endif; ?>
    </div>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>