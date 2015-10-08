<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PluginInstall
 * This Class is Used for initial initilization of the Plugin when A user Activate the plugin after installation.
 * @author zohaib
 */
class PluginInstall {

    private static $instance = null;

    public static function init() {
        if (!self::$instance) {
            self::$instance = new self();
        } else {
            throw new Exception("Already initalized.");
        }
    }

    //put your code here
    //Constructor to Call install Plugin
    private function __construct() {
        register_activation_hook('sagenda-wp/sagenda-wp.php', array($this, 'mrs_set_default_options'));
    }

    function mrs_set_default_options() {
        if (get_option('mrs1_authentication_code') === false) {
            add_option('mrs1_authentication_code', "");
        }
    }

}

?>
