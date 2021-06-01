<?php

namespace OXI_TABS_PLUGINS\Page;

/**
 * Description of Welcome
 *
 * @author biplo
 */
class Import {

    use \OXI_TABS_PLUGINS\Helper\CSS_JS_Loader;

    public function __construct() {
        $this->admin_style();
        $this->Public_Render();
    }

    public function admin_style() {
        $this->admin_css_loader();
        wp_enqueue_script('oxi-tabs-import', OXI_TABS_URL . 'assets/backend/custom/import.js', false, OXI_TABS_PLUGIN_VERSION);
        apply_filters('oxi-tabs-plugin/admin_menu', TRUE);
    }

    public function Public_Render() {
        ?>
        <div class="wrap">  
            <?php ?>

            <div class="oxi-addons-wrapper">   
                <div class="oxi-addons-import-layouts">
                    <h1>Import Design</h1>
                    <p> The Import tool allows you to easily import demo content. Its too easy as copy template files from our online style list or local files and paste it into our import box. Once you import, data will shown automatically with new shortcode.</p>

                    <?php
                    if (apply_filters('oxi-tabs-plugin/pro_version', true) === false) {
                        echo '<div class="oxi-addons-updated">
                                    <p>Hey, Thank you very much, to using <strong>Responsive Tabs with WooCommerce Extension</strong>! Import Design will works only at Pro or Premium version. Our Premium version comes with lots of features and 16/6 Dedicated Support.</p>
                              </div>';
                    }
                    ?>
                    <!----- Import Form ---->
                    <form method="post" id="oxi-addons-import-data-form">
                        <div class="oxi-addons-import-data">
                            <div class="oxi-headig">
                                Import Data Form
                            </div>
                            <div class="oxi-content">
                                <textarea placeholder="Paste your style files..." name="oxistyledata" id="oxistyledata"></textarea>
                            </div>
                            <div class="oxi-buttom">
                                <a href="" class="btn btn-danger"> Reset </a>
                                <input type="submit" class="btn btn-success" name="submit" value="Save">
                            </div>
                        </div>
                    </form>
                    <div class="feature-section">
                        <h3>Get Trouble to Import Style?</h3>
                        <p>Your suggestions will make this plugin even better, Even if you get any bugs on Responsive Tabs so let us to know, We will try to solved within few hours</p>
                        <p class="oxi-feature-button">
                            <a href="https://www.oxilab.org/docs" target="_blank" rel="noopener" class="ihewc-image-features-button button button-primary">Documentation</a>
                            <a href="https://wordpress.org/support/plugin/vc-tabs/" target="_blank" rel="noopener" class="ihewc-image-features-button button button-primary">Support Forum</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

}
