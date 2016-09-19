<?php 


function wpbootstrap_scripts_with_jquery()
{
	// Register the script like this for a theme:
	wp_register_script( 'custom-script', get_template_directory_uri() . '/bootstrap/js/bootstrap.js', array( 'jquery' ) );
	wp_enqueue_script( 'my-great-script', get_template_directory_uri() . '/js/normal.js', array( 'jquery' ), '1.0.0', true );
    wp_enqueue_script('flexslider', get_stylesheet_directory_uri().'/js/jquery.flexslider.js', array('jquery'));


	// For either a plugin or a theme, you can then enqueue the script:
	wp_enqueue_script( 'custom-script' );
}

add_action( 'wp_enqueue_scripts', 'wpbootstrap_scripts_with_jquery' );
add_action('widgets_init', create_function('', 'return register_widget("my_plugin");'));



if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));\
	
register_sidebar(array(
'name' => 'Footer Widget 1',
'id'        => 'footer-1',
'description' => 'First footer widget area',
'before_widget' => '<div id="footer-widget1">',
'after_widget' => '</div>',
'before_title' => '<h2>',
'after_title' => '</h2>',
));	
register_sidebar(array(
'name' => 'Footer Widget 2',
'id'   => 'footer-2',
'description' => 'Second footer widget area',
'before_widget' => '<div id="footer-widget2">',
'after_widget' => '</div>',
'before_title' => '<h2>',
'after_title' => '</h2>',
));
register_sidebar(array(
'name' => 'Footer Widget 3',
'id'   => 'footer-3',
'description' => 'Second footer widget area',
'before_widget' => '<div id="footer-widget3">',
'after_widget' => '</div>',
'before_title' => '<h2>',
'after_title' => '</h2>',
));

/* adding menus*/
function register_my_menus(){
	register_nav_menus(
	  array(
		'top_left' => __('Top left menu'),
		'top_right' => __('Top right menu'),
		'meniu' => __('Main menu'),
		'product_list' =>__('Product List')
	  )
	);
}
add_action('init', 'register_my_menus');
$args = array(
    'flex-width'    => true,
    'width'         => 350,
    'flex-height'   => true,
    'height'        => 350,
    'default-image' => get_template_directory_uri() . '/images/logo.png',
);
add_theme_support( 'custom-header', $args );

function theme_footer_customizer($wp_customize){
 //adding section in wordpress customizer   
$wp_customize->add_section('footer_settings_section', array(
  'title'          => 'Footer Text Section'
 ));
//adding setting for footer text area
$wp_customize->add_setting('text_setting', array(
 'default'        => '© 2016. Visos teisės saugomosn',
 ));
$wp_customize->add_control('text_setting', array(
 'label'   => 'Footer Text Here',
  'section' => 'footer_settings_section',
 'type'    => 'textarea',
));
}

function theme_language_customizer($wp_customize){
 //adding section in wordpress customizer   
$wp_customize->add_section('language_settings_section', array(
  'title'          => 'Language Text Section'
 ));
//adding setting for footer text area
$wp_customize->add_setting('text_setting', array(
 'default'        => '/link',
 ));
$wp_customize->add_control('text_setting', array(
 'label'   => 'LT Page URL',
  'section' => 'language_settings_section',
 'type'    => 'textarea',
));
}
add_action('customize_register', 'theme_footer_customizer');
add_action('customize_register', 'theme_language_customizer');


/*------------------------------------------Wooccoomerce part ----------------------------------------*/
// Display Fields
add_action( 'woocommerce_product_options_general_product_data', 'woo_add_custom_general_fields',20 );

// Save Fields
add_action( 'woocommerce_process_product_meta', 'woo_add_custom_general_fields_save' );

