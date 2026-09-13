<?php
defined( 'ABSPATH' ) || exit;

$home = function_exists( 'matin_parto_home_settings' ) ? matin_parto_home_settings() : array();
$hero_image = ! empty( $home['hero_image'] ) ? $home['hero_image'] : '';
$cta_image  = ! empty( $home['cta_image'] ) ? $home['cta_image'] : '';
$categories = array(
    array( 'آمادگی آزمون', 'Exam Preparation', '۲۲ درس' ),
    array( 'لغات و اصطلاحات', 'Vocabulary', '۱۸ درس' ),
    array( 'تقویت مهارت شنیداری', 'Listening', '۲۰ درس' ),
    array( 'گرامر و ساختار', 'Grammar', '۲۴ درس' ),
    array( 'دوره مکالمه', 'Conversation', '۲۸ درس' ),
);
$videos = array(
    array( 'How much do you make?', 'سطح متوسط', '12:45', '#18' ),
    array( 'Oxygen Lives', 'سطح پیشرفته', '10:22', '#17' ),
    array( 'Diamonds - Rihanna', 'گرامر و لغات', '06:15', '#16' ),
);
$reviews = array(
    array( 'مریم احمدی', 'زبان‌آموز دوره پیشرفته', 'بهترین سرمایه‌گذاری که برای یادگیری زبان داشتم؛ محتوای آموزشی استاد عالیه!', 5 ),
    array( 'علی رضایی', 'زبان‌آموز دوره متوسط', 'بعد از شرکت در دوره‌ها اعتماد به نفسم در مکالمه خیلی بیشتر شده.', 5 ),
    array( 'نیلوفر محمدی', 'زبان‌آموز دوره مکالمه', 'دوره‌های منسجم، دیدگاه زبان انگلیسی من را خیلی بهتر کرد.', 5 ),
);
$benefits = array(
    array( 'book', 'دوره‌های جامع و کاربردی', 'از سطح مبتدی تا پیشرفته' ),
    array( 'cap', 'سیستم آموزشی اصولی', 'مسیر یادگیری استاندارد و منظم' ),
    array( 'headset', 'پشتیبانی و همراهی', 'همراه شما در مسیر یادگیری' ),
    array( 'lock', 'دسترسی دائمی', 'یادگیری بدون محدودیت زمانی' ),
);
$socials = array(
    'instagram' => ! empty( $home['social_instagram'] ) ? $home['social_instagram'] : '',
    'telegram'  => ! empty( $home['social_telegram'] ) ? $home['social_telegram'] : '',
    'youtube'   => ! empty( $home['social_youtube'] ) ? $home['social_youtube'] : '',
    'facebook'  => ! empty( $home['social_facebook'] ) ? $home['social_facebook'] : '',
);
get_header();
?>
<main class="mp-home">
    <section class="mp-hero" id="about">
        <div class="mp-container mp-hero__grid">
            <div class="mp-hero__visual" aria-label="معرفی ماتین پرتو و سابقه آموزش">
                <div class="mp-hero__arch" aria-hidden="true"></div>
                <?php if ( $hero_image ) : ?><img class="mp-hero__image" src="<?php echo esc_url( $hero_image ); ?>" alt="ماتین پرتو - آموزش زبان انگلیسی" loading="eager" fetchpriority="high"><?php else : ?><div class="mp-hero__portrait" aria-hidden="true"><span>ماتین<br>پرتو</span></div><?php endif; ?>
                <div class="mp-hero__badge"><b>+۷</b><small>سال سابقه<br>آموزش</small></div>
            </div>
            <div class="mp-hero__copy">
                <span class="mp-kicker">آموزش زبان انگلیسی</span>
                <h1><?php echo esc_html( $home['hero_title'] ?? 'آموزش زبان انگلیسی' ); ?></h1>
                <h2><?php echo esc_html( $home['hero_subtitle'] ?? 'به صورت اصولی و قدم به قدم' ); ?></h2>
                <p><?php echo esc_html( $home['hero_text'] ?? 'با یک سیستم ساده و کاربردی از پایه تا پیشرفته.' ); ?></p>
                <p class="mp-hero__subtext">با اعتماد به نفس انگلیسی صحبت کنید و در دنیای واقعی از آن استفاده کنید.</p>
                <div class="mp-hero__buttons"><a class="mp-button mp-button--primary" href="#courses"><?php echo esc_html( $home['hero_primary'] ?? 'شروع یادگیری' ); ?></a><a class="mp-button mp-button--outline" href="#about">درباره من</a></div>
                <div class="mp-students" aria-label="بیش از ده هزار زبان‌آموز"><span class="mp-avatars" aria-hidden="true"><i></i><i></i><i></i><i></i><i></i></span><strong>+۱۰K</strong><span>زبان‌آموز موفق</span></div>
            </div>
        </div>
    </section>

    <section class="mp-benefits mp-container" aria-label="مزیت‌های آموزش">
        <?php foreach ( $benefits as $benefit ) : ?>
            <div class="mp-benefit">
                <span class="mp-benefit__icon mp-icon--<?php echo esc_attr( $benefit[0] ); ?>" aria-hidden="true">
                    <?php if ( 'cap' === $benefit[0] ) : ?>
                        <svg viewBox="0 0 32 32" focusable="false"><path d="M3 10.5 16 4l13 6.5L16 17 3 10.5Z"/><path d="M8 14v5.5c4.8 3.1 11.2 3.1 16 0V14"/><path d="M29 11v8"/></svg>
                    <?php endif; ?>
                </span>
                <div><b><?php echo esc_html( $benefit[1] ); ?></b><small><?php echo esc_html( $benefit[2] ); ?></small></div>
            </div>
        <?php endforeach; ?>
    </section>

    <section class="mp-video-section mp-section" id="videos"><div class="mp-container"><div class="mp-section-head"><a class="mp-more" href="#videos">مشاهده همه ویدئوها</a><h2>جدیدترین ویدئوهای آموزشی</h2></div><div class="mp-video-grid">
        <article class="mp-video-feature"><div class="mp-video-thumb <?php echo $hero_image ? 'has-image' : ''; ?>" <?php echo $hero_image ? 'style="background-image:url(' . esc_url( $hero_image ) . ')"' : ''; ?>><span class="mp-video-number">#18</span><button class="mp-play" type="button" aria-label="پخش ویدئو">▶</button><strong>How much do you make?</strong><small>سطح متوسط</small><em>◷ 12:45</em></div></article>
        <div class="mp-video-list"><?php foreach ( $videos as $video ) : ?><article class="mp-video-row"><div class="mp-video-mini <?php echo $hero_image ? 'has-image' : ''; ?>" <?php echo $hero_image ? 'style="background-image:url(' . esc_url( $hero_image ) . ')"' : ''; ?>><span><?php echo esc_html( $video[2] ); ?></span></div><div><b><?php echo esc_html( $video[0] ); ?></b><small><?php echo esc_html( $video[1] ); ?></small></div><em><?php echo esc_html( $video[3] ); ?></em></article><?php endforeach; ?></div>
    </div></div></section>

    <section class="mp-courses mp-section" id="courses"><div class="mp-container"><div class="mp-section-head"><a class="mp-circle-arrow" href="#courses" aria-label="حرکت بین دوره‌ها">‹</a><h2>دسته‌بندی دوره‌ها</h2></div><div class="mp-course-carousel">
        <?php foreach ( $categories as $category ) : ?><article class="mp-course-card"><div class="mp-course-image <?php echo $hero_image ? 'has-image' : ''; ?>" <?php echo $hero_image ? 'style="background-image:url(' . esc_url( $hero_image ) . ')"' : ''; ?>><span><?php echo $hero_image ? '' : 'ماتین پرتو'; ?></span></div><div class="mp-course-info"><h3><?php echo esc_html( $category[0] ); ?></h3><b><?php echo esc_html( $category[1] ); ?></b><small><?php echo esc_html( $category[2] ); ?></small></div></article><?php endforeach; ?>
    </div></div></section>

    <section class="mp-reviews mp-section" id="reviews"><div class="mp-container"><div class="mp-section-head"><h2>نظرات زبان‌آموزان</h2><a class="mp-more" href="#reviews">مشاهده همه نظرات</a></div><div class="mp-review-grid">
        <?php foreach ( $reviews as $review ) : ?><article class="mp-review-card"><div class="mp-stars" aria-label="۵ ستاره"><?php echo str_repeat( '★', (int) $review[3] ); ?></div><p><?php echo esc_html( $review[2] ); ?></p><div class="mp-review-author"><span></span><div><b><?php echo esc_html( $review[0] ); ?></b><small><?php echo esc_html( $review[1] ); ?></small></div></div></article><?php endforeach; ?>
    </div></div></section>

    <section class="mp-home-cta mp-container">
        <div class="mp-home-cta__social">
            <b>در شبکه‌های اجتماعی همراه باشید</b>
            <span>محتوای رایگان، نکات آموزشی و اخبار دوره‌ها</span>
            <?php if ( array_filter( $socials ) ) : ?>
                <div class="mp-social-icons" aria-label="شبکه‌های اجتماعی">
                    <?php foreach ( $socials as $network => $url ) : if ( ! $url ) { continue; } ?>
                        <a href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr( ucfirst( $network ) ); ?>" class="mp-social-icon mp-social-icon--<?php echo esc_attr( $network ); ?>"><?php echo function_exists( 'matin_parto_social_icon' ) ? matin_parto_social_icon( $network ) : ''; ?></a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="mp-home-cta__person <?php echo $cta_image ? 'has-image' : ''; ?>" aria-hidden="true">
            <?php if ( $cta_image ) : ?><img src="<?php echo esc_url( $cta_image ); ?>" alt="" loading="lazy"><?php endif; ?>
        </div>

        <div class="mp-home-cta__copy">
            <h2>همین امروز شروع کنید!</h2>
            <p>دسترسی به ده‌ها ویدئو و دوره آموزشی</p>
            <a class="mp-button mp-button--light" href="#courses">شروع یادگیری رایگان</a>
        </div>
    </section>
</main>
<?php get_footer(); ?>
