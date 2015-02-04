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

$fbwp_key = "";
$fbwp_secret = "";

function activity_graph( $atts ) {
    return '<canvas id="myChart" width="400" height="400"></canvas>';
}

function add_fbwp_js_dependencies() {
  echo '<script src="http://crypto-js.googlecode.com/svn/tags/3.1.2/build/rollups/hmac-sha1.js"></script>';
  echo '<script src="http://crypto-js.googlecode.com/svn/tags/3.1.2/build/components/enc-base64-min.js"></script>';
  echo '<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.1/Chart.min.js"></script>';
  echo '<!-- <script src="js/oauth-1.0a.js"></script> -->';
}

function add_fbwp_js_source() {
  ?>
  <script type="text/javascript">
    $(document).ready ( function(){
      var ctx = document.getElementById("myChart").getContext("2d");
      var data = {
        labels: ["January", "February", "March", "April", "May", "June", "July"],
        datasets: [
          {
            label: "My First dataset",
            fillColor: "rgba(220,220,220,0.2)",
            strokeColor: "rgba(220,220,220,1)",
            pointColor: "rgba(220,220,220,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(220,220,220,1)",
            data: [65, 59, 80, 81, 56, 55, 40]
          },
          {
            label: "My Second dataset",
            fillColor: "rgba(151,187,205,0.2)",
            strokeColor: "rgba(151,187,205,1)",
            pointColor: "rgba(151,187,205,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(151,187,205,1)",
            data: [28, 48, 40, 19, 86, 27, 90]
          }
        ]
      };
      var myLineChart = new Chart(ctx).Line(data);
    });​
  </script>
  <?php
}

add_action('wp_head', 'add_fbwp_js_dependencies');
add_action('wp_head', 'add_fbwp_js_source');
add_shortcode('fibit_activity', 'activity_graph' );
?>