CREATE DATABASE IF NOT EXISTS events_city
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;
USE events_city;

CREATE TABLE IF NOT EXISTS users (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(80) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS events (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(180) NOT NULL,
  description TEXT NOT NULL,
  category VARCHAR(60) NOT NULL,
  location VARCHAR(180) NOT NULL,
  event_date DATE NOT NULL,
  image VARCHAR(500) NOT NULL,
  is_featured TINYINT(1) NOT NULL DEFAULT 0,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_events_date (event_date),
  INDEX idx_events_category (category)
);

CREATE TABLE IF NOT EXISTS contact_messages (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(120) NOT NULL,
  email VARCHAR(190) NOT NULL,
  message TEXT NOT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO events (title, description, category, location, event_date, image, is_featured) VALUES
('أسبوع الثقافة السورية', 'أيام تحتفي بتنوع الثقافة السورية عبر جلسات حوارية ومعارض للحرف اليدوية وأمسيات أدبية يشارك فيها طلاب وخريجون.', 'ثقافة', 'اللقاء الافتراضي للجامعة', DATE_ADD(CURDATE(), INTERVAL 5 DAY), 'https://images.unsplash.com/photo-1516280440614-37939bbacd81?auto=format&fit=crop&w=1200&q=85', 1),
('ملتقى الابتكار الرقمي', 'مساحة عملية لعرض مشاريع الطلبة في الذكاء الاصطناعي وتصميم المنتجات الرقمية، مع نقاشات قصيرة وجلسات إرشاد.', 'تقنية', 'القاعة الرقمية', DATE_ADD(CURDATE(), INTERVAL 4 DAY), 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?auto=format&fit=crop&w=1200&q=85', 1),
('أمسية موسيقية طلابية', 'لقاء موسيقي يجمع مواهب الجامعة في برنامج متنوع من العزف والغناء، في أجواء مفتوحة لجميع أفراد المجتمع الجامعي.', 'موسيقى', 'استوديو الجامعة الافتراضي', DATE_ADD(CURDATE(), INTERVAL 6 DAY), 'https://images.unsplash.com/photo-1501386761578-eac5c94b800a?auto=format&fit=crop&w=1200&q=85', 1),
('يوم الرياضة الجامعي', 'أنشطة رياضية تفاعلية ومسابقات ودية في كرة السلة وتنس الطاولة، مع فقرات تناسب مختلف المستويات.', 'رياضة', 'مركز الأنشطة الطلابية', DATE_ADD(CURDATE(), INTERVAL 16 DAY), 'https://images.unsplash.com/photo-1461896836934-ffe607ba8211?auto=format&fit=crop&w=1200&q=85', 0),
('نادي القراءة: رواية الشهر', 'نقاش مفتوح حول رواية الشهر بإدارة نادي القراءة. يمكن للحضور المشاركة حتى إن لم ينهوا قراءة الكتاب.', 'ثقافة', 'مكتبة الجامعة الرقمية', DATE_ADD(CURDATE(), INTERVAL 20 DAY), 'https://images.unsplash.com/photo-1507842217343-583bb7270b66?auto=format&fit=crop&w=1200&q=85', 0),
('مختبر العلوم للعائلة', 'تجارب علمية ممتعة وآمنة للأطفال والعائلات، يقدمها متطوعون من طلبة الجامعة في محطات قصيرة.', 'عائلي', 'المختبر الافتراضي', DATE_ADD(CURDATE(), INTERVAL 25 DAY), 'https://images.unsplash.com/photo-1532094349884-543bc11b234d?auto=format&fit=crop&w=1200&q=85', 0),
('ورشة مهارات البحث الأكاديمي', 'ورشة تطبيقية للتعرف إلى مصادر البحث الرقمي، وتقييم المراجع، وتنظيم الاقتباسات للمشاريع الجامعية.', 'أكاديمي', 'مركز مصادر التعلم', DATE_ADD(CURDATE(), INTERVAL 30 DAY), 'https://images.unsplash.com/photo-1521587760476-6c12a4b040da?auto=format&fit=crop&w=1200&q=85', 0),
('مساحة حوار: أفكار تصنع الأثر', 'حوارات قصيرة حول مبادرات يقودها الشباب في مجالات التعليم والثقافة والاستدامة، يعقبها تعارف وتبادل للأفكار.', 'ثقافة', 'الملتقى الطلابي', DATE_ADD(CURDATE(), INTERVAL 36 DAY), 'https://images.unsplash.com/photo-1475721027785-f74eccf877e2?auto=format&fit=crop&w=1200&q=85', 0);