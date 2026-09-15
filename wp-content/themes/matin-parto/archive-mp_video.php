<?php
defined( 'ABSPATH' ) || exit;
get_header();
?>
<main class="mp-about-page" dir="rtl">
<section class="mp-section"><div class="mp-container">
<div class="mp-about-section-head"><span class="mp-about-kicker">ویدیوهای آموزشی <i></i></span><h1>ویدیوهای آموزشی ماتین پارتو</h1></div>
<div class="mp-about-reasons-grid">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); $url=get_post_meta(get_the_ID(),'_mp_video_url',true); $duration=get_post_meta(get_the_ID(),'_mp_video_duration',true); $level=get_post_meta(get_the_ID(),'_mp_video_level',true); ?>
<article class="mp-about-reason" style="padding:0;overflow:hidden">
<?php if(has_post_thumbnail()): ?><div style="height:190px;overflow:hidden"><?php the_post_thumbnail('large',array('style'=>'width:100%;height:100%;object-fit:cover;display:block;')); ?></div><?php endif; ?>
<div style="padding:22px"><h2 style="font-size:16px;margin:0 0 8px"><?php the_title(); ?></h2><?php if($level): ?><p style="margin-bottom:5px">سطح: <?php echo esc_html($level); ?></p><?php endif; ?><?php if($duration): ?><p>مدت: <?php echo esc_html($duration); ?></p><?php endif; ?><?php if($url): ?><a class="mp-button mp-button--primary" style="margin-top:10px" href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener noreferrer">مشاهده ویدیو</a><?php endif; ?></div>
</article>
<?php endwhile; else: ?><p>هنوز ویدیویی اضافه نشده است.</p><?php endif; ?>
</div>
</div></section>
</main>
<?php get_footer(); ?>
