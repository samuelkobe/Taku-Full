<div id="booking-form" style="display: none">
    <div class="sagenda_row">
        <div class="sagenda_col">
            <div class="sagenda_row">
                <div class="sagenda_col">
                    <div class="reservation-form-heading">

                    </div>
                    <div class="sagenda_alert sagenda_alert-faliure" id="sagenda-fields">
                        <?php _e('Please fill out all the required fields', 'sagenda-wp'); ?> 
                    </div>
                </div>
            </div>

            <div class="sagenda_row">
                <div class="sagenda_col">
                    <div class="sagenda_form-group">
                        <label for="ChoosenEvent"><?php // _e('You are subscribing the following event : ', 'sagenda-wp'); ?> </label>
                                          
                    </div>
                </div>
            </div>

            <div class="sagenda_row">
                <div class="sagenda_col">
                    <div class="sagenda_form-group">
                        <label for="exampleInputCourtesy"><?php _e('Title', 'sagenda-wp'); ?> </label>
                        <label>
                            <input type="radio" name="optionsRadios" id="optionsRadios1" value="Mr" checked />
                            <?php _e('Mr.', 'sagenda-wp'); ?>
                        </label>

                        <label>
                            <input type="radio" name="optionsRadios" id="optionsRadios1" value="Mrs" />
                            <?php _e('Mrs.', 'sagenda-wp'); ?> 
                        </label>
                    </div>
                </div>
            </div>

            <div class="sagenda_row">
                <div class="sagenda_col">
                    <div class="sagenda_form-group">
                        <label for="exampleInputFirstName"><?php _e('First Name', 'sagenda-wp'); ?></label>
                        <div>
                            <input type="text" class="sagenda_form-control" id="firstName" required placeholder="<?php _e('First Name', 'sagenda-wp'); ?>" />
                            <input type="hidden" class="sagenda_form-control" id="EventIdentifier" placeholder="EventIdentifier" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="sagenda_row">
                <div class="sagenda_col">
                    <div class="sagenda_form-group">
                        <label for="exampleInputLastName"><?php _e('Last Name', 'sagenda-wp'); ?></label>
                        <div>
                            <input type="text" class="sagenda_form-control" id="lastName" required placeholder="<?php _e('Last Name', 'sagenda-wp'); ?>" />
                        </div>
                    </div>
                </div>
            </div>


            <div class="sagenda_row">
                <div class="sagenda_col">
                    <div class="sagenda_form-group">
                        <label for="exampleInputPhone"><?php _e('Phone Number', 'sagenda-wp'); ?></label>
                        <div>
                            <input type="text" class="sagenda_form-control" id="phonenumber" required placeholder="<?php _e('Phone Number', 'sagenda-wp'); ?>" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="sagenda_row">
                <div class="sagenda_col">
                    <div class="sagenda_form-group">
                        <label for="exampleInputEmail"><?php _e('Email', 'sagenda-wp'); ?></label>
                        <div>
                            <input type="email" class="sagenda_form-control" id="email" required placeholder="<?php _e('Email', 'sagenda-wp'); ?>" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="sagenda_row">
                <div class="sagenda_col">
                    <div class="sagenda_form-group">
                        <label for="exampleInputDescription"><?php _e('Description', 'sagenda-wp'); ?></label>
                    </div>
                    <textarea class="sagenda_form-control" id="description" name="description"  rows="5"></textarea>
                </div>
            </div>
        </div>
    </div>           
    <div style="clear: both">&nbsp;</div>

    <div class="sagenda_form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <div>
                <button type="button" class="btn btn-default" id="backtocalender"><?php _e('Back to Calendar', 'sagenda-wp'); ?></button>
                <button type="button" class="btn btn-primary btn-default" id="submit-reservation"><?php _e('Submit', 'sagenda-wp'); ?></button>
            </div>
        </div>
    </div>

</div>

