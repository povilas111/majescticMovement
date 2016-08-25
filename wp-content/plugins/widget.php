<?php

/*
Plugin Name: Icons Widget
Plugin URI: https://inkthemes.com
Description: Building a Custom WordPress Widget.
Author: InkThemes
Version: 1
Author URI: https://inkthemes.com
*/

class my_plugin extends WP_Widget {

// constructor
function my_plugin() {
// Give widget name here
parent::WP_Widget(false, $name = __('Icons Widget', 'wp_widget_plugin') );

}

function form($instance) {

// Check values
if( $instance) {
$title = esc_attr($instance['title']);
$url = $instance['url'];
$alt = $instance['url'];
} else {
$title = '';
$url = '';
$alt = '';
}
?>


<p>
	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'wp_widget_plugin'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
</p>
<p>
	<label for="<?php echo $this->get_field_id('url'); ?>"><?php _e('Image URL:', 'wp_widget_plugin'); ?></label>
	<textarea class="widefat" id="<?php echo $this->get_field_id('url'); ?>" name="<?php echo $this->get_field_name('url'); ?>"><?php echo $url; ?></textarea>
</p>
<p>
	<label for="<?php echo $this->get_field_id('alt'); ?>"><?php _e('ALT', 'wp_widget_plugin'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('alt'); ?>" name="<?php echo $this->get_field_name('alt'); ?>" type="text" value="<?php echo $alt; ?>" />
</p>
<?php
}


function update($new_instance, $old_instance) {
$instance = $old_instance;
// Fields
$instance['title'] = strip_tags($new_instance['title']);
$instance['url'] = strip_tags($new_instance['url']);
$instance['alt'] = strip_tags($new_instance['alt']);

return $instance;
}

// display widget
function widget($args, $instance) {
	extract( $args );

	// these are the widget options
	$title = apply_filters('widget_title', $instance['title']);
	$url = $instance['url'];
	$alt = $instance['alt'];


		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			//echo $args['before_title'] . $title . $args['after_title'];
		} ?>
			<div class='row'>
				<div class="col-sm-7 col-md-10 col-lg-8 col-centered">
					<img class="icon-small" src="<?php echo $url;?>" alt="<?php echo $alt;?>"/> 
				</div>	
			</div>
			<div class="row">
				<div class="col-sm-7 col-md-10 col-lg-8 col-centered">
					<h4 class="text-center"><?php echo $instance['title'] ?></h4>
				</div>
			</div>
		<?php
		echo $args['after_widget'];
}
}

?>