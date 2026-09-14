<?php
defined( 'ABSPATH' ) || exit;

/**
 * مدیریت نظرات زبان‌آموزان + تنظیمات شبکه‌های اجتماعی صفحه اصلی.
 */
function matin_parto_register_testimonials() {
    register_post_type( 'mp_testimonial', array(
        'labels' => array(
            'name'               => 'نظرات زبان‌آموزان',
            'singular_name'      => 'نظر زبان‌آموز',
            'add_new'            => 'افزودن نظر',
            'add_new_item'       => 'افزودن نظر زبان‌آموز',
            'edit_item'          => 'ویرایش نظر زبان‌آموز',
            'new_item'           => 'نظر جدید',
            'view_item'          => 'مشاهده نظر',
            'search_items'       => 'جستجوی نظرات',
            'not_found'          => 'نظری پیدا نشد',
            'menu_name'          => 'نظرات زبان‌آموزان',
        ),
        'public'              => false,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_position'       => 21,
        'menu_icon'           => 'dashicons-format-chat',
        'supports'            => array( 'title', 'editor', 'thumbnail' ),
        'show_in_rest'        => true,
        'has_archive'         => false,
        'capability_type'     => 'post',
        'map_meta_cap'        => true,
    ) );
}
add_action( 'init', 'matin_parto_register_testimonials' );

function matin_parto_testimonial_meta_box() {
    add_meta_box(
        'matin_parto_testimonial_details',
        'اطلاعات نظر زبان‌آموز',
        'matin_parto_testimonial_meta_box_html',
        'mp_testimonial',
        'side',
        'high'
    );
}
add_action( 'add_meta_boxes', 'matin_parto_testimonial_meta_box' );

function matin_parto_testimonial_meta_box_html( $post ) {
    wp_nonce_field( 'matin_parto_testimonial_details', 'matin_parto_testimonial_nonce' );
    $rating = get_post_meta( $post->ID, '_mp_testimonial_rating', true );
    $course = get_post_meta( $post->ID, '_mp_testimonial_course', true );
    $rating = $rating ? absint( $rating ) : 5;
    $rating = max( 1, min( 5, $rating ) );
    ?>
    <p>
        <label for="mp_testimonial_rating"><strong>امتیاز (ستاره)</strong></label>
        <select class="widefat" id="mp_testimonial_rating" name="mp_testimonial_rating">
            <?php for ( $i = 5; $i >= 1; $i-- ) : ?>
                <option value="<?php echo esc_attr( $i ); ?>" <?php selected( $rating, $i ); ?>><?php echo esc_html( $i . ' ستاره' ); ?></option>
            <?php endfor; ?>
        </select>
    </p>
    <p>
        <label for="mp_testimonial_course"><strong>نوع یادگیری / دوره</strong></label>
        <input class="widefat" type="text" id="mp_testimonial_course" name="mp_testimonial_course" value="<?php echo esc_attr( $course ); ?>" placeholder="مثلاً زبان‌آموز دوره مکالمه">
    </p>
    <p class="description">عکس زبان‌آموز را از بخش «تصویر شاخص» در ستون کناری همین صفحه انتخاب کنید. متن نظر را هم در ویرایشگر اصلی بنویسید.</p>
    <?php
}

