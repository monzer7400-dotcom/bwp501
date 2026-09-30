<?php
$event = $event ?? [];
$formAction = $formAction ?? '';
$submitLabel = $submitLabel ?? 'حفظ';
$categories = event_categories();
?>
<form class="admin-form" method="post" action="<?= e($formAction) ?>">
    <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
    <div class="form-field"><label for="title">عنوان الفعالية</label><input class="form-control" id="title" name="title" type="text" maxlength="180" value="<?= e($event['title'] ?? '') ?>" required></div>
    <div class="form-field"><label for="category">التصنيف</label><select class="form-select" id="category" name="category" required>
            <option value="">اختر تصنيفًا</option><?php foreach ($categories as $category): ?><option value="<?= e($category) ?>" <?= ($event['category'] ?? '') === $category ? 'selected' : '' ?>><?= e($category) ?></option><?php endforeach; ?>
        </select></div>
    <div class="form-field"><label for="event_date">تاريخ الفعالية</label><input class="form-control" id="event_date" name="event_date" type="date" value="<?= e($event['event_date'] ?? '') ?>" required></div>
    <div class="form-field"><label for="location">المكان</label><input class="form-control" id="location" name="location" type="text" maxlength="180" value="<?= e($event['location'] ?? '') ?>" required></div>
    <div class="form-field form-field-wide"><label for="description">وصف الفعالية</label><textarea class="form-control" id="description" name="description" rows="6" required><?= e($event['description'] ?? '') ?></textarea></div>
    <div class="form-field form-field-wide"><label for="image">رابط الصورة</label><input class="form-control" id="image" name="image" type="url" maxlength="500" value="<?= e($event['image'] ?? '') ?>" placeholder="https://example.com/event.jpg" required><small>استخدم رابط صورة مباشر يبدأ بـ https://</small></div>
    <label class="featured-check"><input type="checkbox" name="is_featured" value="1" <?= !empty($event['is_featured']) ? 'checked' : '' ?>><span>إظهار ضمن الفعاليات البارزة</span></label>
    <div class="form-field-wide admin-form-actions"><a class="button-outline" href="dashboard.php">إلغاء</a><button class="button-primary" type="submit"><?= e($submitLabel) ?> <span aria-hidden="true">←</span></button></div>
</form>