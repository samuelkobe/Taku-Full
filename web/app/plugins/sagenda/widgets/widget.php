<?php

/**
 * @package MyReservation
 * Developer Zohaib
 * Date 2014-02-19
 */
class SAGENDA_Widget extends WP_Widget {

    function __construct() {
        parent::__construct(
                'myreservation_widget', __('Reservation Widget'), array('description' => __('Display the Reservation Form'))
        );
    }

    function form($instance) {
        if ($instance) {
            $title = esc_attr($instance['title']);
        } else {
            $title = __('SAGENDA');
        }
    }

    function update($new_instance, $old_instance) {
        $instance['title'] = strip_tags($new_instance['title']);
        return $instance;
    }

    function widget($args, $instance) {        

        echo $args['before_widget'];
       
        echo $args['after_widget'];
    }

}

function myreservation_register_widgets() {
    register_widget('MyReservation_Widget');
}

//add_action('widgets_init', 'myreservation_register_widgets');
