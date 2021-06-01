<?php

namespace OXI_TABS_PLUGINS\Extension\WooCommerce;

/**
 * Description of Admin
 *
 * @author biplo
 */
class Admin {

    // instance container
    private static $instance = null;

    /**
     * Define $wpdb
     *
     * @since 3.1.0
     */
    public $database;

    public static function instance() {
        if (self::$instance == null) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    public function render_html() {
        global $post;

        $tab_data = maybe_unserialize(get_post_meta($post->ID, '_oxilab_tabs_woo_data', true));
        $tab_data = is_array($tab_data) ? $tab_data : array();
        ?>
        <div class="woo-oxilab-tabs-admin-container">
            <div class="woo-oxilab-tabs-admin-header">
                <h3>Custom Tabs</h3>
                <p>Add Custom Tabs for this Product include tabs priority value and custom callback function if you want.</p>
            </div>
            <div class="woo-oxilab-tabs-admin-body">
                <?php
                $this->render_tabs_data($tab_data);
                ?>
            </div>
            <?php
            $this->generate_new_tabs();
            ?>
        </div>
        <?php
    }

    protected function render_tabs_data($tab_data) {
        $i = 1;
        foreach ($tab_data as $tab) {
            ?>
            <div class="woo-oxilab-tabs-admin-tabs oxi-hidden">
                <div class="oxi-woo-header">
                    <div class="oxi-woo-header-text"><?php echo isset($tab['title']) ? $tab['title'] : 'Tabs Title'; ?></div>
                    <div class="oxi-delete-button"></div>
                </div>
                <div class="woo-oxi-content">
                    <?php
                    $this->woocommerce_wp_text_input('layouts', $tab);
                    $this->woocommerce_wp_wysiwyg_input('layouts', $tab, $i);
                    ?>
                </div>
            </div>
            <?php
            $i++;
        }
    }

    protected function woocommerce_wp_text_input($i, $tab) {

        woocommerce_wp_text_input(
                array(
                    'id' => '_oxilab_tabs_woo_' . $i . '_tab_title_[]',
                    'label' => __('Tab Title', OXI_TABS_TEXTDOMAIN),
                    'description' => '',
                    'value' => isset($tab['title']) ? $tab['title'] : 'Tabs Title',
                    'placeholder' => __('Tab Title', OXI_TABS_TEXTDOMAIN),
                    'class' => 'oxilab_tabs_woo_' . $i . '_title_field'
                )
        );
        woocommerce_wp_text_input(
                array(
                    'id' => '_oxilab_tabs_woo_' . $i . '_tab_priority_[]',
                    'label' => __('Tab Priority', OXI_TABS_TEXTDOMAIN),
                    'description' => '',
                    'value' => isset($tab['priority']) ? $tab['priority'] : 0,
                    'placeholder' => __('Tabs Priority', OXI_TABS_TEXTDOMAIN),
                    'class' => 'oxilab_tabs_woo_' . $i . '_priority_field'
                )
        );
        woocommerce_wp_text_input(
                array(
                    'id' => '_oxilab_tabs_woo_' . $i . '_tab_callback_[]',
                    'label' => __('Callback Function', OXI_TABS_TEXTDOMAIN),
                    'description' => '',
                    'value' => isset($tab['callback']) ? $tab['callback'] : '',
                    'placeholder' => __('Add callback function else make it blank', OXI_TABS_TEXTDOMAIN),
                    'class' => 'oxilab_tabs_woo_' . $i . '_callback_field'
                )
        );
    }

    protected function woocommerce_wp_wysiwyg_input($i, $tab, $key = '') {
        echo '<div class="form-field-tinymce _oxilab_tabs_woo_layouts_content_field _oxilab_tabs_woo_layouts_tab_content_' . $i . '_field">';
        if (!isset($tab['content'])):
            $tab['content'] = '';
        endif;
        $editor_settings = array(
            'textarea_name' => '_oxilab_tabs_woo_' . $i . '_tab_content_[]'
        );

        wp_editor($tab['content'], '_oxilab_tabs_woo_' . $i . '_tab_content_' . $key, $editor_settings);

        if (isset($tab['description']) && $tab['description']) {
            echo '<span class="description">' . $tab['description'] . '</span>';
        }

        echo '</div>';
    }

    protected function generate_new_tabs() {
        ?>
        <div class="oxi-woo-tabs-add-rows">

            <div class="oxi-woo-tabs-add-rows-button">
                Add Field
            </div>
            <div class="oxi-woo-tabs-add-rows-store">
                <div class="woo-oxilab-tabs-admin-tabs">
                    <div class="oxi-woo-header">
                        <div class="oxi-woo-header-text">Text Tabs</div>
                        <div class="oxi-delete-button"></div>
                    </div>
                    <div class="woo-oxi-content">
                        <?php
                        $this->woocommerce_wp_text_input('store', ['title' => 'Tabs Title', 'priority' => 0, 'callback' => '']);
                        echo '<p class="form-field-tinymce _oxilab_tabs_woo_store_tab_content_field">       <textarea class="_oxilab_tabs_woo_store_tab_content_" name="_oxilab_tabs_woo_store_tab_content_" id="_oxilab_tabs_woo_store_tab_content_" placeholder="HTML and text to display" rows="2" cols="20" style="width:100%; min-height:10rem;"></textarea> ';
                        echo '</p>';
                        ?>
                    </div>
                </div>
            </div>
            <?php ?>


        </div>
        <?php
    }

    /**
     * Add button holder container HTML to page
     *
     * @since 1.5
     *
     * @param int $i Counter for tab generating loop
     * @return string HTML
     */
    protected function display_yikes_button_holder_container($i, $reusable_tab_flag, $reusable_tab_id) {
        $return_html = '';

        $return_html .= '<section class="button-holder" alt="' . $i . '">';

        $return_html .= '<p class="yikes_wc_override_reusable_tab_container" id="_yikes_wc_override_reusable_tab_container_' . $i . '" ';
        if ($reusable_tab_flag === true) {
            $return_html .= ' data-reusable-tab="true">';
        } else {
            $return_html .= ' style="display: none;">';
        }
        $return_html .= '<input type="checkbox" class="_yikes_wc_override_reusable_tab" id="_yikes_wc_override_reusable_tab_' . $i . '" data-tab-number="' . $i . '"';
        $return_html .= 'title="' . __('Check this box to override the saved tab', 'yikes-inc-easy-custom-woocommerce-product-tabs') . '">';
        $return_html .= '<label id="_yikes_wc_override_reusable_tab_label_' . $i . '" for="_yikes_wc_override_reusable_tab_' . $i . '" class="_yikes_wc_override_reusable_tab_label">';
        $return_html .= __(' Override Saved Tab', 'yikes-inc-easy-custom-woocommerce-product-tabs');
        $return_html .= '</label>';
        $return_html .= '<input type="hidden" name="_yikes_wc_custom_repeatable_product_tabs_saved_tab_id_' . $i . '_action" class="_yikes_wc_custom_repeatable_product_tabs_saved_tab_id_action"';
        $return_html .= 'id="_yikes_wc_custom_repeatable_product_tabs_saved_tab_id_' . $i . '_action" value="none">';
        $return_html .= '<input type="hidden" name="_yikes_wc_custom_repeatable_product_tabs_saved_tab_id_' . $i . '" class="_yikes_wc_custom_repeatable_product_tabs_saved_tab_id"';
        $return_html .= 'id="_yikes_wc_custom_repeatable_product_tabs_saved_tab_id_' . $i . '" value="' . $reusable_tab_id . '">';
        $return_html .= '</p>';

        $return_html .= '<div class="yikes_wc_move_tab_container">';
        $return_html .= '<p class="yikes_wc_move_tab">Move tab order</p>';
        $return_html .= '<span class="dashicons dashicons-arrow-up move-tab-data-up"></span>';
        $return_html .= '<span class="dashicons dashicons-arrow-down move-tab-data-down"></span>';
        $return_html .= '</div>';
        $return_html .= '<a href="#" onclick="return false;" class="button-secondary remove_this_tab"><span class="dashicons dashicons-no-alt"></span>';
        $return_html .= __('Remove Tab', 'yikes-inc-easy-custom-woocommerce-product-tabs');
        $return_html .= '</a>';
        $return_html .= '</section>';

        return $return_html;
    }

    /**
     * Add tab divider HTML to page
     *
     * @since 1.5
     *
     * @param int $i 		Counter for tab generating loop
     * @param int $tab_count Total # of tabs
     * @return string HTML
     */
    protected function display_yikes_tab_divider($i, $tab_count) {
        $return_html = '';
        if ($i != $tab_count) {
            $return_html .= '<div class="yikes-woo-custom-tab-divider"></div>';
        }

        return $return_html;
    }

    /**
     * Call input field generation function and echo HTML to page
     *
     * @since 1.5
     *
     * @param int   $i 		Counter for tab generating loop
     * @param array $tab		Array of tab data
     */
    /* Hidden Duplicate HTML Section */

    /**
     * Add duplicate remove tab button HTML to page
     *
     * @since 1.5
     *
     * @return string HTML
     */
    protected function display_yikes_remove_tab_duplicate() {
        $return_html = '';

        $return_html .= '<a href="#" onclick="return false;" class="button-secondary remove_this_tab">';
        $return_html .= '<span class="dashicons dashicons-no-alt"></span>';
        $return_html .= __('Remove Tab', 'yikes-inc-easy-custom-woocommerce-product-tabs');
        $return_html .= '</a>';

        return $return_html;
    }

    /**
     * Call input field generation function and echo HTML to page
     *
     * @since 1.5
     *
     * @param array $tab		Array of tab data
     */
    protected function display_woocommerce_wp_wysiwyg_input_duplicate() {

        $this->woocommerce_wp_textarea_input(array('id' => 'hidden_duplicator_row_content', 'label' => __('Content', 'yikes-inc-easy-custom-woocommerce-product-tabs'), 'placeholder' => __('HTML and text to display.', 'yikes-inc-easy-custom-woocommerce-product-tabs'), 'style' => 'width:100%; min-height:10rem;', 'class' => 'yikes_woo_tabs_content_field'));
    }

    /**
     * Add duplicate button holder container HTML to page
     *
     * @since 1.5
     *
     * @return string HTML
     */
    protected function display_yikes_button_holder_container_duplicate() {
        $return_html = '';

        $return_html .= '<section class="button-holder" alt="">';
        $return_html .= '<p class="yikes_wc_override_reusable_tab_container _yikes_wc_override_reusable_tab_container_duplicate" id="_yikes_wc_override_reusable_tab_container_duplicate" style="display: none;">';
        $return_html .= '<input type="checkbox" class="_yikes_wc_override_reusable_tab" id="_yikes_wc_override_reusable_tab_duplicate" title="' . __('Check this box to override the saved tab', 'yikes-inc-easy-custom-woocommerce-product-tabs') . '" />';
        $return_html .= '<label class="_yikes_wc_override_reusable_tab_label_duplicate">' . __('Override Saved Tab', 'yikes-inc-easy-custom-woocommerce-product-tabs') . '</label>';
        $return_html .= '<input type="hidden" class="_yikes_wc_custom_repeatable_product_tabs_saved_tab_id_action" id="_yikes_wc_custom_repeatable_product_tabs_saved_tab_id_action_duplicate" value="none">';
        $return_html .= '<input type="hidden" class="_yikes_wc_custom_repeatable_product_tabs_saved_tab_id" id="_yikes_wc_custom_repeatable_product_tabs_saved_tab_id_duplicate" value="">';
        $return_html .= '</p>';
        $return_html .= '<div class="yikes_wc_move_tab_container">';
        $return_html .= '<p class="yikes_wc_move_tab">Move tab order</p>';
        $return_html .= '<span class="dashicons dashicons-arrow-up move-tab-data-up"></span>';
        $return_html .= '<span class="dashicons dashicons-arrow-down move-tab-data-down"></span>';
        $return_html .= '</div>';
        $return_html .= '<a href="#" onclick="return false;" class="button-secondary remove_this_tab">';
        $return_html .= '<span class="dashicons dashicons-no-alt"></span>';
        $return_html .= __('Remove Tab', 'yikes-inc-easy-custom-woocommerce-product-tabs');
        $return_html .= '</a>';
        $return_html .= '</section>';

        return $return_html;
    }

    /**
     * Add hidden input field for number of tabs to page
     *
     * @since 1.5
     *
     * @return string HTML
     */
    protected function display_yikes_number_of_tabs($tab_count) {
        $return_html = '';

        $return_html .= '<input type="hidden" value="' . $tab_count . '" id="number_of_tabs" name="number_of_tabs" >';

        return $return_html;
    }

    /**
     * Add 'Add Another Tab' and 'Add a Saved Tab' buttons to page
     *
     * @since 1.5
     *
     * @param bool | $product_has_tabs | flag indicating whether the product has any defined tabs
     * @return string HTML
     */
    protected function display_yikes_add_tabs_container($product_has_tabs) {
        $return_html = '';

        // If we don't have any tabs, then add some classes
        $classes_to_add = ( $product_has_tabs === false ) ? '_yikes_wc_add_tab_center_new _yikes_wc_add_tab_center' : '';

        $return_html .= '<div class="add_tabs_container ' . $classes_to_add . '">';
        $return_html .= '<span id="yikes_woo_ajax_save_feedback"></span>';
        $return_html .= '<a href="#" class="button-secondary _yikes_wc_add_tabs" id="add_another_tab">';
        $return_html .= '<i class="dashicons dashicons-plus-alt inline-button-dashicons"></i>';
        $return_html .= __('Add a Tab', 'yikes-inc-easy-custom-woocommerce-product-tabs');
        $return_html .= '</a>';
        $return_html .= '<span class="yikes_wc_apply_reusable_tab_container">';
        $return_html .= '<span class="button-secondary _yikes_wc_apply_a_saved_tab _yikes_wc_add_tabs" id="_yikes_wc_apply_a_saved_tab">';
        $return_html .= '<i class="dashicons  dashicons-plus-alt inline-button-dashicons"></i>';
        $return_html .= __('Add a Saved Tab', 'yikes-inc-easy-custom-woocommerce-product-tabs');
        $return_html .= '</span>';
        $return_html .= '</span>';
        $return_html .= '<input name="save" class="button button-primary" id="yikes_woo_save_custom_tabs" value="Save Tabs" type="button">';
        $return_html .= '</div>';

        return $return_html;
    }

    /**
     * Generates a textarea field for hidden duplicate HTML block
     *
     * @param array $field Array of HTML field related values
     */
    private function woocommerce_wp_textarea_input($field) {

        if (!isset($field['placeholder']))
            $field['placeholder'] = '';
        if (!isset($field['class']))
            $field['class'] = '';
        if (!isset($field['value']))
            $field['value'] = '';

        echo '<p class="form-field-tinymce ' . $field['id'] . '_field">       <textarea class="' . $field['class'] . '" name="' . $field['id'] . '" id="' . $field['id'] . '" placeholder="' . $field['placeholder'] . '" rows="2" cols="20"' . (isset($field['style']) ? ' style="' . $field['style'] . '"' : '') . '>' . $field['value'] . '</textarea> ';

        if (isset($field['description']) && $field['description']) {
            echo '<span class="description">' . $field['description'] . '</span>';
        }

        echo '</p>';
    }

}
