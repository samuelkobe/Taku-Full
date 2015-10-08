<?php
if (!ini_get('allow_url_fopen')) {
    ini_set('allow_url_fopen', '1');
}
?>
<div id="mrs-<?php echo $tab; ?>" class="wrap mrs-settings">
    <form class="mrs1-reservation-form" action="admin-post.php" method="post">
        <div class="mrs-heading">
            <?php _e('Sagenda for WordPress: Sagenda Settings', 'sagenda-wp'); ?>           
        </div>
        <?php
        global $wp_version;
        $version = $wp_version;
        if ($version >= 3.0) {
            settings_errors();
        }
        ?>
        <?php if ($connected === 3) { ?>
            <div class="sagenda-errormesg">
                <?php _e('You should enable curl service in your PHP/Apache configuration.', 'sagenda-wp'); ?> 
            </div>
        <?php } else if ($connected === 2) {
            ?>
            <div class="sagenda-errormesg">
                <?php _e('It looks like Sagenda’s WebServices failed to connect to Internet and is blocked by the server’s firewall. Please contact your hosting provider support service and ask them to unblock Sagenda’s WebServices. You can give them our WP link as reference:', 'sagenda-wp'); ?> <a href="https://wordpress.org/plugins/sagenda" target="_blank">https://wordpress.org/plugins/sagenda</a>
            </div>
            <?php
        } else if ($connected == 0) {
            ?>
            <div class="sagenda-errormesg">
                <?php _e('Your token is wrong; please try again or generate another one in Sagenda’s backend.', 'sagenda-wp'); ?>
            </div>

            <?php
        }
        ?>
        <h3 class="mrs-title"><?php _e('Sagenda Authentication Settings', 'sagenda-wp'); ?> <?php if ($connected == '1') { ?><span class="status positive"><?php _e('CONNECTED', 'sagenda-wp'); ?></span> <?php } else { ?><span class="status negative"><?php _e('NOT CONNECTED', 'sagenda-wp'); ?></span><?php } ?></h3>
        <input type="hidden" name="action" value="save_mrs1_options" />
        <?php wp_nonce_field('mrs1'); ?>

        <table class="form-table">

            <tr valign="top">
                <th scope="row"><label for="mrs-auth-code"><?php _e('Sagenda Authentication Code', 'sagenda-wp'); ?></label></th>
                <td>
                    <input type="text" name="mrs1_authentication_code" id="mrs1_authentication_code" value="<?php echo esc_html($options); ?>"/>
                    <p class="help"><a target="_blank" href="https://www.sagenda.net/"><?php _e('Click here to get your Authentication code.', 'sagenda-wp'); ?></a></p>
                </td>

            </tr>            
        </table>

        <br />                
        <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="<?php _e('Save Changes', 'sagenda-wp'); ?>"  /></p>
    </form>
    <p><?php _e('[sagenda-wp] add this shortcode either in a post or page where you want to display the Sagenda form.', 'sagenda-wp'); ?></p>
    <p><?php _e('If you want to use a shortcode outside of the WordPress post or page editor, you can use this snippet to output it from the shortcode’s handler(s): <pre>echo do_shortcode([sagenda-wp])</pre>', 'sagenda-wp'); ?></p>
</div>
<div class="footer">
    <?php include_once 'footer.php'; ?>
</div>