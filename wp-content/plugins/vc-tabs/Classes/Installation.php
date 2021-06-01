<?php

namespace OXI_TABS_PLUGINS\Classes;

if (!defined('ABSPATH'))
    exit;

/**
 * Description of Installation
 *
 * @author biplo
 */
class Installation {

    protected static $lfe_instance = NULL;

    const ADMINMENU = 'get_oxilab_addons_menu';

    /**
     * Constructor of Shortcode Addons
     *
     * @since 2.0.0
     */
    public function __construct() {
        
    }

    /**
     * Access plugin instance. You can create further instances by calling
     */
    public static function get_instance() {
        if (NULL === self::$lfe_instance)
            self::$lfe_instance = new self;

        return self::$lfe_instance;
    }

    public function Datatase() {
        $database = new \OXI_TABS_PLUGINS\Helper\Database();
        $database->update_database();
    }

    public function Tabs_Datatase() {
        $this->Datatase();
        $headersize = 0;
        add_option('oxi_addons_fixed_header_size', $headersize);
    }

    /**
     * Get  Oxi Tabs Menu.
     * @return mixed
     */
    public function Tabs_Menu() {
        $response = !empty(get_transient(self::ADMINMENU)) ? get_transient(self::ADMINMENU) : [];
        if (!array_key_exists('Tabs', $response)):
            $response['Tabs']['Shortcode'] = [
                'name' => 'Shortcode',
                'homepage' => 'oxi-tabs-ultimate'
            ];
            $response['Tabs']['Create New'] = [
                'name' => 'Create New',
                'homepage' => 'oxi-tabs-ultimate-new'
            ];
            $response['Tabs']['Import Design'] = [
                'name' => 'Import Design',
                'homepage' => 'oxi-tabs-ultimate-design'
            ];
            set_transient(self::ADMINMENU, $response, 10 * DAY_IN_SECONDS);
        endif;
    }

    /**
     * Get  Oxi Tabs Menu Deactive.
     * @return mixed
     */
    public function Tabs_Menu_Deactive() {
        delete_transient(self::ADMINMENU);
    }

    /**
     * Check woocommerce during active.
     * @return mixed
     */
    public function check_woocommerce_during_active() {
        $all_plugins = apply_filters('active_plugins', get_option('active_plugins'));
        if (stripos(implode($all_plugins), 'woocommerce.php')) {
            $value = 'yes';
            update_option('oxilab_tabs_woocommerce', $value);
        }
        return true;
    }

    /**
     * Plugin activation hook
     *
     * @since 3.1.0
     */
    public function plugin_activation_hook() {
        $this->Tabs_Menu();
        $this->Tabs_Datatase();
        $this->Tabs_Post_Count();
        $this->check_woocommerce_during_active();
        // Redirect to options page
        set_transient('oxi_tabs_activation_redirect', true, 30);
    }

    /**
     * Plugin deactivation hook
     *
     * @since 3.1.0
     */
    public function plugin_deactivation_hook() {
        $this->Tabs_Menu_Deactive();
    }

    /**
     * Tabs Popular Post Count Query
     *
     * @since 3.3.0
     */
    public function Tabs_Post_Count() {
        $allposts = get_posts('numberposts=-1&post_type=post&post_status=any');
        foreach ($allposts as $postinfo) {
            add_post_meta($postinfo->ID, '_oxi_post_view_count', 0, true);
        }
    }

    /**
     * Plugin upgrade hook
     *
     * @since 1.0.0
     */
    public function plugin_upgrade_hook($upgrader_object, $options) {
        if ($options['action'] == 'update' && $options['type'] == 'plugin') {
            if (isset($options['plugins'][OXI_TABS_TEXTDOMAIN])) {
                $this->Tabs_Menu();
                $this->Tabs_Datatase();
                $this->Tabs_Post_Count();
            }
        }
    }

}
