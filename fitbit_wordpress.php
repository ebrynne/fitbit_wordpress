<?php
/**
 * Plugin Name: Fitbit Wordpress
 * Plugin URI: http://evan.shoes/wpfitbit
 * Description: A simple plugin for embedding fitbit data in a wordpress blog.
 * Version: 0.0.1
 * Author: Evan Brynne
 * Author URI: http://evan.shoes
 * License: MIT
 */
include_once($_SERVER['DOCUMENT_ROOT'].'/wp-load.php' );
include(plugin_dir_path( __FILE__ ) . "options.php");
include(plugin_dir_path( __FILE__ ) . "oauth/oauth.php");

function activity_graph( $atts ) {
  $oauthObject = new OAuthSimple();
  $signatures = array( 'consumer_key'     => '03db1b39c37745bcb73c1d2227563b8a',
                       'shared_secret'    => '70418c0584a346e3ba1e1e599d95259b');
  $result = $oauthObject->sign(array(
        'path'      =>'https://api.fitbit.com/1/user/2G99JL/sleep/minutesAsleep/date/2010-08-31/today.json',
        'signatures'=> $signatures));
  $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $result['signed_url']);
    $r = curl_exec($ch);
    curl_close($ch);
    return $result;
}

function add_fbwp_js_dependencies() {
  echo '<script src="http://crypto-js.googlecode.com/svn/tags/3.1.2/build/rollups/hmac-sha1.js"></script>';
  echo '<script src="http://crypto-js.googlecode.com/svn/tags/3.1.2/build/components/enc-base64-min.js"></script>';
  echo '<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.1/Chart.min.js"></script>';
  echo '<!-- <script src="js/oauth-1.0a.js"></script> -->';
}

function add_fbwp_js_source() {
  wp_enqueue_script(
    'fitbit_wordpress',
    plugins_url( 'js/fbwp_source.js' , __FILE__ ),
    array( 'jquery' )
  );

  wp_enqueue_script(
    'fitbit_wordpress_oauth',
    plugins_url( 'js/oauth.js' , __FILE__ ),
    array( 'jquery' )
  );
}

add_action('wp_head', 'add_fbwp_js_dependencies');
add_action('wp_head', 'add_fbwp_js_source');
add_shortcode('fibit_activity', 'activity_graph' );
?>