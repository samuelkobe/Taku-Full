<?php
define( 'SAGENDA_PLUGIN_DIR', plugin_dir_path(__FILE__));
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}
include_once( SAGENDA_PLUGIN_DIR . 'classes/UnInstallPlugin.php');
UnInstallPlugin::init();
?>