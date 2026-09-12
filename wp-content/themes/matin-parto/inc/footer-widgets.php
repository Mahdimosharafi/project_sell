<?php
/**
 * Footer widget areas and the social-links widget for Matin Parto.
 */
defined( 'ABSPATH' ) || exit;

/**
 * Register editable footer widget areas.
 */
function matin_parto_register_footer_sidebars() {
    $sidebars = array(
        'footer-column-1' => array(
            'name'        => 'فوتر — ستون اول',
            'description' => 'محتوای قابل ویرایش ستون اول فوتر.',
        ),
        'footer-column-2' => array(
            'name'        => 'فوتر — ستون دوم',
            'description' => 'محتوای قابل ویرایش ستون دوم فوتر.',
        ),
        'footer-column-3' => array(
            'name'        => 'فوتر — ستون سوم',
            'description' => 'محتوای قابل ویرایش ستون سوم فوتر.',
        ),
        'footer-social' => array(
            'name'        => 'فوتر — شبکه‌های اجتماعی',
            'description' => 'شبکه‌های اجتماعی فوتر؛ برای هر شبکه نام، لینک و آیکون وارد کنید.',
        ),
    );

    foreach ( $sidebars as $id => $sidebar ) {
        register_sidebar(
            array(
                'name'          => $sidebar['name'],
                'id'            => $id,
                'description'   => $sidebar['description'],
                'before_widget' => '<div id="%1$s" class="widget %2$s mp-footer-widget">',
                'after_widget'  => '</div>',
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>',
            )
        );
    }
}
add_action( 'widgets_init', 'matin_parto_register_footer_sidebars' );

/**
 * A simple repeatable social-links widget with optional image icons.
 */
