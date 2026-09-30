<?php
require_once __DIR__ . '/db.php';
$eventId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$statement = $pdo->prepare('SELECT * FROM events WHERE id = ?');
$statement->execute([$eventId ?: 0]);
$event = $statement->fetch();
if (!$event) {
    http_response_code(404);
    $pageTitle = 'الفعالية غير موجودة';
    require __DIR__ . '/includes/header.php';
    echo '<section class="section-block container"><div class="empty-panel"><h1>لم نعثر على هذه الفعالية</h1><a class="text-link" href="events.php">العودة إلى قائمة الفعاليات</a></div></section>';
    require __DIR__ . '/includes/footer.php';
    exit;
}
$pageTitle = $event['title'];
$activePage = 'events';
$relatedQuery = $pdo->prepare('SELECT * FROM events WHERE category = ? AND id <> ? AND event_date >= CURDATE() ORDER BY event_date LIMIT 3');
$relatedQuery->execute([$event['category'], $event['id']]);
$relatedEvents = $relatedQuery->fetchAll();
$calendarData = json_encode(['title' => $event['title'], 'date' => $event['event_date'], 'location' => $event['location'], 'description' => $event['description']], JSON_UNESCAPED_UNICODE | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_HEX_TAG);
require __DIR__ . '/includes/header.php';
?>
<section class="event-detail-section">
    <div class="container">
        <nav class="breadcrumb-line" aria-label="مسار التنقل"><a href="index.php">الرئيسية</a><span>/</span><a href="events.php">الفعاليات</a><span>/</span><span><?= e($event['title']) ?></span></nav>
        <div class="detail-layout">
            <article class="detail-main">
                <div class="detail-image"><img src="<?= e(image_url($event['image'])) ?>" alt="صورة فعالية <?= e($event['title']) ?>"></div>
                <div class="detail-copy">
                    <span class="category-tag category-tag-static"><?= e($event['category']) ?></span>
                    <h1><?= e($event['title']) ?></h1>
                    <div class="detail-facts"><span><i aria-hidden="true">◷</i><?= e(format_event_date($event['event_date'])) ?></span><span><i aria-hidden="true">⌖</i><?= e($event['location']) ?></span></div>
                    <div class="detail-description">
                        <h2>عن الفعالية</h2>
                        <p><?= nl2br(e($event['description'])) ?></p>
                    </div>
                    <div class="detail-actions">
                        <button class="button-primary" type="button" data-calendar-event="<?= e($calendarData) ?>">أضف إلى التقويم <span aria-hidden="true">＋</span></button>
                        <button class="button-outline" type="button" data-share-event data-title="<?= e($event['title']) ?>">شارك الفعالية <span aria-hidden="true">↗</span></button>
                    </div>
                </div>
            </article>
            <aside class="detail-aside"><span class="eyebrow">خطّط لوقتك</span>
                <h2>موعد اللقاء</h2>
                <div class="aside-date"><strong><?= e(date('d', strtotime($event['event_date']))) ?></strong><span><?= e(date('m / Y', strtotime($event['event_date']))) ?></span></div>
                <p><?= e(format_event_date($event['event_date'])) ?></p>
                <div class="aside-rule"></div><span class="aside-label">المكان</span><strong class="aside-location"><?= e($event['location']) ?></strong><a class="text-link" href="events.php?category=<?= urlencode($event['category']) ?>">فعاليات من التصنيف نفسه <span aria-hidden="true">←</span></a>
            </aside>
        </div>
    </div>
</section>
<?php if ($relatedEvents): ?>
    <section class="section-block related-section">
        <div class="container">
            <div class="section-heading">
                <div><span class="eyebrow">قد يهمك أيضًا</span>
                    <h2>فعاليات ذات صلة</h2>
                </div><a class="text-link" href="events.php">كل الفعاليات <span aria-hidden="true">←</span></a>
            </div>
            <div class="event-grid"><?php foreach ($relatedEvents as $event): require __DIR__ . '/includes/event-card.php';
                                    endforeach; ?></div>
        </div>
    </section>
<?php endif; ?>
<?php require __DIR__ . '/includes/footer.php'; ?>