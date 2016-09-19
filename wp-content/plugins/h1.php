<?php

/*
Plugin Name: Title Widget
Plugin URI: https://inkthemes.com
Description: Building a Custom WordPress Widget.
Author: InkThemes
Version: 1
Author URI: https://inkthemes.com
*/

class title_widget extends WP_Widget {

// constructor
function title_widget() {
// Give widget name here
parent::WP_Widget(false, $name = __('Title Widget', 'wp_widget_plugin') );

}

function form($instance) {

// Check values
if( $instance) {
$title = esc_attr($instance['title']);

} else {
$title = '';

}
?>


<p>
	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'wp_widget_plugin'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
</p>

<?php
}


function update($new_instance, $old_instance) {
$instance = $old_instance;
// Fields
$instance['title'] = strip_tags($new_instance['title']);
return $instance;
}

// display widget
function widget($args, $instance) {
	extract( $args );

	// these are the widget options
	$title = apply_filters('widget_title', $instance['title']);
	
		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo '<h2 class="title-decoration">'.$title.'</h2>';
		} ?>

		<?php
		echo $args['after_widget'];
}
}

?>