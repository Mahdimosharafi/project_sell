<?php
defined( 'ABSPATH' ) || exit;

$home = function_exists( 'matin_parto_home_settings' ) ? matin_parto_home_settings() : array();
$hero_image = get_theme_mod( 'matin_parto_about_hero_image', '' );
if ( ! $hero_image && ! empty( $home['hero_image'] ) ) $hero_image = $home['hero_image'];
$story_image = get_theme_mod( 'matin_parto_about_story_image', '' );
if ( ! $story_image ) $story_image = $hero_image;
$about_video = function_exists( 'matin_parto_get_about_video' ) ? matin_parto_get_about_video() : null;
$about_video_image = get_theme_mod( 'matin_parto_about_video_image', '' );
if ( ! $about_video_image ) $about_video_image = $story_image;

$stats = array(
    array( 'book', '+۱۰ سال', 'تجربه تدریس حرفه‌ای' ),
    array( 'users', '+۵۰۰', 'دانشجوی موفق' ),
    array( 'star', '۹۸٪', 'رضایت دانشجویان' ),
    array( 'cap', '۳ زبان', 'تسلط به زبان‌های انگلیسی، آلمانی و فرانسه' ),
);
$reasons = array(
    array( 'target', 'برنامه‌ریزی شخصی‌سازی‌شده', 'با توجه به سطح، هدف و سبک یادگیری شما برنامه اختصاصی طراحی می‌کنم.' ),
    array( 'users', 'پشتیبانی همیشگی', 'در تمام مراحل یادگیری همراه شما هستم و به سوالاتتان پاسخ می‌دهم.' ),
    array( 'star', 'تجربه و تخصص', 'سال‌ها تدریس و تجربه موفق در آزمون‌های بین‌المللی.' ),
    array( 'chat', 'روش تدریس مدرن و تعاملی', 'استفاده از تکنیک‌های به‌روز و تمرین‌های عملی برای یادگیری عمیق‌تر.' ),
    array( 'chart', 'نتایج ملموس', 'با تمرکز بر مکالمه، شنیداری و مهارت‌های کاربردی، پیشرفت شما را دنبال می‌کنم.' ),
    array( 'heart', 'تعهد و علاقه واقعی', 'من به آموزش و موفقیت شما اهمیت می‌دهم و با تمام توان در کنارتان هستم.' ),
);
$review = array( 'سارا محمدی', 'دانشجوی دوره Intermediate', 'متین پارتو فقط یک مدرس نیست، یک همراه واقعی در مسیر یادگیریه. با صبر، انگیزه و روش‌های عالی تدریسش باعث شد با اعتماد به نفس بیشتری صحبت کنم.', 5, 0 );
if ( function_exists( 'matin_parto_get_testimonials' ) ) {
    $q = matin_parto_get_testimonials( 1 );
    if ( $q->have_posts() ) {
        $q->the_post();
        $review = array( get_the_title(), get_post_meta( get_the_ID(), '_mp_testimonial_course', true ) ?: 'دانشجوی دوره', wp_strip_all_tags( get_the_content() ), max(1,min(5,absint(get_post_meta(get_the_ID(),'_mp_testimonial_rating',true) ?: 5))), get_post_thumbnail_id() );
        wp_reset_postdata();
    }
}

