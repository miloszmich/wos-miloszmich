<?php
/*
Plugin Name: WooCommerce Orders Status
Plugin URI: http://miloszmich.com/
Description: Check order status on Your own website from any WooCommerce Shop.
Author: Miłosz Michałkiewicz
Author URI: http://miloszmich.com/
Version: 1.0
Text Domain: woo-orders-status-miloszmich
Domain Path: /lang/
*/

if(!defined('ABSPATH')) {
  die('You are not allowed to call this page directly.');
}


class WooCommerce_Orders_Status_Setup {

  public function __construct() {
    $this->_define_constants();
    $this->_load_wp_includes();
    $this->_load_wos();
  }

  private function _define_constants() {    
    define('WOS_VERSION', '1.0');
    define('WOS_FOLDER', basename(dirname(__FILE__)));
    define('WOS_DIR', plugin_dir_path(__FILE__));
    define('WOS_INC', WOS_DIR.'includes'.'/');
    define('WOS_URL', plugin_dir_url(WOS_FOLDER).WOS_FOLDER.'/');
    define('WOS_INC_URL', WOS_URL.'includes'.'/');
  }

  private function _load_wp_includes() {
    if(!is_admin()) {
      // submit_button
      require_once(ABSPATH.'wp-admin/includes/template.php');
    }
    // add_screen_option
    require_once(ABSPATH.'wp-admin/includes/screen.php');
  }

  private function _load_wos() {
    require_once(WOS_INC.'wos-globals.php');
    require_once(WOS_INC.'class-woo-orders-status-miloszmich-admin.php');
    require_once(WOS_INC.'class-woo-orders-status-widget.php');

  }
}

/**
 * Initialize
 */
new WooCommerce_Orders_Status_Setup();
