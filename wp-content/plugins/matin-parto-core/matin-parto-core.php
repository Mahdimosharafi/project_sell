<?php
/**
 * Plugin Name: Matin Parto Core
 * Description: Core settings and editable homepage content for the Matin Parto English Academy site.
 * Version: 0.1.3
 */
defined( 'ABSPATH' ) || exit;

function matin_parto_home_defaults() {
    return array(
        'hero_title'         => 'آموزش زبان انگلیسی',
        'hero_subtitle'      => 'به صورت اصولی و قدم به قدم',
        'hero_text'          => 'با یک سیستم ساده و کاربردی از پایه تا پیشرفته، با اعتماد به نفس انگلیسی صحبت کنید و در دنیای واقعی از آن استفاده کنید.',
        'hero_primary'       => 'شروع یادگیری',
        'hero_secondary'     => 'درباره من',
        'hero_image'         => '',
        'cta_image'          => '',
        'footer_hover_color' => '#8f3048',
        'social_instagram'   => '',
        'social_telegram'    => '',
        'social_youtube'     => '',
        'social_facebook'    => '',
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
    $output['hero_text'] = isset( $input['hero_text'] ) ? sanitize_textarea_field( $input['hero_text'] ) : $defaults['hero_text'];
    $output['hero_image'] = isset( $input['hero_image'] ) ? esc_url_raw( $input['hero_image'] ) : '';
    $output['cta_image'] = isset( $input['cta_image'] ) ? esc_url_raw( $input['cta_image'] ) : '';
    $output['footer_hover_color'] = isset( $input['footer_hover_color'] ) ? sanitize_hex_color( $input['footer_hover_color'] ) : $defaults['footer_hover_color'];
    if ( ! $output['footer_hover_color'] ) {
        $output['footer_hover_color'] = $defaults['footer_hover_color'];
    }
    foreach ( array( 'social_instagram', 'social_telegram', 'social_youtube', 'social_facebook' ) as $social_key ) {
        $output[ $social_key ] = isset( $input[ $social_key ] ) ? esc_url_raw( $input[ $social_key ] ) : '';
    }
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
        <p>محتوای اصلی صفحه نخست را از این بخش مدیریت کنید. برای تصاویر، مستقیماً از کتابخانه رسانه وردپرس انتخاب کنید.</p>
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
                );
                foreach ( $fields as $key => $field ) : ?>
                    <tr><th scope="row"><label for="<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $field[0] ); ?></label></th><td>
                    <?php if ( 'textarea' === $field[1] ) : ?>
                        <textarea class="large-text" rows="4" id="<?php echo esc_attr( $key ); ?>" name="matin_parto_home[<?php echo esc_attr( $key ); ?>]"><?php echo esc_textarea( $home[ $key ] ); ?></textarea>
                    <?php elseif ( 'media' === $field[1] ) : ?>
                        <div class="mp-core-media-field"><input class="regular-text mp-core-media-url" type="url" id="<?php echo esc_attr( $key ); ?>" name="matin_parto_home[<?php echo esc_attr( $key ); ?>]" value="<?php echo esc_attr( $home[ $key ] ); ?>"><button type="button" class="button mp-core-media-button" data-target="<?php echo esc_attr( $key ); ?>">انتخاب از رسانه</button><button type="button" class="button-link-delete mp-core-media-clear" data-target="<?php echo esc_attr( $key ); ?>">پاک کردن</button></div>
                        <p class="description">برای Hero یک تصویر مناسب همان بخش انتخاب کنید.</p>
                    <?php else : ?>
                        <input class="regular-text" type="<?php echo esc_attr( $field[1] ); ?>" id="<?php echo esc_attr( $key ); ?>" name="matin_parto_home[<?php echo esc_attr( $key ); ?>]" value="<?php echo esc_attr( $home[ $key ] ); ?>">
                    <?php endif; ?>
                    </td></tr>
                <?php endforeach; ?>
            </table>

            <h2>بنر «همین امروز شروع کنید»</h2>
            <table class="form-table" role="presentation">
                <tr>
                    <th scope="row"><label for="cta_image">تصویر خانم این بخش</label></th>
                    <td>
                        <div class="mp-core-media-field"><input class="regular-text mp-core-media-url" type="url" id="cta_image" name="matin_parto_home[cta_image]" value="<?php echo esc_attr( $home['cta_image'] ); ?>"><button type="button" class="button mp-core-media-button" data-target="cta_image">انتخاب از رسانه</button><button type="button" class="button-link-delete mp-core-media-clear" data-target="cta_image">پاک کردن</button></div>
                        <p class="description">این تصویر کاملاً مستقل از تصویر Hero است و فقط در همین بنر نمایش داده می‌شود. برای نتیجه مشابه طرح فعلی، تصویر پرتره با پس‌زمینه شفاف یا ساده و نسبت عمودی مناسب انتخاب کنید؛ نمایش نهایی در سایت حدود ۲۵۰×۱۸۰ پیکسل است و تصویر متناسب با قاب برش می‌خورد.</p>
                    </td>
                </tr>
            </table>

            <h2>شبکه‌های اجتماعی</h2>
            <p>لینک‌های زیر یک منبع مشترک برای فوتر و بنر «همین امروز شروع کنید» هستند؛ آیکون‌ها نیز در هر دو بخش یکسان نمایش داده می‌شوند.</p>
            <table class="form-table" role="presentation">
                <?php
                $socials = array(
                    'social_instagram' => 'لینک اینستاگرام',
                    'social_telegram'  => 'لینک تلگرام',
                    'social_youtube'   => 'لینک یوتیوب',
                    'social_facebook'  => 'لینک فیسبوک',
                );
                foreach ( $socials as $key => $label ) : ?>
                    <tr><th scope="row"><label for="<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $label ); ?></label></th><td><input class="regular-text" type="url" id="<?php echo esc_attr( $key ); ?>" name="matin_parto_home[<?php echo esc_attr( $key ); ?>]" value="<?php echo esc_attr( $home[ $key ] ); ?>" placeholder="https://"></td></tr>
                <?php endforeach; ?>
            </table>

            <h2>فوتر</h2>
            <table class="form-table" role="presentation">
                <tr>
                    <th scope="row"><label for="footer_hover_color">رنگ هاور فهرست فوتر</label></th>
                    <td>
                        <input type="color" id="footer_hover_color" name="matin_parto_home[footer_hover_color]" value="<?php echo esc_attr( $home['footer_hover_color'] ); ?>">
                        <input class="regular-text" type="text" value="<?php echo esc_attr( $home['footer_hover_color'] ); ?>" readonly aria-label="کد رنگ هاور">
                        <p class="description">رنگی که هنگام قرار گرفتن موس روی لینک‌های فهرست فوتر نمایش داده می‌شود.</p>
                    </td>
                </tr>
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
        $('#footer_hover_color').on('input change',function(){ $(this).next('input[type="text"]').val($(this).val()); });
    });
    </script>
    <?php
}