get_header();
?>
<link rel="stylesheet" id="matin-parto-about-page-css" href="<?php echo esc_url( get_theme_file_uri( 'assets/css/about-page.css' ) ); ?>?ver=20260915-2" media="all">
<main class="mp-about-page" dir="rtl">
    <section class="mp-about-hero">
        <div class="mp-container mp-about-hero__grid">
            <div class="mp-about-hero__visual">
                <div class="mp-about-hero__arch" aria-hidden="true"></div>
                <?php if ( $hero_image ) : ?><img src="<?php echo esc_url( $hero_image ); ?>" alt="ماتین پارتو" loading="eager" fetchpriority="high">
                <?php else : ?><div class="mp-about-placeholder">تصویر مدرس</div><?php endif; ?>
                <span class="mp-about-handwrite" aria-hidden="true">About Me</span>
            </div>
            <div class="mp-about-hero__copy">
                <div class="mp-about-kicker">درباره من <i></i></div>
                <h1>سلام، من متین پارتو هستم</h1>
                <h2>مدرس زبان انگلیسی</h2>
                <p>من به آموزش زبان انگلیسی به‌عنوان یک ابزار قدرتمند برای ساختن آینده‌ی بهتر باور دارم. در این مسیر، هدف من فقط آموزش گرامر زبان نیست، بلکه همراهی با شما برای رسیدن به اهداف و رویاهایتان است.</p>
                <div class="mp-about-signature">Matin Parto</div>
                <a class="mp-button mp-button--primary" href="#contact-about">تماس با من <span>←</span></a>
            </div>
        </div>
    </section>

    <section class="mp-about-stats mp-container" aria-label="آمار">
        <?php foreach ( $stats as $stat ) : ?><div class="mp-about-stat"><span class="mp-about-icon mp-about-icon--<?php echo esc_attr($stat[0]); ?>" aria-hidden="true"></span><div><b><?php echo esc_html($stat[1]); ?></b><small><?php echo esc_html($stat[2]); ?></small></div></div><?php endforeach; ?>
    </section>

    <section class="mp-about-story mp-section" id="contact-about">
        <div class="mp-container mp-about-story__grid">
            <div class="mp-about-story__media">
                <?php if ( $about_video && ! empty( $about_video['url'] ) ) : ?><video class="mp-about-video" controls preload="metadata" <?php if ( ! empty($about_video['thumb']) ) echo 'poster="' . esc_url(wp_get_attachment_image_url($about_video['thumb'],'large')) . '"'; ?>><source src="<?php echo esc_url($about_video['url']); ?>" type="video/mp4"></video>
                <?php elseif ( $about_video_image ) : ?><img src="<?php echo esc_url($about_video_image); ?>" alt="مسیر آموزش زبان انگلیسی" loading="lazy"><?php else : ?><div class="mp-about-media-placeholder"><span>Better<br>English<br>Bigger<br>Dreams</span></div><?php endif; ?>
                <?php if ( ! $about_video ) : ?><div class="mp-about-play" aria-hidden="true">▶</div><?php endif; ?>
                <span class="mp-about-video-caption">Better<br>English<br>Bigger<br>Dreams</span>
            </div>
            <div class="mp-about-story__copy">
                <div class="mp-about-kicker">مسیر من <i></i></div>
                <h2>چطور وارد دنیای آموزش شدم؟</h2>
                <p>همیشه به زبان و ارتباط با آدم‌های مختلف علاقه داشتم. زمانی که متوجه شدم آموزش زبان می‌تواند زندگی خیلی از افراد را تغییر دهد، تصمیم گرفتم این مسیر را جدی دنبال کنم.</p>
                <p>بعد از سال‌ها تجربه‌ی یادگیری و تدریس، امروز با افتخار در کنار شما هستم تا بهترین تجربه‌ی یادگیری را رقم بزنیم.</p>
            </div>
        </div>
    </section>

    <section class="mp-about-reasons mp-section">
        <div class="mp-container">
            <div class="mp-about-section-head"><div class="mp-about-kicker">چرا من؟ <i></i></div><h2>آنچه یادگیری با من را متفاوت می‌کند</h2></div>
            <div class="mp-about-reasons-grid">
                <?php foreach ( $reasons as $reason ) : ?><article class="mp-about-reason"><span class="mp-about-reason__icon mp-about-reason__icon--<?php echo esc_attr($reason[0]); ?>" aria-hidden="true"></span><div><h3><?php echo esc_html($reason[1]); ?></h3><p><?php echo esc_html($reason[2]); ?></p></div></article><?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="mp-about-testimonial mp-container" aria-label="نظر زبان‌آموز">
        <div class="mp-about-quote">”</div>
        <div class="mp-about-testimonial__author">
            <?php if ( ! empty($review[4]) ) : ?><?php echo wp_get_attachment_image($review[4],array(56,56),false,array('class'=>'mp-about-avatar','alt'=>esc_attr($review[0]))); ?><?php else : ?><span class="mp-about-avatar mp-about-avatar--placeholder"><?php echo esc_html(mb_substr($review[0],0,1)); ?></span><?php endif; ?>
            <div><b><?php echo esc_html($review[0]); ?></b><small><?php echo esc_html($review[1]); ?></small><span><?php echo str_repeat('★',(int)$review[3]); ?></span></div>
        </div>
        <div class="mp-about-testimonial__text"><strong>متین پارتو فقط یک مدرس نیست، یک همراه واقعی است.</strong><p><?php echo esc_html($review[2]); ?></p></div>
    </section>
</main>
<?php get_footer(); ?>
