<?php
/**
 * Add new colorpicker field to "Add new Category" screen
 * - https://developer.wordpress.org/reference/hooks/taxonomy_add_form_fields/
 *
 * @param String $taxonomy
 *
 * @return void
 */
if (!function_exists('alith_colorpicker_field_add_new_category')) {
    function alith_colorpicker_field_add_new_category($taxonomy)
    {

        ?>

        <div class="form-field term-colorpicker-wrap">
            <label for="term-colorpicker"><?php echo esc_html__('Color','alith_epk'); ?></label>
            <input name="_category_color" value="#ffffff" class="colorpicker" id="term-colorpicker"/>
            <p><?php echo esc_html__('every category text have color that you can set from here. else you can set color from Post Block Plugin setting for all category text.','alith_epk'); ?></p>
        </div>

        <div class="form-field term-colorpicker-wrap">
            <label for="term-colorpicker"><?php echo esc_html__('Background Color','alith_epk'); ?></label>
            <input name="_category_color" value="#ffffff" class="colorpicker" id="term-colorpicker"/>
            <p><?php echo esc_html__('every category text have background color that you can set from here. else you can set background color from Post Block Plugin setting for all category text','alith_epk'); ?></p>
        </div>

        <?php

    }
}
add_action( 'category_add_form_fields', 'alith_colorpicker_field_add_new_category' );  // Va

/**
 * Add new colopicker field to "Edit Category" screen
 * - https://developer.wordpress.org/reference/hooks/taxonomy_add_form_fields/
 *
 * @param WP_Term_Object $term
 *
 * @return void
 */
if (!function_exists('alith_colorpicker_field_edit_category')) {
    function alith_colorpicker_field_edit_category($term)
    {

        $color = get_term_meta($term->term_id, '_category_color', true);
        $color = (!empty($color)) ? "#{$color}" : '#ffffff';

        $bgcolor = get_term_meta($term->term_id, '_bg_category_color', true);
        $bgcolor = (!empty($bgcolor)) ? "#{$bgcolor}" : '#ff252a';

        ?>

        <tr class="form-field term-colorpicker-wrap">
            <th scope="row"><label for="term-colorpicker"><?php echo esc_html__('Text Color','alith_epk'); ?></label></th>
            <td>
                <input name="_category_color" value="<?php echo esc_attr($color); ?>" class="colorpicker" id="term-colorpicker"/>
                <p class="description"><?php echo esc_html__('every category text have color that you can set from here. else you can set color from Post Block Plugin setting for all category text.','alith_epk'); ?></p>
            </td>
        </tr>
        <tr class="form-field term-bgcolorpicker-wrap">
            <th scope="row"><label for="term-colorpicker"><?php echo esc_html__('Background Color','alith_epk'); ?></label></th>
            <td>
                <input name="_bg_category_color" value="<?php echo esc_attr($bgcolor); ?>" class="colorpicker" id="term-colorpicker"/>
                <p class="description"><?php echo esc_html__('every category text have background color that you can set from here. else you can set background color from Post Block Plugin setting for all category text.','alith_epk'); ?></p>
            </td>
        </tr>

        <?php
    }
}
add_action( 'category_edit_form_fields', 'alith_colorpicker_field_edit_category' );   // Variable Hook Nam

/**
 * Term Metadata - Save Created and Edited Term Metadata
 * - https://developer.wordpress.org/reference/hooks/created_taxonomy/
 * - https://developer.wordpress.org/reference/hooks/edited_taxonomy/
 *
 * @param Integer $term_id
 *
 * @return void
 */
if (!function_exists('alith_save_termmeta')) {
    function alith_save_termmeta($term_id)
    {

        // Save term color if possible
        if (isset($_POST['_category_color']) && !empty($_POST['_category_color'])) {
            update_term_meta($term_id, '_category_color', sanitize_hex_color_no_hash($_POST['_category_color']));
        } else {
            delete_term_meta($term_id, '_category_color');
        }

        // Save term color if possible
        if (isset($_POST['_bg_category_color']) && !empty($_POST['_bg_category_color'])) {
            update_term_meta($term_id, '_bg_category_color', sanitize_hex_color_no_hash($_POST['_bg_category_color']));
        } else {
            delete_term_meta($term_id, '_bg_category_color');
        }
    }
}
add_action( 'created_category', 'alith_save_termmeta' );  // Variable Hook Name
add_action( 'edited_category',  'alith_save_termmeta' );  // Variable Hook Name

/**
 * Enqueue colorpicker styles and scripts.
 * - https://developer.wordpress.org/reference/hooks/admin_enqueue_scripts/
 *
 * @return void
 */
if (!function_exists('alith_category_colorpicker_enqueue')) {
    function alith_category_colorpicker_enqueue($taxonomy)
    {

        if (null !== ($screen = get_current_screen()) && 'edit-category' !== $screen->id) {
            return;
        }

        // Colorpicker Scripts
        wp_enqueue_script('wp-color-picker');

        // Colorpicker Styles
        wp_enqueue_style('wp-color-picker');

    }
}
add_action( 'admin_enqueue_scripts', 'alith_category_colorpicker_enqueue' );

/**
 * Print javascript to initialize the colorpicker
 * - https://developer.wordpress.org/reference/hooks/admin_print_scripts/
 *
 * @return void
 */
if (!function_exists('alith_colorpicker_init_inline')) {
    function alith_colorpicker_init_inline()
    {
        if (null !== ($screen = get_current_screen()) && 'edit-category' !== $screen->id) {
            return;
        }

        ?>

        <script>
            jQuery(document).ready(function ($) {

                $('.colorpicker').wpColorPicker();

            }); // End Document Ready JQuery
        </script>

        <?php

    }
}
add_action( 'admin_print_scripts', 'alith_colorpicker_init_inline', 20 );