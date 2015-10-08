<div class="sagenda_container">
    <div class="sagenda_col">

        <?php echo($events->startdate); ?>
        <?php        
        if (!$connected) {
            echo '<div class="sagenda_alert sagenda_alert-faliure">';
            echo '<p>';
            _e('Your Sagenda account is not connected:', 'sagenda-wp');
            echo '</p>';
            echo '<p>';
            _e("1. Create a free account on <a href='https://sagenda.net/Accounts/Register'>Sagenda.</a> (set up your bookable items and events).", 'sagenda-wp');
            echo '</p>';
            echo '<p>';
            _e('2. Copy your token (from the backend of sagenda.net Settings / account)', 'sagenda-wp');
            echo '</p>';
            echo '</div>';
        }
        if ($connected === 3) {
            echo '<div class="sagenda_alert sagenda_alert-faliure">';
            echo '<p>';
            _e('You should enable curl service in your PHP/Apache configuration.', 'sagenda-wp');
            echo '</p>';
            echo '</div>';
            return;
        }
        ?>


    </div>

    <div class="sagenda_row">
        <div class="sagenda_col">
            <form method="post" id="subscribe_event" action="" role="form">                
                <div id="form-step1">
                    <div class="sagenda_row">
                        <div class="sagenda_col">
                            <div class="sagenda_alert-faliure" id="alert-mesg">
                            </div>
                            <?php wp_nonce_field('add_reservation_form', 'br_user_form'); ?>
                            <div class="sagenda_alert sagenda_alert-success" style="margin-left: 0;display: none">
                                <?php
                                _e('You successfully subscribed to the event.', 'sagenda-wp');
                                ?>                                
                            </div>
                        </div>
                    </div>
                    <?php if ($this->version > 3.4) { ?>
                        <div class="sagenda_row">
                            <div class="sagenda_col">
                                <div class="sagenda_alert sagenda_alert-error" id="alert">

                                </div>
                                <div class="sagenda_form-group">
                                    <input type="hidden" id="sagenda_lang" name="sagenda_lang" value="<?php echo get_bloginfo("language") ?>" />
                                    <label for="exampleInputStartDate"><?php _e('Start date', 'sagenda-wp');  ?>   </label>
                                    <div class="sagenda_input-append date" id="startDate" data-date="12-24-2012" data-date-format="dd M yyyy">                                
                                        <input type="text" class="sagenda_form-control"  readonly value="" id="dpd1">
                                        <span class="sagenda_add-on" id="dp4" data-date-format="dd M yyyy" data-val="true" data-date=""><i class="sagenda_icon-th"></i></span>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sagenda_row">
                            <div class="sagenda_col">
                                <div class="sagenda_form-group">
                                    <label for="exampleInputEndDate"><?php _e('End Date', 'sagenda-wp'); ?></label>
                                    <div class="sagenda_input-append date" id="endDate" data-date="12-02-2012" data-date-format="dd-mm-yyyy">
                                        <input type="text" class="sagenda_form-control" value="" readonly id="dpd2">
                                        <span class="sagenda_add-on" id="dp5" data-date-format="dd-mm-yyyy" data-val="true" data-date=""><i class="sagenda_icon-th"></i></span>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                    } else {
                        ?>
                        <div class="sagenda_row">
                            <div class="sagenda_col">
                                <div class="sagenda_form-group">
                                    <label for="exampleInputStartDate"><?php _e('Start date', 'sagenda-wp'); ?></label>
                                    <div>
                                        <input type="date" id="startDate"  name="startDate" class="sagenda_form-control" value="" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="sagenda_row">
                            <div class="sagenda_col">
                                <div class="sagenda_form-group">
                                    <label for="exampleInputEndDate"><?php _e('End Date', 'sagenda-wp'); ?></label>
                                    <div>
                                        <input type="date" id="endDate"  name="endDate" class="sagenda_form-control" value="" />
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php } ?>
                    <div class="sagenda_row">
                        <div class="sagenda_col">
                            <div class="sagenda_form-group">
                                <label for="exampleInputBookableItems"><?php _e('Bookable Items', 'sagenda-wp'); ?></label>
                                <br />
                                <select class="sagenda_form-control " id="bookableitems" >
                                    <option value="0"><?php _e('Bookable Item', 'sagenda-wp'); ?></option>
                                    <?php
                                    $iteration = 0;
                                    foreach ($bookableItems as $bookableItem) {
                                        ?>
                                        <option <?php if ($iteration === 0) echo "selected"; ?> value="<?php echo $bookableItem->Id ?>"><?php echo $bookableItem->Name; ?></option>
                                        <?php
                                        $iteration++;
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="sagenda_row">
                        <div class="sagenda_col">
                            <div class="sagenda_form-group">
                                <label for="exampleInputEvents"><?php _e('Click an event to book It:', 'sagenda-wp'); ?></label>
                                <br />
                                <div id="events-list">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php include_once 'booking.php'; ?>

                <div class="sagenda_row">
                    <div class="sagenda_col">
                        <a href="https://sagenda.net/Accounts/Register" target="_blank" class="sagenda-ref-link"><?php _e('Create a free Booking Account on Sagenda!', 'sagenda-wp'); ?></a>
                    </div>
                </div>
            </form>
        </div>
    </div>


</div>