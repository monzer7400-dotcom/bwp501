<?php
require_once __DIR__ . '/db.php';
$pageTitle = 'اتصل بنا';
$activePage = 'contact';
$formError = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $name = trim((string) ($_POST['name'] ?? ''));
    $email = trim((string) ($_POST['email'] ?? ''));
    $message = trim((string) ($_POST['message'] ?? ''));
    $website = trim((string) ($_POST['website'] ?? ''));
    if ($website !== '') {
        header('Location: contact.php?sent=1');
        exit;
    }
    if ($name === '' || mb_strlen($name) > 120 || !filter_var($email, FILTER_VALIDATE_EMAIL) || mb_strlen($email) > 190 || $message === '' || mb_strlen($message) > 3000) {
        $formError = 'تحقق من الحقول المطلوبة وصيغة البريد الإلكتروني، ثم حاول مجددًا.';
    } else {
        $saveMessage = $pdo->prepare('INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)');
        $saveMessage->execute([$name, $email, $message]);
        header('Location: contact.php?sent=1');
        exit;
    }
}
require __DIR__ . '/includes/header.php';
?>
<section class="page-intro">
    <div class="container page-intro-inner"><span class="eyebrow">نحن هنا للاستماع</span>
        <h1>لديك فكرة؟<br><span>لنبدأ الحديث.</span></h1>
        <p>أرسل اقتراحًا أو استفسارًا، وسيصل إلى فريق الدليل.</p>
    </div>
</section>
<section class="section-block contact-section">
    <div class="container contact-layout">
        <div class="contact-form-wrap">
            <?php if (isset($_GET['sent'])): ?><div class="alert alert-success" role="status">وصلتنا رسالتك بنجاح. شكرًا لتواصلك معنا.</div><?php endif; ?>
            <?php if ($formError): ?><div class="alert alert-danger" role="alert"><?= e($formError) ?></div><?php endif; ?>
            <form action="contact.php" method="post" data-contact-form novalidate>
                <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
                <div class="visually-hidden" aria-hidden="true"><label for="website">الموقع</label><input id="website" name="website" tabindex="-1" autocomplete="off"></div>
                <div class="form-field"><label for="contact-name">الاسم</label><input class="form-control" id="contact-name" name="name" type="text" value="<?= e($_POST['name'] ?? '') ?>" autocomplete="name" maxlength="120" required>
                    <div class="invalid-feedback">يرجى كتابة الاسم.</div>
                </div>
                <div class="form-field"><label for="contact-email">البريد الإلكتروني</label><input class="form-control" id="contact-email" name="email" type="email" value="<?= e($_POST['email'] ?? '') ?>" autocomplete="email" maxlength="190" required>
                    <div class="invalid-feedback">أدخل بريدًا إلكترونيًا صالحًا.</div>
                </div>
                <div class="form-field"><label for="contact-message">رسالتك</label><textarea class="form-control" id="contact-message" name="message" rows="6" maxlength="3000" required><?= e($_POST['message'] ?? '') ?></textarea>
                    <div class="invalid-feedback">يرجى كتابة رسالتك.</div>
                </div>
                <button class="button-primary" type="submit">إرسال الرسالة <span aria-hidden="true">←</span></button>
            </form>
        </div>
        <aside class="contact-aside"><span class="eyebrow">تواصل مباشر</span>
            <h2>يسعدنا أن نسمع منك.</h2>
            <p>سواء كنت تقترح فعالية أو تريد الاستفسار عن الدليل، اكتب لنا وسنعود إليك.</p>
            <div class="contact-detail"><span>البريد العام</span><a href="mailto:events@svuonline.org">events@svuonline.org</a></div>
            <div class="contact-detail"><span>الجامعة الافتراضية السورية</span><a href="https://www.svuonline.org/" target="_blank" rel="noopener noreferrer">svuonline.org ↗</a></div>
            <div class="social-line"><span>تابع أخبار الجامعة</span><a href="https://www.facebook.com/SVUonline" target="_blank" rel="noopener noreferrer" aria-label="صفحة الجامعة على فيسبوك">f</a><a href="https://www.instagram.com/svuonline/" target="_blank" rel="noopener noreferrer" aria-label="صفحة الجامعة على إنستغرام">◎</a></div>
        </aside>
    </div>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>