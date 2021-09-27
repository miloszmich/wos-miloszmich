<?php
/**
 * Uninstall process
 * Author: Miłosz Michałkiewicz
 * 
 * @package Woo Commerce Order Status
 * @version 1.0
 */



if(!defined('WP_UNINSTALL_PLUGIN')) {
  die('You are not allowed to call this page directly.');
}

global $blog_id, $wpdb;

// Remove settings for all sites if multisite or from single one 
if(is_multisite()) {
  $blogs = wp_get_sites();
  foreach($blogs as $blog) {
    add_option('_wos_domain_url');
    add_option('_wos_consumer_key');
    add_option('_wos_consumer_secret');
  }
} else {
  add_option('_wos_domain_url');
  add_option('_wos_consumer_key');
  add_option('_wos_consumer_secret');
}