function matin_parto_save_testimonial_meta( $post_id ) {
    if ( ! isset( $_POST['matin_parto_testimonial_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['matin_parto_testimonial_nonce'] ) ), 'matin_parto_testimonial_details' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }
    if ( 'mp_testimonial' !== get_post_type( $post_id ) ) {
        return;
    }

    $rating = isset( $_POST['mp_testimonial_rating'] ) ? absint( $_POST['mp_testimonial_rating'] ) : 5;
    $rating = max( 1, min( 5, $rating ) );
    $course = isset( $_POST['mp_testimonial_course'] ) ? sanitize_text_field( wp_unslash( $_POST['mp_testimonial_course'] ) ) : '';

    update_post_meta( $post_id, '_mp_testimonial_rating', $rating );
    update_post_meta( $post_id, '_mp_testimonial_course', $course );
}
add_action( 'save_post_mp_testimonial', 'matin_parto_save_testimonial_meta' );

function matin_parto_testimonial_admin_columns( $columns ) {
    return array(
        'cb'       => $columns['cb'],
        'title'    => 'نام زبان‌آموز',
        'course'   => 'نوع دوره / یادگیری',
        'rating'   => 'امتیاز',
        'thumbnail'=> 'عکس',
        'date'     => 'تاریخ',
    );
}
add_filter( 'manage_mp_testimonial_posts_columns', 'matin_parto_testimonial_admin_columns' );

function matin_parto_testimonial_admin_column_content( $column, $post_id ) {
    if ( 'course' === $column ) {
        echo esc_html( get_post_meta( $post_id, '_mp_testimonial_course', true ) );
    } elseif ( 'rating' === $column ) {
        $rating = max( 1, min( 5, absint( get_post_meta( $post_id, '_mp_testimonial_rating', true ) ?: 5 ) ) );
        echo esc_html( str_repeat( '★', $rating ) );
    } elseif ( 'thumbnail' === $column ) {
        if ( has_post_thumbnail( $post_id ) ) {
            echo get_the_post_thumbnail( $post_id, array( 48, 48 ), array( 'style' => 'width:48px;height:48px;object-fit:cover;border-radius:50%;' ) );
        } else {
            echo '—';
        }
    }
}
add_action( 'manage_mp_testimonial_posts_custom_column', 'matin_parto_testimonial_admin_column_content', 10, 2 );

function matin_parto_add_social_customizer( $wp_customize ) {
    $wp_customize->add_section( 'matin_parto_social_links', array(
        'title'       => 'شبکه‌های اجتماعی',
        'priority'    => 150,
        'description' => 'لینک واتساپ، تلگرام، اینستاگرام و یوتیوب که در بنر پایین صفحه اصلی نمایش داده می‌شوند.',
    ) );

    $socials = array(
        'whatsapp'  => 'واتساپ',
        'telegram'  => 'تلگرام',
        'instagram' => 'اینستاگرام',
        'youtube'   => 'یوتیوب',
    );

    foreach ( $socials as $key => $label ) {
        $setting = 'matin_parto_social_' . $key;
        $wp_customize->add_setting( $setting, array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh',
        ) );
        $wp_customize->add_control( $setting, array(
            'label'       => 'لینک ' . $label,
            'section'     => 'matin_parto_social_links',
            'type'        => 'url',
            'description' => 'آدرس کامل لینک ' . $label . ' را وارد کنید.',
        ) );
    }
}
add_action( 'customize_register', 'matin_parto_add_social_customizer', 20 );

function matin_parto_social_links_html( $class = '' ) {
    $socials = array(
        'whatsapp'  => 'واتساپ',
        'telegram'  => 'تلگرام',
        'instagram' => 'اینستاگرام',
        'youtube'   => 'یوتیوب',
    );

    echo '<div class="mp-home-social-links ' . esc_attr( $class ) . '" aria-label="شبکه‌های اجتماعی">';
    foreach ( $socials as $key => $label ) {
        $url = get_theme_mod( 'matin_parto_social_' . $key, '' );
        if ( ! $url ) {
            continue;
        }
        echo '<a class="mp-home-social-link mp-home-social-link--' . esc_attr( $key ) . '" href="' . esc_url( $url ) . '" target="_blank" rel="noopener noreferrer">' . esc_html( $label ) . '</a>';
    }
    echo '</div>';
}

function matin_parto_get_testimonials( $limit = 3 ) {
    return new WP_Query( array(
        'post_type'      => 'mp_testimonial',
        'post_status'    => 'publish',
        'posts_per_page' => absint( $limit ),
        'orderby'        => 'date',
        'order'          => 'DESC',
        'no_found_rows'  => true,
    ) );
}