function woo_add_custom_general_fields() {

  global $woocommerce, $post;
  
  echo'<script>
	jQuery(document).ready(function(){
	var index = 1;
	var form = jQuery(".one-product-parameters");
	for(var i=0; i<=5; i++){
			if(jQuery("input#_pavadinimas"+i).val() != ""){
				jQuery(".one-product-parameters").eq(i).slideDown("slow");
				index++;
			}

	}
	jQuery("input#add-new-form").click(function(){
		jQuery(".one-product-parameters").eq(index).slideDown("slow");
		if(index == 6 ){
			jQuery(".hidden-message").slideDown("slow");
		}
		index++;
	});
	jQuery("input#delete-new-form").click(function(){
		var index = jQuery(this).index("input#delete-new-form");
		
		jQuery(".one-product-parameters").eq(index).hide("slow");
		jQuery("input#_pavadinimas"+index).val("");
		jQuery(".hidden-message").hide("slow");
		
		index--;
		
	});
	});
	</script>';
  
  echo '<div class="product_params">';
  echo '<div class="form-title"><h2>Atskirų komplekto dalių matmenys</h2></div>';
  echo '<input type="button"  id="add-new-form" class="button" value="Pridėti matmenis">';
  echo '<div class="hidden-message"><h2>Maksimalus produktų skaičius yra 6.</h2></div>';
  for ($i = 0; $i <= 5; $i++)
  {
	  echo '<div class="one-product-parameters">';
	  woocommerce_wp_text_input( 
		array( 
			'id'          => '_pavadinimas'.$i.'', 
			'label'       => __( 'Pavadinimas', 'woocommerce' ), 
			'placeholder' => 'Fotelis',
			'desc_tip'    => 'true',
			'description' => __( 'Produkto pavadinimas.', 'woocommerce' ) 
		)
	);
		woocommerce_wp_text_input( 
		array( 
			'id'          => '_aukstis'.$i.'', 
			'label'       => __( 'Aukštis', 'woocommerce' ), 
			'placeholder' => '100mm',
			'desc_tip'    => 'true',
			'description' => __( 'Produkto aukštis.', 'woocommerce' ) 
		)
	);
		woocommerce_wp_text_input( 
		array( 
			'id'          => '_plotis'.$i.'', 
			'label'       => __( 'Plotis', 'woocommerce' ), 
			'placeholder' => '100mm',
			'desc_tip'    => 'true',
			'description' => __( 'Produkto plotis.', 'woocommerce' ) 
		)
	);
		woocommerce_wp_text_input( 
		array( 
			'id'          => '_gylis'.$i.'', 
			'label'       => __( 'Gylis', 'woocommerce' ), 
			'placeholder' => '100mm',
			'desc_tip'    => 'true',
			'description' => __( 'Produkto gylis.', 'woocommerce' ) 
		)
	);
	echo '<div class="params-header"><input type="button"  id="delete-new-form" class="button" value="Ištrinti"></div>';
	echo '</div>';
	
  }


  echo '</div>';
	
}

function woo_add_custom_general_fields_save( $post_id ){
		for($i = 0; $i <= 5; $i++){
			update_post_meta( $post_id, '_pavadinimas'.$i.'', esc_attr( $_POST['_pavadinimas'.$i.''] ) );
			update_post_meta( $post_id, '_aukstis'.$i.'', esc_attr( $_POST['_aukstis'.$i.''] ) );
			update_post_meta( $post_id, '_plotis'.$i.'', esc_attr( $_POST['_plotis'.$i.''] ) );
			update_post_meta( $post_id, '_gylis'.$i.'', esc_attr( $_POST['_gylis'.$i.''] ) );
		}
}
function add_parameters(){
	echo '<div class="col-sm-7">';
			for ($i = 0; $i <= 5; $i++) {
				$nameprod = get_post_meta( get_the_ID(), '_pavadinimas'.$i.'',true);
				$height = get_post_meta(get_the_ID(), '_aukstis'.$i.'',true);
				$width = get_post_meta(get_the_ID(), '_plotis'.$i.'',true);
				$deap = get_post_meta(get_the_ID(), '_gylis'.$i.'',true);				
				if($nameprod != ""){
					echo '<div class="col-sm-4">';
						echo '<ul>';
							echo "<li>".$nameprod."</li>";
							echo "<li> Aukštis:" .$height."</li>";
							echo "<li> Plotis:" . $width . "</li>";
							echo "<li> Gylis:" . $deap. "</li>";
						echo '</ul>';
					echo '</div>';
				}
		
			}
		echo '</div>';	
}
/*product page contacts*/

add_action( 'woocommerce_product_options_general_product_data', 'product_page_contacts',10 );
add_action( 'woocommerce_process_product_meta', 'save_page_contacts' );
add_action('woocommerce_single_product_summary','display_page_contacts',21);
/* woocommerce single product */
remove_action('woocommerce_single_product_summary','woocommerce_template_single_title',5);
remove_action('woocommerce_single_product_summary','woocommerce_template_single_price',10);
remove_action('woocommerce_after_single_product_summary','woocommerce_upsell_display',15);
remove_action('woocommerce_after_single_product_summary','woocommerce_output_product_data_tabs',10);
remove_action('woocommerce_after_single_product_summary','woocommerce_output_related_products',20);
remove_action('woocommerce_sidebar','woocommerce_get_sidebar',10);
remove_action('woocommerce_single_product_summary','woocommerce_template_single_add_to_cart',30);
remove_action('woocommerce_single_product_summary','woocommerce_template_single_meta',40);
remove_action('woocommerce_before_main_content','woocommerce_output_content_wrapper',10);
remove_action('woocommerce_before_main_content','woocommerce_breadcrumb',20);
remove_action('woocommerce_before_shop_loop','woocommerce_catalog_ordering',30);
remove_action('woocommerce_before_shop_loop','woocommerce_result_count',20);


