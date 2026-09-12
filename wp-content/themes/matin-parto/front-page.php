<?php
/**
 * Front page — Matin Parto reference design.
 */
defined( 'ABSPATH' ) || exit;

$home = function_exists( 'matin_parto_home_defaults' ) ? matin_parto_home_defaults() : array();
$home = function_exists( 'matin_parto_home_settings' ) ? matin_parto_home_settings() : $home;
$categories = array(
    array( 'آمادگی آزمون', 'Exam Preparation', '۲۲ درس' ),
    array( 'لغات و اصطلاحات', 'Vocabulary', '۱۸ درس' ),
    array( 'تقویت مهارت شنیداری', 'Listening', '۲۰ درس' ),
    array( 'گرامر و ساختار', 'Grammar', '۲۴ درس' ),
    array( 'دوره مکالمه', 'Conversation', '۲۸ درس' ),
);
$videos = array(
    array( 'How much do you make?', 'سطح متوسط', '12:45' ),
    array( 'Oxygen Lives', 'سطح پیشرفته', '10:22' ),
    array( 'Diamonds - Rihanna', 'گرامر و لغات', '06:15' ),
);
$reviews = array(
    array( 'مریم احمدی', 'زبان‌آموز دوره پیشرفته', 'بهترین سرمایه‌گذاری که برای یادگیری زبان داشتم؛ تمرین‌ها استاد عالیه!', 5 ),
    array( 'علی رضایی', 'زبان‌آموز دوره متوسط', 'بعد از شرکت در دوره‌ها اعتماد به نفسم در مکالمه خیلی بیشتر شده.', 5 ),
    array( 'نیلوفر محمدی', 'زبان‌آموز دوره مکالمه', 'دوره‌های منسجم، دیدگاه زبان انگلیسی من را خیلی بهتر کرد.', 5 ),
);
get_header();
?>

<main class="mp-home">
    <section class="mp-hero mp-section">
        <div class="mp-container mp-hero__grid">
            <div class="mp-hero__copy">
                <p class="mp-kicker">آموزش زبان انگلیسی</p>
                <h1><?php echo esc_html( $home['hero_title'] ?? 'آموزش زبان انگلیسی' ); ?><strong><?php echo esc_html( $home['hero_subtitle'] ?? 'به صورت اصولی و قدم به قدم' ); ?></strong></h1>
                <p class="mp-hero__text"><?php echo esc_html( $home['hero_text'] ?? 'با یک سیستم ساده و کاربردی از پایه تا پیشرفته، با اعتماد به نفس انگلیسی صحبت کنید و در دنیای واقعی از آن استفاده کنید.' ); ?></p>
                <div class="mp-hero__buttons">
                    <a class="mp-button mp-button--primary" href="#courses"><?php echo esc_html( $home['hero_primary'] ?? 'شروع یادگیری' ); ?></a>
                    <a class="mp-button mp-button--outline" href="#about"><?php echo esc_html( $home['hero_secondary'] ?? 'درباره من' ); ?></a>
                </div>
                <div class="mp-students"><span class="mp-avatars"><i></i><i></i><i></i><i></i><i></i></span><b>+10K</b> زبان‌آموز موفق</div>
            </div>
            <div class="mp-hero__visual">
                <div class="mp-hero__arch"></div>
                <div class="mp-hero__portrait"><span>MATIN<br>PARTO</span></div>
                <div class="mp-hero__badge"><b>7+</b><small>سال سابقه<br>آموزش</small></div>
            </div>
        </div>
    </section>

    <section class="mp-benefits mp-container">
        <?php foreach ( array(
            array( '▱', 'دسترسی دائمی', 'یادگیری بدون محدودیت زمانی' ),
            array( '◇', 'پشتیبانی و همراهی', 'همراه شما در مسیر یادگیری' ),
            array( '⌂', 'سیستم آموزشی اصولی', 'مسیر یادگیری استاندارد و منظم' ),
            array( '▢', 'دوره‌های جامع و کاربردی', 'از سطح مبتدی تا پیشرفته' ),
        ) as $benefit ) : ?>
            <div class="mp-benefit"><span><?php echo esc_html( $benefit[0] ); ?></span><div><b><?php echo esc_html( $benefit[1] ); ?></b><small><?php echo esc_html( $benefit[2] ); ?></small></div></div>
        <?php endforeach; ?>
    </section>

    <section class="mp-video-section mp-section" id="videos">
        <div class="mp-container">
            <div class="mp-section-head"><a class="mp-more" href="#videos">مشاهده همه ویدئوها</a><h2>جدیدترین ویدئوهای آموزشی</h2></div>
            <div class="mp-video-grid">
                <article class="mp-video-feature"><div class="mp-video-thumb"><span class="mp-video-number">#18</span><div class="mp-play">▶</div><strong>How much do you make?</strong><small>سطح متوسط</small><em>◷ 12:45</em></div></article>
                <div class="mp-video-list">
                    <?php foreach ( $videos as $index => $video ) : ?>
                        <article class="mp-video-row"><div class="mp-video-mini"><span><?php echo esc_html( $video[2] ); ?></span></div><div><b><?php echo esc_html( $video[0] ); ?></b><small><?php echo esc_html( $video[1] ); ?></small></div><em>#<?php echo 18 - $index; ?></em></article>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <section class="mp-courses mp-section" id="courses">
        <div class="mp-container">
            <div class="mp-section-head"><h2>دسته‌بندی دوره‌ها</h2></div>
            <div class="mp-course-carousel">
                <?php foreach ( $categories as $category ) : ?>
                    <article class="mp-course-card"><div class="mp-course-image"><span>MATIN<br>PARTO</span></div><div class="mp-course-info"><h3><?php echo esc_html( $category[0] ); ?></h3><b><?php echo esc_html( $category[1] ); ?></b><small><?php echo esc_html( $category[2] ); ?></small></div></article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="mp-reviews mp-section">
        <div class="mp-container">
            <div class="mp-section-head"><a class="mp-more" href="#reviews">مشاهده همه نظرات</a><h2>نظرات زبان‌آموزان</h2></div>
            <div class="mp-review-grid" id="reviews">
                <?php foreach ( $reviews as $review ) : ?>
                    <article class="mp-review-card"><div class="mp-stars"><?php echo str_repeat( '★', (int) $review[3] ); ?></div><p><?php echo esc_html( $review[2] ); ?></p><div class="mp-review-author"><span></span><div><b><?php echo esc_html( $review[0] ); ?></b><small><?php echo esc_html( $review[1] ); ?></small></div></div></article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="mp-home-cta mp-container">
        <div class="mp-home-cta__person"><span>MATIN<br>PARTO</span></div>
        <div><h2>همین امروز شروع کنید!</h2><p>دسترسی به ده‌ها ویدئو و دوره آموزشی</p><a class="mp-button mp-button--light" href="#courses">شروع یادگیری رایگان</a></div>
        <div class="mp-home-cta__social"><b>در شبکه‌های اجتماعی همراه باشید</b><span>محتوای رایگان، نکات آموزشی و اخبار دوره‌ها</span><div>◎　➤　▶　◉</div></div>
    </section>
</main>

<?php get_footer(); ?>
