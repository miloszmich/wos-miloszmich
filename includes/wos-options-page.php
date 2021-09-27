<?php
/**
 * Admin options page form
 * Author: Miłosz Michałkiewicz
 * 
 * @package Woo Commerce Order Status
 * @version 1.0
 */



global $wos_domain_url,
       $wos_consumer_key,
       $wos_consumer_secret;

?>

<?php if(isset($_GET['settings-updated']) && $_GET['settings-updated'] == 'true') : ?>
  <div id="setting-error-settings_updated" class="notice notice-success settings-error"> 
    <p><strong><?php _e('Settings saved.'); ?></strong></p>
  </div>
<?php endif; ?>

<?php $wos_options_page_title = __('Woo Commerce Order Status', 'wos-miloszmich');?>
<div class="wrap">
  <h2><?php echo $wos_options_page_title; ?></h2>
  <div class="card" style="width: 95%;max-width: 95%;margin-bottom:30px">
    <h2 class="title"><?php _e('About WooCommerce API'); ?></h2>
    <p></p>
    <p><?php _e('About WooCommerce API activation'); ?><br>
      <a href="https://docs.woocommerce.com/document/woocommerce-rest-api/"
        target="_blank">https://docs.woocommerce.com/document/woocommerce-rest-api/</a>
    </p>
    <p><?php _e('Technical documentation for the REST API'); ?><br>
      <a href="https://woocommerce.github.io/woocommerce-rest-api-docs/"
        target="_blank">https://woocommerce.github.io/woocommerce-rest-api-docs/</a>
    </p>
    <p></p>
  </div>

  <div class="clear"></div>

  <form method="post" action="<?php echo admin_url('options.php'); ?>" class="form-table">
    <?php settings_fields('wos-settings-group'); ?>
    <?php do_settings_fields('wos-settings-group', ""); ?>
    <table class="form-table">
      <tr class="form-field form-required">
        <th scope="row">
          <label for="_wos_domain_url">
            <?php _e('Domain URL'); ?>
            <span class="description"><?php _e('(required)'); ?></span>
          </label>
        </th>
        <td>
          <input name="_wos_domain_url" type="text" id="_wos_domain_url" value="<?php echo $wos_domain_url; ?>"
            maxlength="60" />
          <p class="description" id="tagline-description"><?php _e('Paste here shop domain. Example: https://example.com/'); ?></p>
        </td>
      </tr>
      <tr class="form-field form-required">
        <th scope="row">
          <label for="_wos_consumer_key">
            <?php _e('Consumer key'); ?>
            <span class="description"><?php _e('(required)'); ?></span>
          </label>
        </th>
        <td>
          <input name="_wos_consumer_key" type="text" id="_wos_consumer_key" value="<?php echo $wos_consumer_key; ?>"
            maxlength="60" />
        </td>
      </tr>
      <tr class="form-field form-required">
        <th scope="row">
          <label for="_wos_consumer_secret">
            <?php _e('Consumer secret'); ?>
            <span class="description"><?php _e('(required)'); ?></span>
          </label>
        </th>
        <td>
          <input name="_wos_consumer_secret" type="text" id="_wos_consumer_secret"
            value="<?php echo $wos_consumer_secret; ?>" maxlength="60" />
        </td>
      </tr>
    </table>
    <div id="checking-status" data-loader="<?php echo WOS_URL ?>admin/images/loader.gif" style="display:flex;align-items: center;margin-top: 30px;"></div>
    <table class="form-table" style="width:95%;">
      <tr class="form-field">
        <th scope="row">
          <p class="check"><span id="wos_conection_check" class="button" data-url="<?php echo WOS_URL ?>admin/wos-connection-checker.php"><?php _e('Check connection','wos-miloszmich'); ?></span></p>
        </th>
        <td style="float:right;margin-right:-15px;">
          <?php submit_button(); ?>
        </td>
      </tr>
    </table>
  </form>
</div>