add_action('woocommerce_single_product_summary','woocommerce_template_single_price',21);
add_action('woocommerce_before_single_product','woocommerce_template_single_title',5);
add_action('woocommerce_single_product_summary','woocommerce_output_product_data_tabs',20);
add_action('woocommerce_after_single_product_summary','add_parameters',20);

/*--------------------------------------*/


function product_page_contacts(){
	echo '<h2>Kontaktiniai duomenys</h2>';
	woocommerce_wp_text_input( 
		array( 
			'id'          => '_email'.$i.'', 
			'label'       => __( 'Email', 'woocommerce' ), 
			'placeholder' => 'info@info.lt',
			'desc_tip'    => 'true',
			'description' => __( 'Įveskite elektroninį paštą.', 'woocommerce' ) 
		)
	);
		woocommerce_wp_text_input( 
		array( 
			'id'          => '_phoneNumber'.$i.'', 
			'label'       => __( 'Telefono numeris', 'woocommerce' ), 
			'placeholder' => '+370 64687743',
			'desc_tip'    => 'true',
			'description' => __( 'Įveskite telefono numerį.', 'woocommerce' ) 
		)
	);
}
function save_page_contacts($post_id){
	$email = $_POST['_email'];
	$phoneNumber = $_POST['_phoneNumber'];
	if( !empty( $email ) && !empty( $phoneNumber ) )
	{
		update_post_meta( $post_id, '_email', esc_attr( $email ) );
		update_post_meta( $post_id, '_phoneNumber', esc_attr( $phoneNumber ) );

	}
}
function display_page_contacts(){
	$email = get_post_meta( get_the_ID(), '_email',true);
	$phoneNumber = get_post_meta( get_the_ID(), '_phoneNumber',true);

	echo'<div class="product-row">
                <p class="bold">Kontaktai:</p>
                <p><span class="glyphicon glyphicon-envelope"></span><a href="mailto:'.$email.'">'.$email.'</a></p>
                <p><span class="glyphicon glyphicon-earphone"></span><a href="tel:'.$phoneNumber.'">'.$phoneNumber.'</a></p>
    </div>';
}

/* Ask for it */
add_action( 'woocommerce_product_options_general_product_data', 'ask_for_it',11 );
add_action( 'woocommerce_process_product_meta', 'save_ask_for_it');
add_action('woocommerce_single_product_summary','display_ask_for_it',22);

function ask_for_it(){
	echo '<h2>Mygtuko tekstas</h2>';
	woocommerce_wp_text_input( 
		array( 
			'id'          => '_askForItText', 
			'label'       => __( 'Tekstas', 'woocommerce' ), 
			'desc_tip'    => 'true',
			'placeholder' => 'Teirautis',
			'description' => __( 'Įveskite elektroninį paštą.', 'woocommerce' ) ,
			'default'       => 'Teirautis'
		)
	);
}
function save_ask_for_it($post_id){
	$text = $_POST['_askForItText'];
	if( !empty( $text ) )
	{
		update_post_meta( $post_id, '_askForItText', esc_attr( $text ) );

	}
}
function display_ask_for_it(){
	$text = get_post_meta(get_the_ID(), '_askForItText', true);

	echo '<div class="product-row">';
        echo do_shortcode( '[show_tagwebs_beauty_contact_popup_form id="1"]' );
    echo '</div>';
}



function sof_load_scripts() {
    if ( !is_admin() ) {
        wp_deregister_script('jquery');
        wp_register_script('jquery', 'https://code.jquery.com/jquery-3.1.0.min.js', '3.1.0', false);
        wp_enqueue_script('jquery');
    }
}
add_action( 'wp_enqueue_scripts', 'sof_load_scripts' );

/*-----------------------------------------------Register widgets--------------------------------------------*/
add_action('widgets_init', create_function('', 'return register_widget("title_widget");'));
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 24;' ), 20 );
?>