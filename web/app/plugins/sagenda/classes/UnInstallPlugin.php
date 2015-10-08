<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UnInstallPlugin
 * This Class is Used when a User wants to Uninstall the plugin.
 * It deletes all the plugin information from the Database
 * @author zohaib
 * Date 03-20-2014
 */
class UnInstallPlugin {

    private static $instance = null;

    public static function init() {
        if (!self::$instance) {
            self::$instance = new self();
        } else {
            throw new Exception("Already initalized.");
        }
    }

    //Constructor to Call Uninstall Plugin
    private function __construct() {
        if (!defined('WP_UNINSTALL_PLUGIN'))
            exit;
        $this->mrs_delete_plugin();
    }

    function mrs_delete_plugin() {
        if (get_option('mrs1_authentication_code') != false) {
            delete_option('mrs1_authentication_code');
        }
    }

}

?>