class Matin_Parto_Social_Widget extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'matin_parto_social_widget',
            'ماتین پرتو — شبکه‌های اجتماعی',
            array(
                'description' => 'افزودن چند شبکه اجتماعی با لینک و آیکون اختصاصی.',
            )
        );
    }

    public function widget( $args, $instance ) {
        $title = isset( $instance['title'] ) ? $instance['title'] : 'شبکه‌های اجتماعی';
        $items = isset( $instance['items'] ) && is_array( $instance['items'] ) ? $instance['items'] : array();

        echo $args['before_widget'];
        if ( $title !== '' ) {
            echo $args['before_title'] . esc_html( $title ) . $args['after_title'];
        }
        echo '<div class="mp-social-widget__items">';

        foreach ( $items as $item ) {
            $label = isset( $item['label'] ) ? trim( $item['label'] ) : '';
            $url   = isset( $item['url'] ) ? trim( $item['url'] ) : '';
            $icon  = isset( $item['icon'] ) ? trim( $item['icon'] ) : '';

            if ( $url === '' ) {
                continue;
            }

            echo '<a class="mp-social-widget__link" href="' . esc_url( $url ) . '" target="_blank" rel="noopener noreferrer"' . ( $label ? ' aria-label="' . esc_attr( $label ) . '"' : '' ) . '>';
            if ( $icon !== '' && filter_var( $icon, FILTER_VALIDATE_URL ) ) {
                echo '<img class="mp-social-widget__icon-image" src="' . esc_url( $icon ) . '" alt="" loading="lazy">';
            } elseif ( $icon !== '' ) {
                echo '<span class="mp-social-widget__icon-text" aria-hidden="true">' . esc_html( $icon ) . '</span>';
            } else {
                echo '<span class="mp-social-widget__icon-text" aria-hidden="true">●</span>';
            }
            echo '</a>';
        }

        echo '</div>';
        echo $args['after_widget'];
    }

    public function form( $instance ) {
        $title = isset( $instance['title'] ) ? $instance['title'] : 'شبکه‌های اجتماعی';
        $items = isset( $instance['items'] ) && is_array( $instance['items'] ) ? $instance['items'] : array();
        $items = array_values( $items );

        for ( $i = count( $items ); $i < 6; $i++ ) {
            $items[] = array( 'label' => '', 'url' => '', 'icon' => '' );
        }
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">عنوان</label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p style="margin-bottom:8px"><strong>شبکه‌ها</strong><br><small>لینک کامل و آیکون هر شبکه را وارد کنید. آیکون می‌تواند تصویر انتخاب‌شده از رسانه یا یک کاراکتر/ایموجی باشد.</small></p>
        <?php
        foreach ( $items as $index => $item ) :
            $label = isset( $item['label'] ) ? $item['label'] : '';
            $url   = isset( $item['url'] ) ? $item['url'] : '';
            $icon  = isset( $item['icon'] ) ? $item['icon'] : '';
            $base  = $this->get_field_name( 'items' ) . '[' . $index . ']';
            ?>
            <div class="mp-social-widget-admin" style="border:1px solid #ddd;padding:9px;margin:8px 0;border-radius:6px;background:#fafafa">
                <p style="margin:0 0 7px"><strong>شبکه <?php echo esc_html( $index + 1 ); ?></strong></p>
                <p style="margin:0 0 7px">
                    <label>نام شبکه</label>
                    <input class="widefat" type="text" name="<?php echo esc_attr( $base . '[label]' ); ?>" value="<?php echo esc_attr( $label ); ?>" placeholder="مثلاً اینستاگرام">
                </p>
                <p style="margin:0 0 7px">
                    <label>لینک</label>
                    <input class="widefat" type="url" name="<?php echo esc_attr( $base . '[url]' ); ?>" value="<?php echo esc_attr( $url ); ?>" placeholder="https://..."></p>
                <p style="margin:0">
                    <label>آیکون</label>
                    <input class="widefat mp-social-icon-input" type="text" name="<?php echo esc_attr( $base . '[icon]' ); ?>" value="<?php echo esc_attr( $icon ); ?>" placeholder="URL تصویر یا ایموجی/کاراکتر">
                    <button type="button" class="button mp-social-icon-upload" style="margin-top:5px">انتخاب آیکون از رسانه</button>
                </p>
            </div>
            <?php
        endforeach;
    }

    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = isset( $new_instance['title'] ) ? sanitize_text_field( $new_instance['title'] ) : '';
        $instance['items'] = array();

        if ( ! empty( $new_instance['items'] ) && is_array( $new_instance['items'] ) ) {
            foreach ( $new_instance['items'] as $item ) {
                $label = isset( $item['label'] ) ? sanitize_text_field( $item['label'] ) : '';
                $url   = isset( $item['url'] ) ? esc_url_raw( $item['url'] ) : '';
                $icon  = isset( $item['icon'] ) ? trim( wp_unslash( $item['icon'] ) ) : '';
                $icon  = filter_var( $icon, FILTER_VALIDATE_URL ) ? esc_url_raw( $icon ) : sanitize_text_field( $icon );

                if ( $label === '' && $url === '' && $icon === '' ) {
                    continue;
                }

                $instance['items'][] = array(
                    'label' => $label,
                    'url'   => $url,
                    'icon'  => $icon,
                );
            }
        }

        return $instance;
    }
}

function matin_parto_register_social_widget() {
    register_widget( 'Matin_Parto_Social_Widget' );
}
add_action( 'widgets_init', 'matin_parto_register_social_widget' );

/**
 * Media-library picker for social widget icon fields.
 */
function matin_parto_social_widget_media_picker() {
    if ( ! function_exists( 'get_current_screen' ) ) {
        return;
    }
    $screen = get_current_screen();
    if ( ! $screen || ! in_array( $screen->id, array( 'widgets', 'customize' ), true ) ) {
        return;
    }
    wp_enqueue_media();
    ?>
    <script>
    (function($){
        $(document).on('click', '.mp-social-icon-upload', function(e){
            e.preventDefault();
            var button = $(this), input = button.siblings('.mp-social-icon-input');
            var frame = wp.media({
                title: 'انتخاب آیکون شبکه اجتماعی',
                button: { text: 'استفاده از این آیکون' },
                multiple: false,
                library: { type: 'image' }
            });
            frame.on('select', function(){
                var attachment = frame.state().get('selection').first().toJSON();
                input.val(attachment.url).trigger('change');
            });
            frame.open();
        });
    })(jQuery);
    </script>
    <?php
}
add_action( 'admin_footer-widgets.php', 'matin_parto_social_widget_media_picker' );
add_action( 'customize_controls_print_footer_scripts', 'matin_parto_social_widget_media_picker' );
