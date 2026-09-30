<?php
require_once __DIR__ . '/db.php';
$pageTitle = 'عن الدليل';
$activePage = 'about';
require __DIR__ . '/includes/header.php';
?>
<section class="page-intro">
    <div class="container page-intro-inner"><span class="eyebrow">عن الفكرة</span>
        <h1>نقرّب المسافات،<br><span>ونجمع مجتمعنا.</span></h1>
        <p>دليل فعاليات الجامعة الافتراضية السورية مساحة رقمية تساعد الطلاب على اكتشاف الأنشطة الأكاديمية والثقافية والاجتماعية والمشاركة فيها.</p>
    </div>
</section>
<section class="about-manifesto">
    <div class="container manifesto-grid">
        <div class="manifesto-mark" aria-hidden="true">SVU<span>✳</span></div>
        <div><span class="eyebrow">رؤيتنا</span>
            <h2>جامعة لا تقتصر على شاشة المحاضرة.</h2>
            <p>نؤمن أن التجربة الجامعية تنمو بالمعرفة وباللقاءات أيضًا. لذلك يجمع الدليل فعاليات المجتمع في مكان واضح، ويمنح كل مبادرة فرصة للوصول إلى من يهتم بها.</p>
        </div>
    </div>
</section>
<section class="section-block team-section">
    <div class="container">
        <div class="section-heading">
            <div><span class="eyebrow">المشروع الجامعي · 501BWP</span>
                <h2>فريق العمل</h2>
            </div><span class="team-count">بيانات قابلة للتعديل</span>
        </div>
        <div class="team-grid">
            <article class="team-member"><span class="member-number">01</span>
                <div class="member-avatar">إ</div>
                <h3>إبراهيم</h3>
                <p>رقم الطالب: <strong>112299</strong></p><span class="member-role">تطوير الواجهة وتجربة الاستخدام</span>
            </article>
            <article class="team-member"><span class="member-number">02</span>
                <div class="member-avatar avatar-green">أ</div>
                <h3>أحمد</h3>
                <p>رقم الطالب: <strong>229900</strong></p><span class="member-role">قاعدة البيانات ولوحة الإدارة</span>
            </article>
            <article class="team-member team-placeholder"><span class="member-number">03</span>
                <div class="member-avatar avatar-yellow">+</div>
                <h3>أضف اسم العضو الثالث</h3>
                <p>رقم الطالب: <strong>أضف الرقم الجامعي</strong></p><span class="member-role">حدّث بيانات الفريق قبل التسليم</span>
            </article>
        </div>
        <p class="team-note">الأسماء والرقمان الأوليان مستنتجان من اسم مجلد المشروع؛ راجعها وأضف بقية أعضاء المجموعة قبل إرسال الرابط.</p>
    </div>
</section>
<section class="policy-section">
    <div class="container policy-layout">
        <div><span class="eyebrow">معايير النشر</span>
            <h2>كيف تنضم فعالية إلى الدليل؟</h2>
            <p>نرحب بمبادرات مجتمع الجامعة التي تجمع المعرفة والتجربة والحوار.</p>
        </div>
        <div class="policy-list">
            <article><span>01</span>
                <div>
                    <h3>ارتباط واضح بالجامعة</h3>
                    <p>تُقدّم الفعالية من طالب أو جهة أو نادٍ ضمن مجتمع الجامعة الافتراضية.</p>
                </div>
            </article>
            <article><span>02</span>
                <div>
                    <h3>معلومات دقيقة</h3>
                    <p>يُذكر عنوان الفعالية وموعدها ومكانها ووصف مفهوم وصورة مناسبة.</p>
                </div>
            </article>
            <article><span>03</span>
                <div>
                    <h3>مساحة مرحّبة</h3>
                    <p>تُحترم خصوصية المشاركين، وتُكتب التفاصيل بلغة واضحة وشاملة.</p>
                </div>
            </article>
            <article><span>04</span>
                <div>
                    <h3>مراجعة قبل النشر</h3>
                    <p>يحتفظ فريق الدليل بحق تحديث المحتوى أو إزالة الفعاليات المنتهية.</p>
                </div>
            </article>
        </div>
    </div>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>