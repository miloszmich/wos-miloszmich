<?php
/**
 * Admin settings
 * Author: Miłosz Michałkiewicz
 * 
 * @package Woo Commerce Order Status
 * @version 1.0
 */

class WooCommerce_Orders_Status_Admin {
  
  public function __construct() {
    
    // Initialize default settings
    register_activation_hook(WOS_DIR.'wos-miloszmich.php', array($this, 'WOS_options'));
    
    // Settings saved to wp_options
    add_action('admin_init', array($this, 'WOS_options'));
    
    // Translations - przygotowana ścieżka (tłumaczenia nie są uzupełnione)
    load_plugin_textdomain('wos-miloszmich', "", WOS_FOLDER.'/lang');
    
    // Admin menu settings
    add_action('admin_menu', array($this, 'WOS_admin'));
    add_action('admin_init', array($this, 'WOS_register_settings'));
    
    // Additional plugin info
    add_filter('plugin_action_links', array($this, 'WOS_action_links'), 10, 2);
    add_filter('plugin_row_meta', array($this, 'WOS_row_meta'), 10, 2);

    // Additional admin scripts
    wp_enqueue_script('footerScript',  WOS_URL.'admin/js/wos-admin.js', array(), false, true);
    

  }

  public function WOS_options() {

    add_option('_wos_domain_url', "");
    add_option('_wos_consumer_key', "");
    add_option('_wos_consumer_secret', "");

  }

  public function WOS_admin() {
    add_menu_page(__('WooCommerce Orders Status', 'wos-miloszmich'), __('Woo Oorder Status', 'wos-miloszmich'), 'manage_options', 'wos-miloszmich', array($this, 'WOS_options_page'), WOS_URL.'wos-miloszmich-icon.png');
    add_submenu_page('wos-miloszmich', __('Settings' , 'wos-miloszmich'), __('Settings' , 'wos-miloszmich'), 'manage_options', 'wos-miloszmich', array($this, 'WOS_options_page'));
    add_filter('set-screen-option', array($this, 'WOS_set_media_screen_option'), 10, 3);
  }

  public function WOS_options_page() {
    require_once(WOS_INC.'wos-options-page.php');
  }

  public function WOS_register_settings() {
    $settings = array();
    $settings[] = register_setting('wos-settings-group', '_wos_domain_url');
    $settings[] = register_setting('wos-settings-group', '_wos_consumer_key');
    $settings[] = register_setting('wos-settings-group', '_wos_consumer_secret');
    
    return apply_filters('wos_register_settings', $settings);
  }

 
  public function WOS_action_links($links, $file) {
    if(basename(dirname($file)) == 'wos-miloszmich') {
      $links[] = '<a href="'.esc_url(add_query_arg(array('page' => 'wos-miloszmich'), admin_url('admin.php'))).'">'.__('Settings','wos-miloszmich').'</a>';
    }
    return $links;
  }

}

function wos_admin_init() {
  global $wos_admin;
  $wos_admin = new WooCommerce_Orders_Status_Admin();
}
add_action('init', 'wos_admin_init');
