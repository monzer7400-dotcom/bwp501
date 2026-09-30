<?php $event = $event ?? []; ?>
<article class="event-card" data-event-card data-category="<?= e($event['category']) ?>" data-date="<?= e($event['event_date']) ?>" data-search="<?= e(mb_strtolower($event['title'] . ' ' . $event['description'] . ' ' . $event['location'] . ' ' . $event['category'], 'UTF-8')) ?>">
    <a class="event-card-image" href="event.php?id=<?= (int) $event['id'] ?>" tabindex="-1" aria-hidden="true">
        <img src="<?= e(image_url($event['image'])) ?>" alt="" loading="lazy">
        <span class="category-tag"><?= e($event['category']) ?></span>
    </a>
    <div class="event-card-body">
        <div class="event-meta"><span><?= e(format_event_date($event['event_date'])) ?></span><span class="meta-dot"></span><span><?= e($event['location']) ?></span></div>
        <h3><a href="event.php?id=<?= (int) $event['id'] ?>"><?= e($event['title']) ?></a></h3>
        <p><?= e(mb_strimwidth($event['description'], 0, 150, '…', 'UTF-8')) ?></p>
        <a class="text-link" href="event.php?id=<?= (int) $event['id'] ?>">اكتشف الفعالية <span aria-hidden="true">←</span></a>
    </div>
</article>