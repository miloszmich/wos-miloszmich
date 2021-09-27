<?php
/**
 * Global variables
 * Author: Miłosz Michałkiewicz
 * 
 * @package Woo Commerce Order Status
 * @version 1.0
 */


// Define global variables

global $wos_domain_url,
       $wos_consumer_key,
       $wos_consumer_secret;

$wos_domain_url = get_option('_wos_domain_url');
$wos_consumer_key = get_option('_wos_consumer_key');
$wos_consumer_secret = get_option('_wos_consumer_secret');