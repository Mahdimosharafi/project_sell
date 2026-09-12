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

/** One widget containing all social networks with built-in icon choices. */
class Matin_Parto_Social_Widget extends WP_Widget {
    private $socials = array(
        'instagram' => array( 'label' => 'اینستاگرام', 'icon' => '◎' ),
        'telegram'  => array( 'label' => 'تلگرام', 'icon' => '✈' ),
        'youtube'   => array( 'label' => 'یوتیوب', 'icon' => '▶' ),
        'whatsapp'  => array( 'label' => 'واتساپ', 'icon' => '◔' ),
        'linkedin'  => array( 'label' => 'لینکدین', 'icon' => 'in' ),
        'twitter'   => array( 'label' => 'X / توییتر', 'icon' => '𝕏' ),
        'facebook'  => array( 'label' => 'فیسبوک', 'icon' => 'f' ),
        'github'    => array( 'label' => 'گیت‌هاب', 'icon' => '⌘' ),
    );

    public function __construct() {
        parent::__construct( 'matin_parto_social_widget', 'ماتین پرتو — شبکه‌های اجتماعی', array(
            'description' => 'همه شبکه‌های اجتماعی را در یک ابزارک انتخاب و مدیریت کنید.',
        ) );
    }

    public function widget( $args, $instance ) {
        $items = isset( $instance['items'] ) && is_array( $instance['items'] ) ? $instance['items'] : array();
        $valid_items = array();

        foreach ( $items as $item ) {
            $key = isset( $item['network'] ) ? sanitize_key( $item['network'] ) : '';
            $url = isset( $item['url'] ) ? trim( $item['url'] ) : '';
            if ( $url !== '' && isset( $this->socials[ $key ] ) ) {
                $valid_items[] = array( 'network' => $key, 'url' => $url );
            }
        }

        if ( empty( $valid_items ) ) return;

        echo '<div class="mp-social-widget" aria-label="شبکه‌های اجتماعی"><div class="mp-social-widget__items">';
        foreach ( $valid_items as $item ) {
            $social = $this->socials[ $item['network'] ];
            echo '<a class="mp-social-widget__link mp-social-widget__link--' . esc_attr( $item['network'] ) . '" href="' . esc_url( $item['url'] ) . '" target="_blank" rel="noopener noreferrer" aria-label="' . esc_attr( $social['label'] ) . '">';
            echo '<span class="mp-social-widget__icon-text" aria-hidden="true">' . esc_html( $social['icon'] ) . '</span>';
            echo '<span class="screen-reader-text">' . esc_html( $social['label'] ) . '</span></a>';
        }
        echo '</div></div>';
    }

    public function form( $instance ) {
        $items = isset( $instance['items'] ) && is_array( $instance['items'] ) ? array_values( $instance['items'] ) : array();
        $max = 8;
        ?>
        <div class="mp-social-widget-form">
            <p><strong>شبکه‌های اجتماعی</strong></p>
            <p class="description">برای هر ردیف، شبکه را از لیست انتخاب کنید و فقط لینک آن را وارد کنید. آیکون به‌صورت خودکار قرار می‌گیرد.</p>
            <?php for ( $i = 0; $i < $max; $i++ ) :
                $item = isset( $items[ $i ] ) && is_array( $items[ $i ] ) ? $items[ $i ] : array();
                $network = isset( $item['network'] ) ? $item['network'] : '';
                $url = isset( $item['url'] ) ? $item['url'] : '';
                ?>
                <div class="mp-social-row" style="border:1px solid #ddd;padding:10px;margin:8px 0;border-radius:6px">
                    <strong>شبکه <?php echo esc_html( $i + 1 ); ?></strong>
                    <p>
                        <label>انتخاب شبکه</label>
                        <select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'items' ) . '[' . $i . '][network]' ); ?>">
                            <option value="">— انتخاب کنید —</option>
                            <?php foreach ( $this->socials as $key => $social ) : ?>
                                <option value="<?php echo esc_attr( $key ); ?>" <?php selected( $network, $key ); ?>><?php echo esc_html( $social['label'] ); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </p>
                    <p>
                        <label>لینک شبکه</label>
                        <input class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'items' ) . '[' . $i . '][url]' ); ?>" type="url" value="<?php echo esc_attr( $url ); ?>" placeholder="https://...">
                    </p>
                </div>
            <?php endfor; ?>
        </div>
        <?php
    }

    public function update( $new_instance, $old_instance ) {
        $items = isset( $new_instance['items'] ) && is_array( $new_instance['items'] ) ? $new_instance['items'] : array();
        $clean = array();
        for ( $i = 0; $i < 8; $i++ ) {
            $item = isset( $items[ $i ] ) && is_array( $items[ $i ] ) ? $items[ $i ] : array();
            $network = isset( $item['network'] ) ? sanitize_key( wp_unslash( $item['network'] ) ) : '';
            $url = isset( $item['url'] ) ? esc_url_raw( wp_unslash( $item['url'] ) ) : '';
            if ( $url !== '' && isset( $this->socials[ $network ] ) ) {
                $clean[] = array( 'network' => $network, 'url' => $url );
            }
        }
        return array( 'items' => $clean );
    }
}

add_action( 'widgets_init', function() {
    register_widget( 'Matin_Parto_Social_Widget' );
} );
