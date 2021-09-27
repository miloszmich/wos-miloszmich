<?php
/**
 * User order status
 * Author: Miłosz Michałkiewicz
 * 
 * @package Woo Commerce Order Status
 * @version 1.0
 */


class WooCommerce_Public_Order_Check {

  public function __construct() {
    $this->wos_widget_order_id = isset($_POST['wos_widget_order_id']) ? $_POST['wos_widget_order_id'] : null;
    $this->wos_widget_order_mail = isset($_POST['wos_widget_order_mail']) ? $_POST['wos_widget_order_mail'] : null;
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php')) {
      require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');
    }
  }


  public function check_data() {
    if (empty($this->wos_widget_order_id) || empty($this->wos_widget_order_mail)) {
        echo '{"success": false, "msg": "Please fill all required inputs"}';
    }
    else{
      
      if($this->email_validate($this->wos_widget_order_mail) == false){
        echo '{"success": false, "msg": "Error! Please check Your email."}';
        exit;
      }

      $uri = get_option('_wos_domain_url') . '/wp-json/wc/v3/orders/' . $this->order_id_validate($this->wos_widget_order_id) . '?consumer_key=' . get_option('_wos_consumer_key') . '&consumer_secret=' . get_option('_wos_consumer_secret');

      
      if($this->get_http_response_code($uri) == 200){
        $data = file_get_contents($uri);
        $json = json_decode($data);
        // echo '{"success": true, "msg": "' . $this->email_validate($this->wos_widget_order_mail) . '"}';
        if ($json->billing->email == $this->wos_widget_order_mail){
          echo '{"success": true, "msg": "' . $json->status . '"}';
        }
        else{
          echo '{"success": false, "msg": "Incorrect data. Please check Your order ID and email."}';
        }
      }
      else{
        echo '{"success": false, "msg": "Incorrect data. Please check Your order ID and email."}';
      }

    }

  }

  public function email_validate($email){
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
      return false;
    }
    return true;
  }
  
  public function order_id_validate($order_id){
    return preg_replace("/[^a-zA-Z0-9]+/", "", $order_id);
  }

  function get_http_response_code($uri) {
    $headers = get_headers($uri);
    return substr($headers[0], 9, 3);
  }
}

$check = new WooCommerce_Public_Order_Check();
$check->check_data();