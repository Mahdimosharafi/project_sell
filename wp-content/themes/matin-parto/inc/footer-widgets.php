<?php
/** Footer widget areas for Matin Parto. */
defined( 'ABSPATH' ) || exit;

function matin_parto_register_footer_sidebars() {
    $sidebars = array(
        'footer-categories' => array(
            'name' => 'فوتر — دسته‌بندی‌ها',
            'description' => 'فقط محتوای بخش دسته‌بندی‌های فوتر را مدیریت کنید.',
        ),
        'footer-quick-links' => array(
            'name' => 'فوتر — دسترسی سریع',
            'description' => 'فقط محتوای بخش دسترسی سریع فوتر را مدیریت کنید.',
        ),
        'footer-about' => array(
            'name' => 'فوتر — درباره من',
            'description' => 'فقط محتوای بخش درباره من فوتر را مدیریت کنید. ابزارک شبکه اجتماعی را نیز می‌توانید اینجا اضافه کنید.',
        ),
    );

    foreach ( $sidebars as $id => $sidebar ) {
        register_sidebar( array(
            'name'          => $sidebar['name'],
            'id'            => $id,
            'description'   => $sidebar['description'],
            'before_widget' => '<div id="%1$s" class="widget %2$s mp-footer-widget">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ) );
    }
}
add_action( 'widgets_init', 'matin_parto_register_footer_sidebars' );

/** One social-network item: icon + link. Add this widget multiple times in the About footer area. */
class Matin_Parto_Social_Widget extends WP_Widget {
    public function __construct() {
        parent::__construct( 'matin_parto_social_widget', 'ماتین پرتو — یک شبکه اجتماعی', array(
            'description' => 'یک شبکه اجتماعی با یک آیکون و یک لینک. برای چند شبکه، این ابزارک را چند بار اضافه کنید.',
        ) );
    }

    public function widget( $args, $instance ) {
        $label = isset( $instance['label'] ) ? $instance['label'] : '';
        $url   = isset( $instance['url'] ) ? $instance['url'] : '';
        $icon  = isset( $instance['icon'] ) ? $instance['icon'] : '';
        if ( $url === '' ) return;

        echo '<div class="mp-social-widget__item">';
        echo '<a class="mp-social-widget__link" href="' . esc_url( $url ) . '" target="_blank" rel="noopener noreferrer" aria-label="' . esc_attr( $label ?: 'شبکه اجتماعی' ) . '">';
        if ( $icon !== '' && filter_var( $icon, FILTER_VALIDATE_URL ) ) {
            echo '<img class="mp-social-widget__icon-image" src="' . esc_url( $icon ) . '" alt="" loading="lazy">';
        } elseif ( $icon !== '' ) {
            echo '<span class="mp-social-widget__icon-text" aria-hidden="true">' . esc_html( $icon ) . '</span>';
        } else {
            echo '<span class="mp-social-widget__icon-text" aria-hidden="true">●</span>';
        }
        echo '</a>';
        echo '</div>';
    }

    public function form( $instance ) {
        $label = isset( $instance['label'] ) ? $instance['label'] : '';
        $url   = isset( $instance['url'] ) ? $instance['url'] : '';
        $icon  = isset( $instance['icon'] ) ? $instance['icon'] : '';
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'label' ) ); ?>">نام شبکه</label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'label' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'label' ) ); ?>" type="text" value="<?php echo esc_attr( $label ); ?>" placeholder="مثلاً اینستاگرام">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'url' ) ); ?>">لینک شبکه</label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'url' ) ); ?>" type="url" value="<?php echo esc_attr( $url ); ?>" placeholder="https://..."></p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'icon' ) ); ?>">آیکون</label>
            <input class="widefat mp-social-icon-input" id="<?php echo esc_attr( $this->get_field_id( 'icon' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'icon' ) ); ?>" type="text" value="<?php echo esc_attr( $icon ); ?>" placeholder="URL آیکون یا ایموجی">
            <button type="button" class="button mp-social-icon-upload" style="margin-top:6px">انتخاب آیکون از رسانه</button>
        </p>
        <?php
    }

    public function update( $new_instance, $old_instance ) {
        return array(
            'label' => isset( $new_instance['label'] ) ? sanitize_text_field( $new_instance['label'] ) : '',
            'url'   => isset( $new_instance['url'] ) ? esc_url_raw( $new_instance['url'] ) : '',
            'icon'  => isset( $new_instance['icon'] ) ? ( filter_var( trim( wp_unslash( $new_instance['icon'] ) ), FILTER_VALIDATE_URL ) ? esc_url_raw( trim( wp_unslash( $new_instance['icon'] ) ) ) : sanitize_text_field( $new_instance['icon'] ) ) : '',
        );
    }
}

add_action( 'widgets_init', function() {
    register_widget( 'Matin_Parto_Social_Widget' );
} );

function matin_parto_social_widget_media_picker() {
    if ( ! function_exists( 'get_current_screen' ) ) return;
    $screen = get_current_screen();
    if ( ! $screen || ! in_array( $screen->id, array( 'widgets', 'customize' ), true ) ) return;
    wp_enqueue_media();
    ?>
    <script>
    (function($){
        $(document).on('click', '.mp-social-icon-upload', function(e){
            e.preventDefault();
            var input = $(this).siblings('.mp-social-icon-input');
            var frame = wp.media({title:'انتخاب آیکون شبکه اجتماعی',button:{text:'استفاده از این آیکون'},multiple:false,library:{type:'image'}});
            frame.on('select', function(){ input.val(frame.state().get('selection').first().toJSON().url).trigger('change'); });
            frame.open();
        });
    })(jQuery);
    </script>
    <?php
}
add_action( 'admin_footer-widgets.php', 'matin_parto_social_widget_media_picker' );
add_action( 'customize_controls_print_footer_scripts', 'matin_parto_social_widget_media_picker' );
