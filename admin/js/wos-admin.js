jQuery(document).on('click', '#wos_conection_check', function(e){
  e.preventDefault();
  var loadingGif = jQuery('#checking-status').data('loader');
  jQuery('#checking-status').html('<img src="'+loadingGif+'" style="margin-right:10px" width="24" height="24"><p>Connection status: Please wait...</p>')
  
  var check_connection_uri = jQuery(this).data('url');
  var postForm = { 
      'wos_domain_url'     : jQuery('input[name=_wos_domain_url]').val(),
      'wos_consumer_key'     : jQuery('input[name=_wos_consumer_key]').val(),
      'wos_consumer_secret'     : jQuery('input[name=_wos_consumer_secret]').val()
  };

  console.log(postForm);

  jQuery.ajax({
    type      : 'POST',
    url       : check_connection_uri,
    data      : postForm,
    dataType  : 'json',
    success   : function(data) {
      if (!data) {
        jQuery('#checking-status').html('<p>Ooops, undefined error. Please try again later.</p>')
      }
      else {
        if(data.success === true){
          jQuery('#checking-status').html('<p style="color:green"><span class="dashicons dashicons-yes-alt" style="margin-right:10px"></span> '+data.msg+'</p>');
        }
        else{
          jQuery('#checking-status').html('<p style="color:#cc1818"><span class="dashicons dashicons-dismiss" style="margin-right:10px"></span> '+data.msg+'</p>');
        }
      }
    }
  });
})