<?php
defined( 'ABSPATH' ) || exit;

$home = function_exists( 'matin_parto_home_settings' ) ? matin_parto_home_settings() : array();
$about_hero  = get_theme_mod( 'matin_parto_about_hero_image', '' );
$about_story = get_theme_mod( 'matin_parto_about_story_image', '' );
$about_video = get_theme_mod( 'matin_parto_about_video_image', '' );
$about_extra = get_theme_mod( 'matin_parto_about_extra_image', '' );
if ( ! $about_hero && ! empty( $home['hero_image'] ) ) { $about_hero = $home['hero_image']; }
if ( ! $about_video && ! empty( $home['hero_image'] ) ) { $about_video = $home['hero_image']; }
if ( ! $about_story && ! empty( $home['hero_image'] ) ) { $about_story = $home['hero_image']; }

$reviews = array( array( 'سارا محمدی', 'Intermediate زبان‌آموز دوره', '«متین پارتو فقط یک مدرس نیست؛ یک همراه واقعی در مسیر یادگیریه. با صبر، انگیزه و روش‌های عالی تدریس، باعث شد من با اعتماد به نفس بیشتری صحبت کنم.»', 5, 0 ) );
if ( function_exists( 'matin_parto_get_testimonials' ) ) {
    $q = matin_parto_get_testimonials( 1 );
    if ( $q->have_posts() ) {
        $reviews = array();
        while ( $q->have_posts() ) {
            $q->the_post();
            $rating = max( 1, min( 5, absint( get_post_meta( get_the_ID(), '_mp_testimonial_rating', true ) ?: 5 ) ) );
            $course = get_post_meta( get_the_ID(), '_mp_testimonial_course', true );
            $reviews[] = array( get_the_title(), $course, wp_strip_all_tags( get_the_content() ), $rating, get_post_thumbnail_id() );
        }
        wp_reset_postdata();
    }
}

