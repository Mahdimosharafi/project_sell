<?php
defined( 'ABSPATH' ) || exit;
$contact = function( $key, $default = '' ) { return get_theme_mod( 'matin_parto_contact_' . $key, $default ); };
$hero_image = $contact( 'hero_image', '' );
$aside_image = $contact( 'aside_image', '' );
$map_image = $contact( 'map_image', '' );
$status = isset( $_GET['contact'] ) ? sanitize_key( wp_unslash( $_GET['contact'] ) ) : '';
get_header();
?>
<link rel="stylesheet" id="matin-parto-contact-page-css" href="<?php echo esc_url( get_theme_file_uri( 'assets/css/contact-page.css' ) ); ?>?ver=20260915-4" media="all">
<main class="mp-contact-page" dir="rtl">
<section class="mp-contact-hero">
<div class="mp-container mp-contact-hero__grid">
<div class="mp-contact-hero__visual">
<div class="mp-contact-hero__arch" aria-hidden="true"></div>
<?php if ( $hero_image ) : ?><img src="<?php echo esc_url( $hero_image ); ?>" alt="تماس با ما" loading="eager" fetchpriority="high"><?php else : ?><div class="mp-contact-image-placeholder">تصویر مدرس</div><?php endif; ?>
<span class="mp-contact-handwrite" aria-hidden="true">Let's<br>Keep in<br>Touch</span>
</div>
<div class="mp-contact-hero__copy">
<div class="mp-contact-kicker">تماس با ما <i></i></div>
<h1>با ما در ارتباط باشید</h1>
<h2>همیشه پاسخگوی سوالات شما هستیم</h2>
<p>اگر سوالی درباره دوره‌ها، نحوه ثبت‌نام، پشتیبانی و یا هر موضوع دیگری دارید، از طریق یکی از راه‌های ارتباطی زیر با ما در تماس باشید. ما در سریع‌ترین زمان ممکن پاسخگوی شما خواهیم بود.</p>
<div class="mp-contact-signature">Matin Parto</div>
</div>
</div>
</section>

<section class="mp-container mp-contact-info" aria-label="راه‌های ارتباطی">
<div class="mp-contact-info-card"><span class="mp-contact-icon" aria-hidden="true">☎</span><h3>شماره تماس</h3><p>شنبه تا پنجشنبه، ۹ صبح تا ۶ عصر</p><a href="tel:+989123456789">+98 912 345 6789</a></div>
<div class="mp-contact-info-card"><span class="mp-contact-icon" aria-hidden="true">✉</span><h3>ایمیل</h3><p>در هر زمان آماده پاسخگویی هستیم</p><a href="mailto:info@matinparto.com">info@matinparto.com</a></div>
<div class="mp-contact-info-card"><span class="mp-contact-icon" aria-hidden="true">⌖</span><h3>آدرس</h3><p>تهران، خیابان ولیعصر، پلاک ۱۳۲</p><span>ساختمان متین پارتو، طبقه ۳</span></div>
<div class="mp-contact-info-card"><span class="mp-contact-icon" aria-hidden="true">➤</span><h3>شبکه‌های اجتماعی</h3><p>ما را در شبکه‌های اجتماعی دنبال کنید</p><div class="mp-contact-social-links"><a href="#" aria-label="اینستاگرام">◎</a><a href="#" aria-label="تلگرام">➤</a><a href="#" aria-label="یوتیوب">▶</a></div></div>
</section>

<section class="mp-container mp-contact-work" id="contact-form">
<div class="mp-contact-form-card">
<div class="mp-contact-form-head"><div class="mp-contact-kicker">فرم تماس <i></i></div><h2>پیام خود را برای ما ارسال کنید</h2><p>پرسش‌های خود را از طریق فرم زیر با ما در میان بگذارید. در اسرع وقت پاسخ شما را می‌دهیم.</p></div>
<?php if ( 'sent' === $status ) : ?><div class="mp-contact-alert mp-contact-alert--success">پیام شما با موفقیت ارسال شد.</div><?php elseif ( 'error' === $status ) : ?><div class="mp-contact-alert mp-contact-alert--error">ارسال پیام انجام نشد. لطفاً اطلاعات را بررسی و دوباره تلاش کنید.</div><?php endif; ?>
<form class="mp-contact-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
<input type="hidden" name="action" value="matin_parto_contact"><input type="hidden" name="matin_parto_contact_nonce" value="<?php echo esc_attr( wp_create_nonce( 'matin_parto_contact_form' ) ); ?>">
<label><span>نام و نام خانوادگی <b>*</b></span><input type="text" name="contact_name" placeholder="نام و نام خانوادگی" required></label>
<label><span>ایمیل <b>*</b></span><input type="email" name="contact_email" placeholder="ایمیل" required></label>
<label class="mp-contact-form__full"><span>موضوع پیام <b>*</b></span><select name="contact_subject" required><option value="">انتخاب کنید</option><option value="مشاوره دوره">مشاوره دوره</option><option value="پشتیبانی">پشتیبانی</option><option value="ثبت نام">ثبت نام</option><option value="سایر">سایر</option></select></label>
<label class="mp-contact-form__full"><span>متن پیام <b>*</b></span><textarea name="contact_message" placeholder="پیام خود را اینجا بنویسید..." required></textarea></label>
<div class="mp-contact-form__footer"><label class="mp-contact-consent"><input type="checkbox" required><span>با ارسال پیام، با قوانین و مقررات سایت موافقت می‌کنم.</span></label><button class="mp-button mp-button--primary" type="submit">ارسال پیام <span>➤</span></button></div>
</form>
</div>
<aside class="mp-contact-aside">
<div class="mp-contact-aside__media"><?php if ( $aside_image ) : ?><img src="<?php echo esc_url( $aside_image ); ?>" alt="" loading="lazy"><?php endif; ?><div class="mp-contact-aside__quote">« یادگیری یک زبان،<br>یک مهارت نیست،<br>یک سبک زندگی است »<small>Matin Parto</small></div></div>
<div class="mp-contact-aside__services"><div><span class="mp-contact-service-icon">◷</span><p><b>پاسخگویی سریع</b><small>در کمتر از ۲۴ ساعت</small></p></div><div><span class="mp-contact-service-icon">♧</span><p><b>مشاوره رایگان</b><small>برای انتخاب بهترین دوره</small></p></div><div><span class="mp-contact-service-icon">♡</span><p><b>پشتیبانی کامل</b><small>در تمام مراحل یادگیری</small></p></div></div>
</aside>
</section>

<section class="mp-container mp-contact-location">
<div class="mp-contact-map"><?php if ( $map_image ) : ?><img src="<?php echo esc_url( $map_image ); ?>" alt="نقشه آدرس متین پارتو" loading="lazy"><?php else : ?><div class="mp-contact-map-placeholder"><i aria-hidden="true"></i><span>نقشه و موقعیت مکانی</span></div><?php endif; ?></div>
<div class="mp-contact-location__copy"><div class="mp-contact-kicker">موقعیت ما <i></i></div><h2>آدرس و لوکیشن</h2><p>برای مراجعه حضوری، آدرس ما را در نقشه پیدا کنید.</p><strong>تهران، خیابان ولیعصر، پلاک ۱۳۲</strong><span>ساختمان متین پارتو، طبقه ۳</span><a class="mp-button mp-button--primary" href="#">مشاهده در نقشه ⌖</a></div>
</section>
</main>
<?php get_footer(); ?>