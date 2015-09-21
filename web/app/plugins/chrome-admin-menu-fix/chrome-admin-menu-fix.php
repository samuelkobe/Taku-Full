<?php
/*
Plugin Name: Chrome Admin Menu Fix
Description: This plugin fixes the WordPress admin menu which is caused by the latest version of Google Chrome (45).
Version: 1.1
Author: Luke Williamson
Author URI: http://lukewilliamson.com.au
License: GPLv2
*/

add_action('admin_notices', 'cfs_wdc_admin_notice');

function cfs_wdc_admin_notice() {
	global $current_user ;
        $user_id = $current_user->ID;
        /* Check that the user hasn't already clicked to ignore the message */
	if ( ! get_user_meta($user_id, 'cfs_wdc_ignore_notice') ) {
        echo '<div class="updated"><p style="float:left;">'; 
        printf(__('Your website should now be working again from using the Google Chrome Admin Menu Fix plugin, please consider making a small donation. Thanks! :) <br> <br> <a href="%1$s">Hide Notice</a>'), '?cfs_wdc_nag_ignore=0');
        echo "</p>";
		
		echo '<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top" style="float:right;">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="95G3P3AUMHPN4">
<table>
<tr><td><input type="hidden" name="on0" value="Select donation amount">Select donation amount</td></tr><tr><td><select name="os0">
	<option value="Buy me a coffee">Buy me a coffee $5.00 AUD</option>
	<option value="Buy me a beer">Buy me a beer $10.00 AUD</option>
	<option value="Motivate me to keep developing Plugins">Motivate me to keep developing Plugins $20.00 AUD</option>
	<option value="Too generous! Thank you!">Too generous! Thank you! $50.00 AUD</option>
</select> </td></tr>
</table>
<input type="hidden" name="currency_code" value="AUD">
<input type="image" src="https://www.paypalobjects.com/en_AU/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal — The safer, easier way to pay online.">
<img alt="" border="0" src="https://www.paypalobjects.com/en_AU/i/scr/pixel.gif" width="1" height="1">
</form>';
		
		echo "<div style='clear:both'></div>";
		echo "</div>";
	}
}

add_action('admin_init', 'cfs_wdc_nag_ignore');

function cfs_wdc_nag_ignore() {
	global $current_user;
        $user_id = $current_user->ID;
        if ( isset($_GET['cfs_wdc_nag_ignore']) && '0' == $_GET['cfs_wdc_nag_ignore'] ) {
             add_user_meta($user_id, 'cfs_wdc_ignore_notice', 'true', true);
	}
}

function chromefix_inline_css() { wp_add_inline_style( 'wp-admin', '#adminmenu { transform: translateZ(0); }' ); }
add_action('admin_enqueue_scripts', 'chromefix_inline_css');
?>