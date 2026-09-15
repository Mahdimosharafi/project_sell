<?php
defined( 'ABSPATH' ) || exit;

$home = function_exists( 'matin_parto_home_settings' ) ? matin_parto_home_settings() : array();
$about = function( $key, $default = '' ) { return get_theme_mod( 'matin_parto_about_' . $key, $default ); };
$hero_image = $about( 'hero_image', '' );
if ( ! $hero_image && ! empty( $home['hero_image'] ) ) $hero_image = $home['hero_image'];
$story_image = $about( 'story_image', '' );
if ( ! $story_image ) $story_image = $hero_image;
$video_image = $about( 'video_image', '' );
if ( ! $video_image ) $video_image = $story_image;
$video_url = $about( 'video_url', '' );

$stats = array();
for ( $i = 1; $i <= 4; $i++ ) {
    $stat_defaults = array( 1 => '+۱۰ سال', 2 => '+۵۰۰', 3 => '۹۸٪', 4 => '۳ زبان' );
    $label_defaults = array( 1 => 'تجربه تدریس حرفه‌ای', 2 => 'دانشجوی موفق', 3 => 'رضایت دانشجویان', 4 => 'تسلط به زبان‌های انگلیسی، آلمانی و فرانسه' );
    $stats[] = array( $stat_defaults[$i], $label_defaults[$i], $about( 'stat_' . $i, $stat_defaults[$i] ), $about( 'stat_' . $i . '_label', $label_defaults[$i] ) );
}
$reason_defaults = array(
    array( 'برنامه‌ریزی شخصی‌سازی‌شده', 'با توجه به سطح، هدف و سبک یادگیری شما برنامه اختصاصی طراحی می‌کنم.' ),
    array( 'پشتیبانی همیشگی', 'در تمام مراحل یادگیری همراه شما هستم و به سوالاتتان پاسخ می‌دهم.' ),
    array( 'تجربه و تخصص', 'سال‌ها تدریس و تجربه موفق در آزمون‌های بین‌المللی.' ),
    array( 'روش تدریس مدرن و تعاملی', 'استفاده از تکنیک‌های به‌روز و تمرین‌های عملی برای یادگیری عمیق‌تر.' ),
    array( 'نتایج ملموس', 'با تمرکز بر مکالمه، شنیداری و مهارت‌های کاربردی، پیشرفت شما را دنبال می‌کنم.' ),
    array( 'تعهد و علاقه واقعی', 'من به آموزش و موفقیت شما اهمیت می‌دهم و با تمام توان در کنارتان هستم.' ),
);
$reasons = array();
foreach ( $reason_defaults as $i => $default ) { $n = $i + 1; $reasons[] = array( $about( 'reason_' . $n . '_title', $default[0] ), $about( 'reason_' . $n . '_text', $default[1] ) ); }

$review_name = $about( 'testimonial_name', 'سارا محمدی' );
$review_course = $about( 'testimonial_course', 'دانشجوی دوره Intermediate' );
$review_text = $about( 'testimonial_text', 'متین پارتو فقط یک مدرس نیست، یک همراه واقعی در مسیر یادگیریه. با صبر، انگیزه و روش‌های عالی تدریسش باعث شد با اعتماد به نفس بیشتری صحبت کنم.' );
$review_rating = max( 1, min( 5, absint( $about( 'testimonial_rating', 5 ) ) ) );
$review_image = $about( 'testimonial_image', '' );

