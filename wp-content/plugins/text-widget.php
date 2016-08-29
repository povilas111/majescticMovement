<?php

/*
Plugin Name: Paragraph with link
Plugin URI: https://inkthemes.com
Description: Building a Custom WordPress Widget.
Author: InkThemes
Version: 1
Author URI: https://inkthemes.com
*/

class paragraph_plugin extends WP_Widget {

// constructor
function paragraph_plugin() {
// Give widget name here
parent::WP_Widget(false, $name = __('Paragraph with link', 'wp_widget_plugin') );

}

function form($instance) {

// Check values
if( $instance) {
$title = esc_attr($instance['title']);
$paragraph = $instance['paragraph'];
$button_text = $instance['button_text'];
$button_url = $instance['button_url'];

} else {
$title = '';
$paragraph = '';
$button_text = '';
$button_url = '';


}
?>


<p>
	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'wp_widget_plugin'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
</p>
<p>
	<label for="<?php echo $this->get_field_id('paragraph'); ?>"><?php _e('Paragraph:', 'wp_widget_plugin'); ?></label>
	<textarea class="widefat" id="<?php echo $this->get_field_id('paragraph'); ?>" name="<?php echo $this->get_field_name('paragraph'); ?>"><?php echo $paragraph; ?></textarea>
</p>
<p>
	<label for="<?php echo $this->get_field_id('button_text'); ?>"><?php _e('Button Text:', 'wp_widget_plugin'); ?></label>
	<textarea class="widefat" id="<?php echo $this->get_field_id('button_text'); ?>" name="<?php echo $this->get_field_name('button_text'); ?>"><?php echo $button_text; ?></textarea>
</p>
<p>
	<label for="<?php echo $this->get_field_id('button_url'); ?>"><?php _e('Button URL:', 'wp_widget_plugin'); ?></label>
	<textarea class="widefat" id="<?php echo $this->get_field_id('button_url'); ?>" name="<?php echo $this->get_field_name('button_url'); ?>"><?php echo $button_url; ?></textarea>
</p>


<?php
}


function update($new_instance, $old_instance) {
$instance = $old_instance;
// Fields
$instance['title'] = strip_tags($new_instance['title']);
$instance['paragraph'] = strip_tags($new_instance['paragraph']);
$instance['button_text'] = strip_tags($new_instance['button_text']);
$instance['button_url'] = strip_tags($new_instance['button_url']);


return $instance;
}

// display widget
function widget($args, $instance) {
	extract( $args );

	// these are the widget options
	$title = apply_filters('widget_title', $instance['title']);
	$paragraph = $instance['paragraph'];
	$button_url = $instance['paragraph'];
	$button_text = $instance['paragraph'];
	
		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			//echo $args['before_title'] . $title . $args['after_title'];
		} ?>
			<div class='row'>
				<div class="col-sm-8 col-md-11 col-lg-9 col-centered">
					<h2 class="text-center"><?php echo $instance['title']?></h2>
				</div>	
			</div>
			<div class="row">
				<div class="col-sm-7 col-md-10 col-lg-8 col-centered">
					<h4 class="text-center"><?php echo $instance['paragraph'] ?></h4>
					<div class="center">
						<?php
							if ($instance['button_url'] != '' && $instance['button_text'] != '') {
								echo '<a href="'.$instance['button_url'].'" type="button" class="btn btn-success">'.$instance['button_text'].'</a>';
							}
						?>					
					</div>
				</div>
			</div>
		<?php
		echo $args['after_widget'];
}
}

?>