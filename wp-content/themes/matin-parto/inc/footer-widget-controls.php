<?php
/**
 * Per-widget footer controls: hover color, alignment and font size.
 */
defined( 'ABSPATH' ) || exit;

function matin_parto_footer_widget_controls_form( $widget, $return, $instance ) {
    $hover_color = isset( $instance['mp_footer_hover_color'] ) ? $instance['mp_footer_hover_color'] : '#7b2636';
    $align       = isset( $instance['mp_footer_align'] ) ? $instance['mp_footer_align'] : 'right';
    $font_size   = isset( $instance['mp_footer_font_size'] ) ? absint( $instance['mp_footer_font_size'] ) : 11;
    $font_size   = max( 8, min( 32, $font_size ) );
    ?>
    <div class="mp-footer-widget-controls" style="margin-top:12px;padding:10px;border:1px solid #ddd;border-radius:6px;background:#fafafa">
        <p><strong>تنظیمات نمایش این ابزارک در فوتر</strong></p>
        <p>
            <label for="<?php echo esc_attr( $widget->get_field_id( 'mp_footer_hover_color' ) ); ?>">رنگ هاور فهرست</label>
            <input id="<?php echo esc_attr( $widget->get_field_id( 'mp_footer_hover_color' ) ); ?>" name="<?php echo esc_attr( $widget->get_field_name( 'mp_footer_hover_color' ) ); ?>" type="color" value="<?php echo esc_attr( $hover_color ); ?>" style="width:70px;height:35px;padding:2px;display:block;margin-top:5px">
        </p>
        <p>
            <label for="<?php echo esc_attr( $widget->get_field_id( 'mp_footer_align' ) ); ?>">تراز محتوا</label>
            <select class="widefat" id="<?php echo esc_attr( $widget->get_field_id( 'mp_footer_align' ) ); ?>" name="<?php echo esc_attr( $widget->get_field_name( 'mp_footer_align' ) ); ?>">
                <option value="right" <?php selected( $align, 'right' ); ?>>راست‌چین</option>
                <option value="center" <?php selected( $align, 'center' ); ?>>وسط‌چین</option>
                <option value="left" <?php selected( $align, 'left' ); ?>>چپ‌چین</option>
            </select>
        </p>
        <p>
            <label for="<?php echo esc_attr( $widget->get_field_id( 'mp_footer_font_size' ) ); ?>">اندازه فونت (px)</label>
            <input class="small-text" id="<?php echo esc_attr( $widget->get_field_id( 'mp_footer_font_size' ) ); ?>" name="<?php echo esc_attr( $widget->get_field_name( 'mp_footer_font_size' ) ); ?>" type="number" min="8" max="32" step="1" value="<?php echo esc_attr( $font_size ); ?>">
        </p>
        <p class="description">این سه تنظیم وقتی ابزارک داخل یکی از ستون‌های فوتر قرار داشته باشد اعمال می‌شوند.</p>
    </div>
    <?php
}
add_action( 'in_widget_form', 'matin_parto_footer_widget_controls_form', 10, 3 );

function matin_parto_footer_widget_controls_update( $instance, $new_instance, $old_instance, $widget ) {
    $color = isset( $new_instance['mp_footer_hover_color'] ) ? sanitize_hex_color( $new_instance['mp_footer_hover_color'] ) : '';
    $align = isset( $new_instance['mp_footer_align'] ) ? sanitize_key( $new_instance['mp_footer_align'] ) : 'right';
    $size  = isset( $new_instance['mp_footer_font_size'] ) ? absint( $new_instance['mp_footer_font_size'] ) : 11;

    if ( ! $color ) {
        $color = isset( $old_instance['mp_footer_hover_color'] ) ? $old_instance['mp_footer_hover_color'] : '#7b2636';
    }

    if ( ! in_array( $align, array( 'right', 'center', 'left' ), true ) ) {
        $align = 'right';
    }

    $instance['mp_footer_hover_color'] = $color;
    $instance['mp_footer_align']       = $align;
    $instance['mp_footer_font_size']   = max( 8, min( 32, $size ) );

    return $instance;
}
add_filter( 'widget_update_callback', 'matin_parto_footer_widget_controls_update', 10, 4 );

function matin_parto_footer_widget_controls_params( $params ) {
    if ( empty( $params[0]['id'] ) || ! in_array( $params[0]['id'], array( 'footer-categories', 'footer-quick-links', 'footer-about' ), true ) ) {
        return $params;
    }

    $widget_id = isset( $params[0]['widget_id'] ) ? $params[0]['widget_id'] : '';
    if ( ! $widget_id ) {
        return $params;
    }

    $id_base = preg_replace( '/-\d+$/', '', $widget_id );
    $number  = preg_match( '/-(\d+)$/', $widget_id, $matches ) ? absint( $matches[1] ) : 0;
    $options = get_option( 'widget_' . $id_base, array() );
    $instance = ( $number && isset( $options[ $number ] ) && is_array( $options[ $number ] ) ) ? $options[ $number ] : array();

    $color = isset( $instance['mp_footer_hover_color'] ) ? sanitize_hex_color( $instance['mp_footer_hover_color'] ) : '#7b2636';
    $align = isset( $instance['mp_footer_align'] ) && in_array( $instance['mp_footer_align'], array( 'right', 'center', 'left' ), true ) ? $instance['mp_footer_align'] : 'right';
    $size  = isset( $instance['mp_footer_font_size'] ) ? max( 8, min( 32, absint( $instance['mp_footer_font_size'] ) ) ) : 11;

    $style = sprintf(
        ' style="--mp-footer-widget-hover:%1$s;--mp-footer-widget-align:%2$s;--mp-footer-widget-font-size:%3$dpx;"',
        esc_attr( $color ),
        esc_attr( $align ),
        $size
    );

    $params[0]['before_widget'] = preg_replace( '/>\s*$/', $style . '>', $params[0]['before_widget'], 1 );
    return $params;
}
add_filter( 'dynamic_sidebar_params', 'matin_parto_footer_widget_controls_params', 20 );