get_header();
?>
<link rel="stylesheet" id="matin-parto-about-page-css" href="<?php echo esc_url( get_theme_file_uri( 'assets/css/about-page.css' ) ); ?>?ver=20260915-3" media="all">
<main class="mp-about-page" dir="rtl">
    <section class="mp-about-hero">
        <div class="mp-container mp-about-hero__grid">
            <div class="mp-about-hero__visual">
                <div class="mp-about-hero__arch" aria-hidden="true"></div>
                <?php if ( $hero_image ) : ?><img src="<?php echo esc_url( $hero_image ); ?>" alt="<?php echo esc_attr( $about( 'hero_title', 'متین پارتو' ) ); ?>" loading="eager" fetchpriority="high">
                <?php else : ?><div class="mp-about-placeholder">تصویر مدرس</div><?php endif; ?>
                <span class="mp-about-handwrite" aria-hidden="true">About Me</span>
            </div>
            <div class="mp-about-hero__copy">
                <div class="mp-about-kicker">درباره من <i></i></div>
                <h1><?php echo esc_html( $about( 'hero_title', 'سلام، من متین پارتو هستم' ) ); ?></h1>
                <h2><?php echo esc_html( $about( 'hero_subtitle', 'مدرس زبان انگلیسی' ) ); ?></h2>
                <p><?php echo nl2br( esc_html( $about( 'hero_text', 'من به آموزش زبان انگلیسی به‌عنوان یک ابزار قدرتمند برای ساختن آینده‌ی بهتر باور دارم. در این مسیر، هدف من فقط آموزش گرامر زبان نیست، بلکه همراهی با شما برای رسیدن به اهداف و رویاهایتان است.' ) ) ); ?></p>
                <div class="mp-about-signature">Matin Parto</div>
                <a class="mp-button mp-button--primary" href="#contact-about"><?php echo esc_html( $about( 'hero_button', 'تماس با من' ) ); ?> <span>←</span></a>
            </div>
        </div>
    </section>

    <section class="mp-about-stats mp-container" aria-label="آمار">
        <?php foreach ( $stats as $index => $stat ) : ?><div class="mp-about-stat"><span class="mp-about-icon mp-about-icon--<?php echo esc_attr( array( 'book','users','star','cap' )[ $index ] ); ?>" aria-hidden="true"></span><div><b><?php echo esc_html( $stat[2] ); ?></b><small><?php echo esc_html( $stat[3] ); ?></small></div></div><?php endforeach; ?>
    </section>

    <section class="mp-about-story mp-section" id="contact-about">
        <div class="mp-container mp-about-story__grid">
            <div class="mp-about-story__media">
                <?php if ( $video_url ) : ?><video class="mp-about-video" controls preload="metadata" <?php if ( $video_image ) echo 'poster="' . esc_url( $video_image ) . '"'; ?>><source src="<?php echo esc_url( $video_url ); ?>" type="video/mp4"></video>
                <?php elseif ( $video_image ) : ?><img src="<?php echo esc_url( $video_image ); ?>" alt="مسیر آموزش زبان انگلیسی" loading="lazy"><?php else : ?><div class="mp-about-media-placeholder"><span><?php echo nl2br( esc_html( $about( 'video_caption', "Better\nEnglish\nBigger\nDreams" ) ) ); ?></span></div><?php endif; ?>
                <?php if ( ! $video_url ) : ?><div class="mp-about-play" aria-hidden="true">▶</div><?php endif; ?>
                <span class="mp-about-video-caption"><?php echo nl2br( esc_html( $about( 'video_caption', "Better\nEnglish\nBigger\nDreams" ) ) ); ?></span>
            </div>
            <div class="mp-about-story__copy">
                <div class="mp-about-kicker"><?php echo esc_html( $about( 'story_kicker', 'مسیر من' ) ); ?> <i></i></div>
                <h2><?php echo esc_html( $about( 'story_title', 'چطور وارد دنیای آموزش شدم؟' ) ); ?></h2>
                <p><?php echo nl2br( esc_html( $about( 'story_text_1', 'همیشه به زبان و ارتباط با آدم‌های مختلف علاقه داشتم. زمانی که متوجه شدم آموزش زبان می‌تواند زندگی خیلی از افراد را تغییر دهد، تصمیم گرفتم این مسیر را جدی دنبال کنم.' ) ) ); ?></p>
                <p><?php echo nl2br( esc_html( $about( 'story_text_2', 'بعد از سال‌ها تجربه‌ی یادگیری و تدریس، امروز با افتخار در کنار شما هستم تا بهترین تجربه‌ی یادگیری را رقم بزنیم.' ) ) ); ?></p>
            </div>
        </div>
    </section>

    <section class="mp-about-reasons mp-section">
        <div class="mp-container">
            <div class="mp-about-section-head"><div class="mp-about-kicker"><?php echo esc_html( $about( 'why_kicker', 'چرا من؟' ) ); ?> <i></i></div><h2><?php echo esc_html( $about( 'why_title', 'آنچه یادگیری با من را متفاوت می‌کند' ) ); ?></h2></div>
            <div class="mp-about-reasons-grid">
                <?php foreach ( $reasons as $i => $reason ) : ?><article class="mp-about-reason"><span class="mp-about-reason__icon mp-about-reason__icon--<?php echo esc_attr( array( 'target','users','star','chat','chart','heart' )[ $i ] ); ?>" aria-hidden="true"></span><div><h3><?php echo esc_html( $reason[0] ); ?></h3><p><?php echo esc_html( $reason[1] ); ?></p></div></article><?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="mp-about-testimonial mp-container" aria-label="نظر زبان‌آموز">
        <div class="mp-about-quote">”</div>
        <div class="mp-about-testimonial__author">
            <?php if ( $review_image ) : ?><img class="mp-about-avatar" src="<?php echo esc_url( $review_image ); ?>" alt="<?php echo esc_attr( $review_name ); ?>"><?php else : ?><span class="mp-about-avatar mp-about-avatar--placeholder"><?php echo esc_html( mb_substr( $review_name, 0, 1 ) ); ?></span><?php endif; ?>
            <div><b><?php echo esc_html( $review_name ); ?></b><small><?php echo esc_html( $review_course ); ?></small><span><?php echo str_repeat( '★', $review_rating ); ?></span></div>
        </div>
        <div class="mp-about-testimonial__text"><strong><?php echo esc_html( $about( 'testimonial_lead', 'متین پارتو فقط یک مدرس نیست، یک همراه واقعی است.' ) ); ?></strong><p><?php echo esc_html( $review_text ); ?></p></div>
    </section>
</main>
<?php get_footer(); ?>
