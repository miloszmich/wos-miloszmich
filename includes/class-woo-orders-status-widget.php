<?php
/**
 * WOS widget
 * Author: Miłosz Michałkiewicz
 * 
 * @package Woo Commerce Order Status
 * @version 1.0
 */

class WooCommerce_Orders_Status_Widget extends WP_Widget {
  
  function __construct() {
 
    parent::__construct(
        'wos_widget',
        'WooCommerce Order Status Widget'
    );

    add_action( 'widgets_init', function() {register_widget( 'WooCommerce_Orders_Status_Widget' );});
    wp_enqueue_script('custom_admin_script',  WOS_URL.'public/js/wos.js', array('jquery'));

  }

  public $args = array(
      'before_title'  => '<h4 class="widgettitle">',
      'after_title'   => '</h4>',
      'before_widget' => '<div class="widget-wrap">',
      'after_widget'  => '</div></div>',
      'w-order'  => '<div>test</div>',
  );

  public function widget( $args, $instance ) {

      echo $args['before_widget'];

      if ( ! empty( $instance['title'] ) ) {
          echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
      }

      echo '<div class="textwidget">';

      echo esc_html__( $instance['text'], 'text_domain' );

      echo '</div>';

      echo $args['w-order'];
      echo '<form id="wos_widget_form" role="form" action="'.get_site_url().'" data-uri="' . WOS_URL .'public/wos-status-checker.php">';
      echo '<input type="text" id="wos_widget_order_id" name="wos_widget_order_id" placeholder="' . __('Order ID','wos-miloszmich') . '" required style="margin-bottom:10px">';
      echo '<input type="email" id="wos_widget_order_mail" name="wos_widget_order_mail" placeholder="' . __('Email address','wos-miloszmich') . '" required style="margin-bottom:10px">';
      echo '<input type="submit" name="wos_widget_order_submit" id="wos_widget_order_submit" class="button button-primary" value="' . __('Check status','wos-miloszmich') . '">';
      echo '<div id="wos_widget_order_results" data-loader="' . WOS_URL .'public/images/loader.gif"></div>';
      echo '</form>';

  }

  public function form( $instance ) {

      $title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( '', 'text_domain' );
      $text = ! empty( $instance['text'] ) ? $instance['text'] : esc_html__( '', 'text_domain' );
      ?>
      <p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php echo esc_html__( 'Title:', 'text_domain' ); ?></label>
          <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
      </p>
      <p>
          <label for="<?php echo esc_attr( $this->get_field_id( 'Text' ) ); ?>"><?php echo esc_html__( 'Text:', 'text_domain' ); ?></label>
          <textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text' ) ); ?>" type="text" cols="30" rows="10"><?php echo esc_attr( $text ); ?></textarea>
      </p>
      <?php

  }

  public function update( $new_instance, $old_instance ) {

      $instance = array();

      $instance['title'] = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
      $instance['text'] = ( !empty( $new_instance['text'] ) ) ? $new_instance['text'] : '';

      return $instance;
  }

}
$my_widget = new WooCommerce_Orders_Status_Widget();