$reasons = array(
    array( 'star', 'تجربه و تخصص', 'سال‌ها تدریس و تجربه موفق در آزمون‌های بین‌المللی' ),
    array( 'heart', 'تعهد و علاقه واقعی', 'من به آموزش و موفقیت شما اهمیت می‌دهم و با تمام توان در کنار شما هستم.' ),
    array( 'chart', 'نتایج ملموس', 'با تمرکز بر مکالمه، شنیداری و مهارت‌های کاربردی، پیشرفت شما را دنبال می‌کنم.' ),
    array( 'chat', 'روش تدریس مدرن و تعاملی', 'استفاده از تکنیک‌های به‌روز و تمرین‌های عملی برای یادگیری عمیق‌تر.' ),
    array( 'users', 'پشتیبانی همیشگی', 'در تمام مراحل یادگیری همراه شما هستم و پاسخگوی سوالاتتان می‌باشم.' ),
    array( 'target', 'برنامه‌ریزی شخصی‌سازی شده', 'با توجه به سطح، هدف و سبک یادگیری شما، برنامه‌ای اختصاصی طراحی می‌کنم.' ),
);
$stats = array(
    array( 'book', '۳ زبان', 'تسلط به زبان‌های انگلیسی، آلمانی و فرانسه' ),
    array( 'star', '۹۸٪', 'رضایت دانشجویان' ),
    array( 'users', '+۵۰۰', 'دانشجوی موفق' ),
    array( 'cap', '+۷ سال', 'تجربه تدریس حرفه‌ای' ),
);
get_header();
/* صفحه درباره من به‌صورت مستقل استایل می‌شود؛ این خط تضمین می‌کند حتی اگر enqueue قالب اجرا نشود CSS لود شود. */
?>
<link rel="stylesheet" id="matin-parto-about-page-css" href="<?php echo esc_url( get_theme_file_uri( 'assets/css/about-page.css' ) ); ?>?ver=2026.09.14-6" media="all">
<main class="mp-about-page" dir="rtl">
    <section class="mp-about-hero">
        <div class="mp-container mp-about-hero__grid">
            <div class="mp-about-hero__visual">
                <div class="mp-about-hero__dots" aria-hidden="true"></div>
                <div class="mp-about-hero__arch" aria-hidden="true"></div>
                <?php if ( $about_hero ) : ?><img src="<?php echo esc_url( $about_hero ); ?>" alt="معرفی مدرس زبان انگلیسی ماتین پرتو" loading="eager" fetchpriority="high"><?php else : ?><div class="mp-about-placeholder">عکس مدرس</div><?php endif; ?>
                <span class="mp-about-handwrite" aria-hidden="true">About<br>Me</span>
            </div>
            <div class="mp-about-hero__copy">
                <span class="mp-about-kicker">درباره من <i></i></span>
                <h1>سلام، من متین پارتو هستم</h1>
                <h2>مدرس زبان انگلیسی</h2>
                <p>من به آموزش زبان انگلیسی به‌عنوان یک ابزار قدرتمند برای ساختن آینده بهتر باور دارم. در این مسیر، هدف من فقط آموزش گرامر زبان نیست، بلکه همراهی با شما برای رسیدن به اهداف و رویاهایتان است.</p>
                <div class="mp-about-signature">Matin Parto</div>
                <a class="mp-button mp-button--primary" href="#story">بیشتر درباره من <span>←</span></a>
            </div>
        </div>
    </section>

    <section class="mp-about-stats mp-container">
        <?php foreach ( $stats as $stat ) : ?><div class="mp-about-stat"><span class="mp-about-icon mp-about-icon--<?php echo esc_attr( $stat[0] ); ?>" aria-hidden="true"></span><div><b><?php echo esc_html( $stat[1] ); ?></b><small><?php echo esc_html( $stat[2] ); ?></small></div></div><?php endforeach; ?>
    </section>

    <section class="mp-about-story mp-section" id="story">
        <div class="mp-container mp-about-story__grid">
            <div class="mp-about-story__media">
                <?php if ( $about_video ) : ?><img src="<?php echo esc_url( $about_video ); ?>" alt="آموزش زبان انگلیسی" loading="lazy"><?php else : ?><div class="mp-about-media-placeholder">تصویر آموزش</div><?php endif; ?>
                <button class="mp-about-play" type="button" aria-label="پخش ویدئوی معرفی">▶</button>
                <span class="mp-about-video-caption">Better<br>English<br>Bigger<br>Dreams</span>
            </div>
            <div class="mp-about-story__copy">
                <span class="mp-about-kicker">مسیر من <i></i></span>
                <h2>چطور وارد دنیای آموزش شدم؟</h2>
                <p>همیشه به زبان و ارتباط با آدم‌های مختلف علاقه داشتم. زمانی که متوجه شدم آموزش زبان فقط یک شغل نیست و می‌تواند مسیر زندگی افراد را تغییر دهد، تصمیم گرفتم تمام توانم را برای ساختن یک مسیر یادگیری واقعی به کار بگیرم.</p>
                <p>بعد از سال‌ها تجربه یادگیری و تدریس، امروز با افتخار در کنار شما هستم تا بهترین تجربه یادگیری را رقم بزنیم.</p>
            </div>
        </div>
    </section>

    <section class="mp-about-reasons mp-section">
        <div class="mp-container">
            <div class="mp-about-section-head"><span class="mp-about-kicker">چرا من؟ <i></i></span><h2>آنچه یادگیری با من را متفاوت می‌کند</h2></div>
            <div class="mp-about-reasons-grid">
                <?php foreach ( $reasons as $reason ) : ?><article class="mp-about-reason"><span class="mp-about-reason__icon mp-about-reason__icon--<?php echo esc_attr( $reason[0] ); ?>"></span><h3><?php echo esc_html( $reason[1] ); ?></h3><p><?php echo esc_html( $reason[2] ); ?></p></article><?php endforeach; ?>
            </div>
        </div>
    </section>

    <?php if ( $about_extra ) : ?><section class="mp-about-extra mp-container"><img src="<?php echo esc_url( $about_extra ); ?>" alt="تصویر ماتین پرتو" loading="lazy"></section><?php endif; ?>

    <section class="mp-about-testimonial mp-container">
        <div class="mp-about-quote">”</div>
        <?php foreach ( $reviews as $review ) : ?><div class="mp-about-testimonial__author">
            <?php if ( ! empty( $review[4] ) ) : ?><?php echo wp_get_attachment_image( $review[4], array( 64, 64 ), false, array( 'class' => 'mp-about-avatar', 'alt' => esc_attr( $review[0] ) ) ); ?><?php else : ?><span class="mp-about-avatar mp-about-avatar--placeholder"></span><?php endif; ?>
            <div><b><?php echo esc_html( $review[0] ); ?></b><small><?php echo esc_html( $review[1] ); ?></small><span><?php echo str_repeat( '★', (int) $review[3] ); ?></span></div>
        </div><div class="mp-about-testimonial__text"><strong>« متین پارتو فقط یک مدرس نیست؛ »</strong><p><?php echo esc_html( $review[2] ); ?></p></div><?php endforeach; ?>
    </section>
</main>
<?php get_footer(); ?>
