<?php
require_once __DIR__ . '/db.php';
$pageTitle = 'اكتشف ما يحدث هذا الأسبوع';
$activePage = 'home';
$featured = $pdo->query('SELECT * FROM events WHERE is_featured = 1 AND event_date >= CURDATE() ORDER BY event_date LIMIT 3')->fetchAll();
$latest = $pdo->query('SELECT * FROM events WHERE event_date >= CURDATE() ORDER BY created_at DESC, event_date LIMIT 6')->fetchAll();
require __DIR__ . '/includes/header.php';
?>
<section class="hero-section">
    <div class="container hero-grid">
        <div class="hero-copy">
            <span class="eyebrow"><span class="eyebrow-dot"></span> مجتمع الجامعة الافتراضية السورية</span>
            <h1>لقاءات تستحق<br><span>أن تكون في تقويمك.</span></h1>
            <p>من أمسية موسيقية إلى ورشة تغيّر مسارك، اكتشف كل ما يجمع مجتمع الجامعة في مكان واحد.</p>
            <div class="hero-actions">
                <a class="button-primary" href="events.php">استكشف الفعاليات <span aria-hidden="true">←</span></a>
                <a class="hero-secondary" href="about.php">تعرّف على الدليل</a>
            </div>
            <div class="hero-note"><span class="note-mark">+</span><span>فعاليات أكاديمية وثقافية<br>لكل مجتمع الجامعة</span></div>
        </div>
        <div class="hero-art" aria-label="لقاء طلابي في فعالية جامعية">
            <img src="https://images.unsplash.com/photo-1511795409834-ef04bbd61622?auto=format&fit=crop&w=1300&q=90" alt="حضور يشاركون في لقاء جامعي" fetchpriority="high">
            <div class="hero-image-caption"><span class="caption-kicker">أفكار. لقاءات. مجتمع.</span><strong>مساحة تنبض بالحياة</strong></div>
            <div class="hero-stamp" aria-hidden="true"><span>SVU</span><small>معاً نلتقي</small></div>
        </div>
    </div>
</section>

<section class="section-block featured-section">
    <div class="container">
        <div class="section-heading">
            <div><span class="eyebrow">لا تفوّت القادم</span>
                <h2>بارزة هذا الأسبوع</h2>
            </div>
            <a class="text-link" href="events.php">كل الفعاليات <span aria-hidden="true">←</span></a>
        </div>
        <?php if ($featured): ?>
            <div id="featuredEvents" class="carousel slide featured-carousel" data-bs-ride="carousel" data-bs-interval="6500">
                <div class="carousel-indicators">
                    <?php foreach ($featured as $index => $event): ?>
                        <button type="button" data-bs-target="#featuredEvents" data-bs-slide-to="<?= $index ?>" class="<?= $index === 0 ? 'active' : '' ?>" aria-label="الفعالية <?= $index + 1 ?>"></button>
                    <?php endforeach; ?>
                </div>
                <div class="carousel-inner">
                    <?php foreach ($featured as $index => $event): ?>
                        <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                            <a class="featured-slide" href="event.php?id=<?= (int) $event['id'] ?>">
                                <img src="<?= e(image_url($event['image'])) ?>" alt="" loading="lazy">
                                <span class="featured-shade"></span>
                                <span class="featured-label">اختيار الأسبوع <span aria-hidden="true">✳</span></span>
                                <span class="featured-content"><span><?= e($event['category']) ?> · <?= e(format_event_date($event['event_date'])) ?></span><strong><?= e($event['title']) ?></strong><span class="featured-cta">اكتشف التفاصيل <span aria-hidden="true">←</span></span></span>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
                <?php if (count($featured) > 1): ?>
                    <button class="carousel-control-prev" type="button" data-bs-target="#featuredEvents" data-bs-slide="prev" aria-label="الفعالية السابقة"><span class="carousel-control-prev-icon"></span></button>
                    <button class="carousel-control-next" type="button" data-bs-target="#featuredEvents" data-bs-slide="next" aria-label="الفعالية التالية"><span class="carousel-control-next-icon"></span></button>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <div class="empty-panel">لا توجد فعاليات بارزة حاليًا. تصفّح بقية الفعاليات لاكتشاف القادم.</div>
        <?php endif; ?>
    </div>
</section>

<section class="category-band">
    <div class="container category-inner">
        <div><span class="eyebrow">اختر ما يشبهك</span>
            <h2>اهتمامات كثيرة،<br>ومكان واحد.</h2>
        </div>
        <div class="category-list">
            <?php foreach (['ثقافة' => '01', 'رياضة' => '02', 'موسيقى' => '03', 'عائلي' => '04', 'أكاديمي' => '05', 'تقنية' => '06'] as $name => $number): ?>
                <a class="category-item" href="events.php?category=<?= urlencode($name) ?>"><span><?= $number ?></span><strong><?= e($name) ?></strong><i aria-hidden="true">↗</i></a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section-block latest-section">
    <div class="container">
        <div class="section-heading">
            <div><span class="eyebrow">أضيفت إلى الدليل</span>
                <h2>أحدث الفعاليات</h2>
            </div>
            <a class="text-link" href="events.php">اكتشف الجميع <span aria-hidden="true">←</span></a>
        </div>
        <?php if ($latest): ?>
            <div class="event-grid">
                <?php foreach ($latest as $event) require __DIR__ . '/includes/event-card.php'; ?>
            </div>
        <?php else: ?>
            <div class="empty-panel">لا توجد فعاليات منشورة بعد. ستظهر الفعاليات هنا فور إضافتها.</div>
        <?php endif; ?>
    </div>
</section>

<section class="team-strip">
    <div class="container team-strip-inner">
        <div><span class="eyebrow">إعداد المشروع</span>
            <h2>عمل طلابي مشترك</h2>
        </div>
        <div class="team-inline"><span>أعضاء المشروع · 501BWP</span><strong>إبراهيم 112299 · أحمد 229900 · أضف العضو الثالث</strong><small>تحقق من الأسماء والأرقام وأكمل بيانات المجموعة قبل التسليم.</small></div>
        <a class="button-outline" href="about.php">الفريق والسياسات <span aria-hidden="true">←</span></a>
    </div>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>