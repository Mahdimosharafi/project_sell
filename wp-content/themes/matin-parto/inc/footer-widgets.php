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

/** One widget containing all social networks with accurate inline SVG icons. */
class Matin_Parto_Social_Widget extends WP_Widget {
    private $socials = array(
        'instagram' => array( 'label' => 'اینستاگرام' ),
        'telegram'  => array( 'label' => 'تلگرام' ),
        'youtube'   => array( 'label' => 'یوتیوب' ),
        'whatsapp'  => array( 'label' => 'واتساپ' ),
        'linkedin'  => array( 'label' => 'لینکدین' ),
        'twitter'   => array( 'label' => 'X / توییتر' ),
        'facebook'  => array( 'label' => 'فیسبوک' ),
        'github'    => array( 'label' => 'گیت‌هاب' ),
    );

    public function __construct() {
        parent::__construct( 'matin_parto_social_widget', 'ماتین پرتو — شبکه‌های اجتماعی', array(
            'description' => 'همه شبکه‌های اجتماعی را در یک ابزارک انتخاب و مدیریت کنید.',
        ) );
    }

    private function social_icon( $network ) {
        $icons = array(
            'instagram' => '<svg viewBox="0 0 24 24" aria-hidden="true"><rect x="3.5" y="3.5" width="17" height="17" rx="4.5" fill="none" stroke="currentColor" stroke-width="1.8"/><circle cx="12" cy="12" r="4" fill="none" stroke="currentColor" stroke-width="1.8"/><circle cx="17.5" cy="6.7" r="1.15" fill="currentColor"/></svg>',
            'telegram'  => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M21.2 4.2 18 19.1c-.24 1.05-.82 1.31-1.66.82l-4.58-3.38-2.21 2.13c-.25.25-.46.46-.94.46l.34-4.68 8.52-7.7c.37-.33-.08-.52-.57-.19L6.36 12.98 1.86 11.57c-.98-.31-1-1 .2-1.48L19.64 3.2c.82-.3 1.54.19 1.56 1Z" fill="currentColor"/></svg>',
            'youtube'   => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M21.1 7.1a2.7 2.7 0 0 0-1.9-1.9C17.5 4.7 12 4.7 12 4.7s-5.5 0-7.2.5a2.7 2.7 0 0 0-1.9 1.9C2.4 8.8 2.4 12 2.4 12s0 3.2.5 4.9a2.7 2.7 0 0 0 1.9 1.9c1.7.5 7.2.5 7.2.5s5.5 0 7.2-.5a2.7 2.7 0 0 0 1.9-1.9c.5-1.7.5-4.9.5-4.9s0-3.2-.5-4.9Z" fill="currentColor"/><path d="m10.2 15.3 5-3.3-5-3.3v6.6Z" fill="#fff"/></svg>',
            'whatsapp'  => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 3.2a8.7 8.7 0 0 0-7.55 13.03L3.2 20.8l4.7-1.23A8.8 8.8 0 1 0 12 3.2Z" fill="none" stroke="currentColor" stroke-width="1.7"/><path d="M8.5 8.3c.22-.48.46-.5.77-.5h.6c.2 0 .42.08.51.34l.72 1.75c.1.25.06.46-.1.65l-.58.68c-.13.15-.12.3-.04.45.27.51 1.03 1.66 2.28 2.4 1.1.65 1.44.62 1.7.4l.67-.62c.16-.15.33-.18.55-.08l1.7.8c.25.12.37.23.35.46-.03.42-.18 1.32-.84 1.56-.56.2-1.24.26-2.04.01-.7-.22-1.6-.6-2.75-1.42-1.62-1.14-2.66-2.52-3.14-3.33-.45-.75-1.02-2.06-.36-3.55Z" fill="currentColor"/></svg>',
            'linkedin'  => '<svg viewBox="0 0 24 24" aria-hidden="true"><rect x="4" y="4" width="16" height="16" rx="2.5" fill="currentColor"/><circle cx="8" cy="9" r="1.15" fill="#fff"/><path d="M7 11h2v6H7zM11 11h1.9v.82c.5-.7 1.18-1.07 2.1-1.07 1.75 0 2.99 1.03 2.99 3.34V17h-2v-2.67c0-1.04-.39-1.56-1.17-1.56-.9 0-1.82.56-1.82 2.02V17H11v-6Z" fill="#fff"/></svg>',
            'twitter'   => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 4h3.9l3.04 4.24L15.55 4H19l-5.55 6.35L19.5 20h-3.9l-3.53-4.93L7.6 20H4.15l5.85-6.98L5 4Zm2.13 1.55 8.85 12.9h1.45L8.58 5.55H7.13Z" fill="currentColor"/></svg>',
            'facebook'  => '<svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="9" fill="currentColor"/><path d="M13.35 18v-5.1h1.73l.26-2h-1.99V9.63c0-.58.16-.98 1-.98h1.07V6.86c-.19-.03-.85-.08-1.62-.08-1.61 0-2.71.98-2.71 2.77v1.35H9.37v2h1.72V18h2.26Z" fill="#fff"/></svg>',
            'github'    => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 3.2a8.8 8.8 0 0 0-2.78 17.15c.44.08.6-.19.6-.43v-1.51c-2.45.53-2.97-1.04-2.97-1.04-.4-1.02-.98-1.29-.98-1.29-.8-.55.06-.54.06-.54.88.06 1.34.9 1.34.9.79 1.34 2.07.95 2.57.73.08-.57.31-.95.56-1.17-1.96-.22-4.02-.98-4.02-4.36 0-.96.34-1.74.9-2.35-.09-.22-.39-1.11.09-2.32 0 0 .73-.23 2.42.9a8.4 8.4 0 0 1 4.4 0c1.69-1.13 2.42-.9 2.42-.9.48 1.21.18 2.1.09 2.32.56.61.9 1.39.9 2.35 0 3.39-2.07 4.14-4.04 4.36.32.28.6.82.6 1.66v2.46c0 .24.16.52.61.43A8.8 8.8 0 0 0 12 3.2Z" fill="currentColor"/></svg>',
        );

        return isset( $icons[ $network ] ) ? $icons[ $network ] : '';
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
            echo '<span class="mp-social-widget__icon" aria-hidden="true">' . $this->social_icon( $item['network'] ) . '</span>';
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
