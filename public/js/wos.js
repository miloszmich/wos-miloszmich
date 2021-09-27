jQuery(document).ready(function(){
  jQuery('#wos_widget_form').submit(function(e){
    e.preventDefault();

    var loadingGif = jQuery('#wos_widget_order_results').data('loader');
    jQuery('#wos_widget_order_results').html('<img src="'+loadingGif+'" style="margin-right:10px" width="24" height="24"><p>Checking in progress...</p>')
    
    check_connection_uri = jQuery(this).data('uri');

    jQuery.ajax({
      type      : 'POST',
      url       : check_connection_uri,
      data      : jQuery("#wos_widget_form").serialize(),
      dataType  : 'json',
      success   : function(data) {
        if (!data) {
          console.log(data);
          jQuery('#wos_widget_order_results').html('<p style="color:#cc1818">Ooops, undefined error. Please try again later.</p>');
          jQuery('#wos_widget_order_results').css('paddingTop', '20px');
          jQuery('#wos_widget_order_results').css('paddingBottom', '20px');
        }
        else {
          if(data.success === true){
            console.log(data);
            jQuery('#wos_widget_order_results').html('<p style="color:green"><b>Order status: '+data.msg+'</b></p>');
            jQuery('#wos_widget_order_results').css('paddingTop', '20px');
            jQuery('#wos_widget_order_results').css('paddingBottom', '20px');
          }
          else{
            console.log(data);
            jQuery('#wos_widget_order_results').html('<p style="color:#cc1818">'+data.msg+'</p>');
            jQuery('#wos_widget_order_results').css('paddingTop', '20px');
            jQuery('#wos_widget_order_results').css('paddingBottom', '20px');
          }
        }
      }
    });
  });
})