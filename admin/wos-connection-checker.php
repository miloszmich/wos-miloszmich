<?php
/**
 * Admin settings connection checker.
 * Author: Miłosz Michałkiewicz
 * 
 * @package Woo Commerce Order Status
 * @version 1.0
 */



class WooCommerce_Admin_Url_Check {
  
  public $wos_domain_url;
  public $wos_consumer_key;
  public $wos_consumer_secret;

  public function __construct() {
    $this->wos_domain_url = isset($_POST['wos_domain_url']) ? $_POST['wos_domain_url'] : null;
    $this->wos_consumer_key = isset($_POST['wos_consumer_key']) ? $_POST['wos_consumer_key'] : null;
    $this->wos_consumer_secret = isset($_POST['wos_consumer_secret']) ? $_POST['wos_consumer_secret'] : null;
  }

  public function check_data() {
    if (empty($this->wos_domain_url) || empty($this->wos_consumer_key) || empty($this->wos_consumer_secret)) {
        echo '{"success": false, "msg": "Please fill all required inputs"}';
    }
    else{
      
      if($this->is_url($this->wos_domain_url) == false){
        echo '{"success": false, "msg": "Error! Please check shop domain."}';
        exit;
      }

      // Check if url with creditensials are correct
      $uri = $this->wos_domain_url . '/wp-json/wc/v3/orders?consumer_key=' . $this->wos_consumer_key . '&consumer_secret=' . $this->wos_consumer_secret;
      
      if($this->get_http_response_code($uri) == 200){
        echo '{"success": true, "msg": "Connection success!"}';
      }
      else{
        echo '{"success": false, "msg": "Connection problem! Please check Your domain and keys."}';
      }

    }

  }

  public function is_url($uri){
    if(preg_match( '/^(http|https):\\/\\/[a-z0-9_]+([\\-\\.]{1}[a-z_0-9]+)*\\.[_a-z]{2,5}'.'((:[0-9]{1,5})?\\/.*)?$/i' ,$uri)){
      return true;
    }
    else{
        return false;
    }
  }

  function get_http_response_code($uri) {
    $headers = get_headers($uri);
    return substr($headers[0], 9, 3);
  }
}

$check = new WooCommerce_Admin_Url_Check();
$check->check_data();