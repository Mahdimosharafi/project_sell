<?php
/**
 * Plugin Name: Matin Parto Core
 * Description: Core settings and editable homepage content for the Matin Parto English Academy site.
 * Version: 0.1.1
 */
defined( 'ABSPATH' ) || exit;

function matin_parto_home_defaults() {
    return array(
        'hero_title'     => 'آموزش زبان انگلیسی',
        'hero_subtitle'  => 'به صورت اصولی و قدم به قدم',
        'hero_text'      => 'با یک سیستم ساده و کاربردی از پایه تا پیشرفته، با اعتماد به نفس انگلیسی صحبت کنید و در دنیای واقعی از آن استفاده کنید.',
        'hero_primary'   => 'شروع یادگیری',
        'hero_secondary' => 'درباره من',
        'hero_image'     => '',
        'cta_image'      => '',
    );
}

function matin_parto_home_settings() {
    $saved = get_option( 'matin_parto_home', array() );
    return wp_parse_args( is_array( $saved ) ? $saved : array(), matin_parto_home_defaults() );
}

function matin_parto_core_register_settings() {
    register_setting( 'matin_parto_home_group', 'matin_parto_home', array( 'sanitize_callback' => 'matin_parto_core_sanitize' ) );
}
add_action( 'admin_init', 'matin_parto_core_register_settings' );

function matin_parto_core_sanitize( $input ) {
    $defaults = matin_parto_home_defaults();
    $output = array();
    foreach ( $defaults as $key => $default ) {
        $output[ $key ] = isset( $input[ $key ] ) ? sanitize_text_field( $input[ $key ] ) : $default;
    }
    $output['hero_text']  = isset( $input['hero_text'] ) ? sanitize_textarea_field( $input['hero_text'] ) : $defaults['hero_text'];
    $output['hero_image'] = isset( $input['hero_image'] ) ? esc_url_raw( $input['hero_image'] ) : '';
    $output['cta_image']  = isset( $input['cta_image'] ) ? esc_url_raw( $input['cta_image'] ) : '';
    return $output;
}

function matin_parto_core_menu() {
    add_menu_page( 'تنظیمات متین پارتو', 'متین پارتو', 'manage_options', 'matin-parto-core', 'matin_parto_core_page', 'dashicons-welcome-learn-more', 3 );
}
add_action( 'admin_menu', 'matin_parto_core_menu' );

function matin_parto_core_page() {
    if ( ! current_user_can( 'manage_options' ) ) { return; }
    $home = matin_parto_home_settings();
    wp_enqueue_media();
    ?>
    <div class="wrap" dir="rtl">
        <h1>تنظیمات سایت متین پارتو</h1>
        <p>محتوای اصلی صفحه نخست را از این بخش مدیریت کنید. برای تصاویر، به‌جای کپی‌کردن آدرس فایل، مستقیماً از کتابخانه رسانه وردپرس انتخاب کنید.</p>
        <form method="post" action="options.php">
            <?php settings_fields( 'matin_parto_home_group' ); ?>
            <h2>Hero صفحه اصلی</h2>
            <table class="form-table" role="presentation">
                <?php
                $fields = array(
                    'hero_title' => array( 'عنوان اصلی', 'text' ),
                    'hero_subtitle' => array( 'عنوان رنگی', 'text' ),
                    'hero_text' => array( 'توضیحات', 'textarea' ),
                    'hero_primary' => array( 'متن دکمه اصلی', 'text' ),
                    'hero_secondary' => array( 'متن دکمه دوم', 'text' ),
                    'hero_image' => array( 'تصویر Hero', 'media' ),
                    'cta_image' => array( 'تصویر CTA', 'media' ),
                );
                foreach ( $fields as $key => $field ) : ?>
                    <tr><th scope="row"><label for="<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $field[0] ); ?></label></th><td>
                    <?php if ( 'textarea' === $field[1] ) : ?>
                        <textarea class="large-text" rows="4" id="<?php echo esc_attr( $key ); ?>" name="matin_parto_home[<?php echo esc_attr( $key ); ?>]"><?php echo esc_textarea( $home[ $key ] ); ?></textarea>
                    <?php elseif ( 'media' === $field[1] ) : ?>
                        <div class="mp-core-media-field"><input class="regular-text mp-core-media-url" type="url" id="<?php echo esc_attr( $key ); ?>" name="matin_parto_home[<?php echo esc_attr( $key ); ?>]" value="<?php echo esc_attr( $home[ $key ] ); ?>"><button type="button" class="button mp-core-media-button" data-target="<?php echo esc_attr( $key ); ?>">انتخاب از رسانه</button><button type="button" class="button-link-delete mp-core-media-clear" data-target="<?php echo esc_attr( $key ); ?>">پاک کردن</button></div>
                        <p class="description">تصویر ترجیحاً عمودی و با کیفیت مناسب باشد.</p>
                    <?php else : ?>
                        <input class="regular-text" type="<?php echo esc_attr( $field[1] ); ?>" id="<?php echo esc_attr( $key ); ?>" name="matin_parto_home[<?php echo esc_attr( $key ); ?>]" value="<?php echo esc_attr( $home[ $key ] ); ?>">
                    <?php endif; ?>
                    </td></tr>
                <?php endforeach; ?>
            </table>
            <?php submit_button( 'ذخیره تغییرات' ); ?>
        </form>
    </div>
    <script>
    jQuery(function($){
        $(document).on('click','.mp-core-media-button',function(e){
            e.preventDefault();
            var target=$(this).data('target'), frame=wp.media({title:'انتخاب تصویر',button:{text:'استفاده از تصویر'},multiple:false,library:{type:'image'}});
            frame.on('select',function(){var item=frame.state().get('selection').first().toJSON();$('#'+target).val(item.url);});
            frame.open();
        });
        $(document).on('click','.mp-core-media-clear',function(e){e.preventDefault();$('#'+$(this).data('target')).val('');});
    });
    </script>
    <?php
}

function matin_parto_core_activate() {
    if ( false === get_option( 'matin_parto_home', false ) ) {
        add_option( 'matin_parto_home', matin_parto_home_defaults() );
    }
}
register_activation_hook( __FILE__, 'matin_parto_core_activate' );
