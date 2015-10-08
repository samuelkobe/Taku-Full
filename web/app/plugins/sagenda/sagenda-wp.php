<?php

/**
 * @package Sagenda
 */
/*
  Plugin Name: Sagenda
  Plugin URI: https://github.com/Sagenda/sagenda-wp
  Description: Sagenda is an Online Booking System, which gives customers the opportunity to choose the date and the time of an appointment according to one's own preferences and the booking can now be done online. Go to your Plugin configuration page, and save your Authentication token.
  Version: 1.0.16
  Author: sagenda
  Author URI: http://www.sagenda.com/
  License: GPLv2 or later
 */

/*
  This program is free software; you can redistribute it and/or
  modify it under the terms of the GNU General Public License
  as published by the Free Software Foundation; either version 2
  of the License, or (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */
define("SAGENDA_PLUGIN_URL", plugins_url('/', __FILE__));
define('SAGENDA_PLUGIN_DIR', plugin_dir_path(__FILE__));

if (!function_exists('is_plugin_active')) {
    //include_once( ABSPATH . 'wp-admin/includes/plugin.php' );;
}
include_once( SAGENDA_PLUGIN_DIR . 'admin/admin.php' );
include_once( SAGENDA_PLUGIN_DIR . 'classes/PluginInstall.php');
include_once( SAGENDA_PLUGIN_DIR . 'classes/shortcode.php' );

class Sagenda {

    public function __construct() {

        PluginInstall::init();
        // if (is_admin()) {
        Admin::init();
        //add_filter('admin_footer_text', array($this, 'sagenda_custom_admin_footer'));
        //} else {
        ShortCode::init();

        //}
    }

    function sagenda_custom_admin_footer() {
        echo '<span id="footer-thankyou">Developed by <a href="http://www.sagenda.com/" target="_blank">IterationCorp</a></span>.';
    }

}

$objSagenda = new Sagenda();

function sagenda_load_textdomain() {
    load_plugin_textdomain('sagenda-wp', false, dirname(plugin_basename( __FILE__ )).'/languages/' );
}

add_action('wp_footer', 'sagenda_load_textdomain');
add_action('plugins_loaded', 'sagenda_load_textdomain');
?>
