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
include(plugin_dir_path( __FILE__ ) . "fitbitphp/fitbitphp.php");

// [bartag foo="foo-value"]
function activity_graph( $atts ) {
    $fitbit = new FitBitPHP(get_option('fw_key'), get_option('fw_secret'));
    $a = shortcode_atts( array(
        'foo' => 'something',
        'bar' => 'something else',
    ), $atts );
    $fitbit->setUser('34T29B');
    return get_option('fw_key')."<br/>" . get_option('fw_secret')." <br/ > " . $fitbit->getRecentActivities();
}
add_shortcode( fibit_activity, 'activity_graph' );
?>