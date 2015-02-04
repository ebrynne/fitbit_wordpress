<?php
// create custom plugin settings menu
add_action('admin_menu', 'fw_create_menu');

function fw_create_menu() {

  //create new top-level menu
  add_menu_page('Fitbit Plugin Settings', 'Fitbit Settings', 'administrator', __FILE__, 'fw_settings_page');

  //call register settings function
  add_action( 'admin_init', 'register_mysettings' );
}


function register_mysettings() {
  //register our settings
  register_setting( 'fw-settings-group', 'fitbit_userid' );
}

function fw_settings_page() {
?>
<div class="wrap">
<h2>Fitbit Wordpress Settings</h2>

<form method="post" action="fitbit_wordpress.php">
    <?php settings_fields( 'fw-settings-group' ); ?>
    <?php do_settings_sections( 'fw-settings-group' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Fitbit UserID</th>
        <td><input type="text" name="fitbit_userid" value="<?php echo esc_attr( get_option('fitbit_userid') ); ?>" /></td>
        </tr>
    </table>
    
    <?php submit_button(); ?>

</form>
</div>
<?php }