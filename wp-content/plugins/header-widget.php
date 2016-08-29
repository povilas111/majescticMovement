<?php

/*
Plugin Name: Header Widget
Plugin URI: https://pg-development.lt
Description: Majestic movement header.
Author: Povilas Geraltauskas
Version: 1
Author URI: https://pg-development.lt
*/

class header_plugin extends WP_Widget {

// constructor
function header_plugin() {
// Give widget name here
parent::WP_Widget(false, $name = __('Header Widget', 'wp_widget_plugin') );

}

function form($instance) {

// Check values
	if( $instance) {
		$title = esc_attr($instance['title']);
		$title_caption = $instance['title_caption'];
		$img_url = $instance['img_url'];
		$img_alt = $instance['img_alt'];

	
		$this->textdomain = 'mycolorpicker';
		// This is where we add the style and script
			add_action( 'load-widgets.php', array(&$this, 'my_custom_load') );

		$this->WP_Widget( 
			'mycolorpicker', 
			'My Color Picker', 
			array( 'classname' => 'mycolorpicker', 'description' => 'Color picker widget' ),
			array( 'width' => 460, 'height' => 350, 'id_base' => 'mycolorpicker' )
		);
		//Setting default color of background
		$defaults = array(
            'background_color' => '#e3e3e3'
		);
	} else {
		$title = '';
		$title_caption = ''; 
		$img_url = '';
		$img_alt = '';
	}
?>

<p>
	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'wp_widget_plugin'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
</p>
<p>
	<label for="<?php echo $this->get_field_id('title_caption');?>"><?php _e('Title Caption', 'wp_widget_plugin'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('title_caption'); ?>" name="<?php echo $this->get_field_name('title_caption'); ?>" type="text" value="<?php echo $title_caption; ?>"/> 
</p>
<p>
	<label for="<?php echo $this->get_field_id('img_url');?>"><?php _e('Main Img URL', 'wp_widget_plugin'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('img_url'); ?>" name="<?php echo $this->get_field_name('img_url'); ?>" type="text" value="<?php echo $img_url; ?>"/> 
</p>
<p>
	<label for="<?php echo $this->get_field_id('img_alt');?>"><?php _e('Main Img ALT', 'wp_widget_plugin'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('img_alt'); ?>" name="<?php echo $this->get_field_name('img_alt'); ?>" type="text" value="<?php echo $img_alt; ?>"/> 
</p>
<script type='text/javascript'>
        jQuery(document).ready(function($) {
            $('.my-color-picker').wpColorPicker();
        });
</script>
<p>
    <label for="<?php echo $this->get_field_id( 'background_color' ); ?>"><?php _e( 'Background color', $this->textdomain ); ?></label><br>
    <input class="my-color-picker" type="text" id="<?php echo $this->get_field_id( 'background_color' ); ?>" name="<?php echo $this->get_field_name( 'background_color' ); ?>" value="<?php echo esc_attr( $instance['background_color'] ); ?>" />                            
</p>
<?php
}
 function my_custom_load() {    
        wp_enqueue_style( 'wp-color-picker' );        
        wp_enqueue_script( 'wp-color-picker' );    
    }

function update($new_instance, $old_instance) {
	$instance = $old_instance;
// Fields
	$instance['title'] = strip_tags($new_instance['title']);
	$instance['title_caption'] = strip_tags($new_instance['title_caption']);
    $instance['background_color'] = $new_instance['background_color'];
	$instance['img_url'] = $new_instance['img_url'];
	$instance['img_alt'] = $new_instance['img_alt'];


return $instance;
}

// display widget
function widget($args, $instance) {
	extract( $args );

	// these are the widget options
	$title = apply_filters('widget_title', $instance['title']);
	$title_caption = $instance['title_caption'];
		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			//echo $args['before_title'] . $title . $args['after_title'];
		} ?>
		<div class='header-container' style="background:<?php echo $instance['background_color']; ?>">
			<div class="title-center">
				<div class="header-title">
					<?php for ($i = 0; $i <= strlen($instance['title']); $i++) {
						echo '<span class="moving-text">'.$instance['title'][$i].'</span>';
						}
					?>
					<div class="h1-container">
						<h1><?php echo $instance['title_caption']; ?></h1>
					</div>	
				</div>
			</div>
				<div class="hero-image">
					<div id="center">
						<img src="<?php echo $instance['img_url'];?>" alt="<?php echo $instance['img_alt'];?>'">	
					</div>	
				</div>
		</div>

		<?php
		echo $args['after_widget'];
		
		 extract( $args, EXTR_SKIP );

}
}
?>