function matin_parto_social_icon( $network ) {
    $icons = array(
        'instagram' => '<svg viewBox="0 0 24 24" aria-hidden="true"><rect x="3.5" y="3.5" width="17" height="17" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none"/></svg>',
        'telegram' => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="m21 4-3.1 16c-.2 1.1-.9 1.4-1.8.9l-4.8-3.6-2.3 2.2c-.3.3-.5.5-1 .5l.3-4.9 8.9-8c.4-.3-.1-.5-.6-.2L5.7 13.9.9 12.4c-1-.3-1-1 .2-1.5L19.8 3.7C20.7 3.4 21.5 3.8 21 4Z"/></svg>',
        'youtube' => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M21 7.2a2.7 2.7 0 0 0-1.9-1.9C17.4 4.8 12 4.8 12 4.8s-5.4 0-7.1.5A2.7 2.7 0 0 0 3 7.2C2.5 8.9 2.5 12 2.5 12s0 3.1.5 4.8a2.7 2.7 0 0 0 1.9 1.9c1.7.5 7.1.5 7.1.5s5.4 0 7.1-.5a2.7 2.7 0 0 0 1.9-1.9c.5-1.7.5-4.8.5-4.8s0-3.1-.5-4.8Z"/><path d="m10 15.5 5-3.5-5-3.5v7Z" fill="currentColor" stroke="none"/></svg>',
        'facebook' => '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M13.8 21v-8h2.7l.4-3h-3.1V8.1c0-.9.3-1.6 1.7-1.6H17V3.8c-.3 0-1.3-.1-2.5-.1-2.5 0-4.2 1.5-4.2 4.3V10H7.5v3h2.8v8h3.5Z"/></svg>',
    );
    return isset( $icons[ $network ] ) ? $icons[ $network ] : '';
}

function matin_parto_core_activate() {
    if ( false === get_option( 'matin_parto_home', false ) ) {
        add_option( 'matin_parto_home', matin_parto_home_defaults() );
    }
}
register_activation_hook( __FILE__, 'matin_parto_core_activate' );
