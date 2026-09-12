<?php
/** Footer widget areas for Matin Parto. */
defined( 'ABSPATH' ) || exit;

function matin_parto_register_footer_sidebars() {
    $sidebars = array(
        'footer-categories' => array(
            'name'        => 'فوتر — دسته‌بندی‌ها',
            'description' => 'فقط محتوای بخش دسته‌بندی‌های فوتر را مدیریت کنید.',
        ),
        'footer-quick-links' => array(
            'name'        => 'فوتر — دسترسی سریع',
            'description' => 'فقط محتوای بخش دسترسی سریع فوتر را مدیریت کنید.',
        ),
        'footer-about' => array(
            'name'        => 'فوتر — درباره من و شبکه‌های اجتماعی',
            'description' => 'متن درباره من و یک ابزارک شبکه‌های اجتماعی را از این بخش مدیریت کنید.',
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

/**
 * One widget for ALL social networks.
 * Each network is one row inside this single widget.
 */
class Matin_Parto_Social_Widget extends WP_Widget {
    private $max_socials = 8;

    public function __construct() {
        parent::__construct( 'matin_parto_social_widget', 'ماتین پرتو — شبکه‌های اجتماعی', array(
            'description' => 'همه شبکه‌های اجتماعی را داخل یک ابزارک اضافه کنید. فقط فیلدهای موردنیاز را پر کنید.',
        ) );
    }

    public function widget( $args, $instance ) {
        $items = isset( $instance['items'] ) && is_array( $instance['items'] ) ? $instance['items'] : array();
        $valid_items = array();

        foreach ( $items as $item ) {
            $label = isset( $item['label'] ) ? trim( $item['label'] ) : '';
            $url   = isset( $item['url'] ) ? trim( $item['url'] ) : '';
            $icon  = isset( $item['icon'] ) ? trim( $item['icon'] ) : '';
            if ( $url !== '' ) {
                $valid_items[] = array( 'label' => $label, 'url' => $url, 'icon' => $icon );
            }
        }

        if ( empty( $valid_items ) ) {
            return;
        }

        echo '<div class="mp-social-widget" aria-label="شبکه‌های اجتماعی">';
        echo '<div class="mp-social-widget__items">';

        foreach ( $valid_items as $item ) {
            echo '<a class="mp-social-widget__link" href="' . esc_url( $item['url'] ) . '" target="_blank" rel="noopener noreferrer" aria-label="' . esc_attr( $item['label'] ?: 'شبکه اجتماعی' ) . '">';
            if ( $item['icon'] !== '' && filter_var( $item['icon'], FILTER_VALIDATE_URL ) ) {
                echo '<img class="mp-social-widget__icon-image" src="' . esc_url( $item['icon'] ) . '" alt="" loading="lazy">';
            } elseif ( $item['icon'] !== '' ) {
                echo '<span class="mp-social-widget__icon-text" aria-hidden="true">' . esc_html( $item['icon'] ) . '</span>';
            } else {
                echo '<span class="mp-social-widget__icon-text" aria-hidden="true">●</span>';
            }
            echo '<span class="screen-reader-text">' . esc_html( $item['label'] ?: 'شبکه اجتماعی' ) . '</span>';
            echo '</a>';
        }

        echo '</div></div>';
    }

    public function form( $instance ) {
        $items = isset( $instance['items'] ) && is_array( $instance['items'] ) ? $instance['items'] : array();
        $items = array_values( $items );
        ?>
        <div class="mp-social-widget-form">
            <p><strong>همه شبکه‌ها در همین یک ابزارک</strong></p>
            <p class="description">برای هر شبکه نام، لینک و آیکون را وارد کنید. حداکثر <?php echo esc_html( $this->max_socials ); ?> شبکه قابل تنظیم است.</p>
            <?php for ( $i = 0; $i < $this->max_socials; $i++ ) :
                $item  = isset( $items[ $i ] ) && is_array( $items[ $i ] ) ? $items[ $i ] : array();
                $label = isset( $item['label'] ) ? $item['label'] : '';
                $url   = isset( $item['url'] ) ? $item['url'] : '';
                $icon  = isset( $item['icon'] ) ? $item['icon'] : '';
                ?>
                <div class="mp-social-row" style="border:1px solid #ddd;padding:10px;margin:8px 0;border-radius:6px">
                    <strong>شبکه <?php echo esc_html( $i + 1 ); ?></strong>
                    <p>
                        <label>نام شبکه</label>
                        <input class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'items' ) . '[' . $i . '][label]' ); ?>" type="text" value="<?php echo esc_attr( $label ); ?>" placeholder="مثلاً اینستاگرام">
                    </p>
                    <p>
                        <label>لینک شبکه</label>
                        <input class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'items' ) . '[' . $i . '][url]' ); ?>" type="url" value="<?php echo esc_attr( $url ); ?>" placeholder="https://..."></p>
                    <p>
                        <label>آیکون (URL یا ایموجی)</label>
                        <input class="widefat mp-social-icon-input" id="<?php echo esc_attr( $this->get_field_id( 'items_' . $i . '_icon' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'items' ) . '[' . $i . '][icon]' ); ?>" type="text" value="<?php echo esc_attr( $icon ); ?>" placeholder="URL آیکون یا ایموجی">
                        <button type="button" class="button mp-social-icon-upload" style="margin-top:6px">انتخاب آیکون از رسانه</button>
                    </p>
                </div>
            <?php endfor; ?>
        </div>
        <?php
    }

    public function update( $new_instance, $old_instance ) {
        $items = isset( $new_instance['items'] ) && is_array( $new_instance['items'] ) ? $new_instance['items'] : array();
        $clean = array();

        for ( $i = 0; $i < $this->max_socials; $i++ ) {
            $item = isset( $items[ $i ] ) && is_array( $items[ $i ] ) ? $items[ $i ] : array();
            $label = isset( $item['label'] ) ? sanitize_text_field( wp_unslash( $item['label'] ) ) : '';
            $url   = isset( $item['url'] ) ? esc_url_raw( wp_unslash( $item['url'] ) ) : '';
            $icon  = isset( $item['icon'] ) ? trim( wp_unslash( $item['icon'] ) ) : '';
            $icon  = filter_var( $icon, FILTER_VALIDATE_URL ) ? esc_url_raw( $icon ) : sanitize_text_field( $icon );

            if ( $label !== '' || $url !== '' || $icon !== '' ) {
                $clean[ $i ] = array( 'label' => $label, 'url' => $url, 'icon' => $icon );
            }
        }

        return array( 'items' => $clean );
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
