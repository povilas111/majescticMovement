<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class woocommerce_svi_frontend {

    private static $_this;

    /**
     * contruct
     *
     * @since 1.0.0
     * @return bool
     */
    public function __construct() {
        $this->suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';

        add_action('wp', array($this, 'init'));

        return $this;
    }

    /**
     * run init to check if we are on product page
     *
     * @since 1.0.0
     * @return bool
     */
    function init() {
        if (is_product()) {
            $this->prepVars();
            add_action('wp_enqueue_scripts', array($this, 'load_scripts'), 150, 1);
            add_action('template_redirect', array($this, 'remove_gallery_and_product_images'), 10);

            add_filter('wp_get_attachment_image_attributes', array($this, 'add_woosvi_attribute'), 10, 2);
        }
    }

    /**
     * Loads the vars needed
     *
     * @since 1.1.1
     * @return instance object
     */
    function prepVars() {
        global $woosvi;
        $woosvi_options = get_option('woosvi_options');
        $this->attr = array();

        $defaults = array(
            'default' => false,
            'lens' => false,
            'columns' => 4,
            'lightbox' => false,
            'hide_thumbs' => false,
        );

        $this->woosvi_options = wp_parse_args($woosvi_options, $defaults);
        $this->detect = new Mobile_Detect;
        $class = array('woosvi_images');
        $lens = array();
        $this->getMobile();

        if ($this->woosvi_options['lens'] && !$this->isMobile) {
            array_push($class, 'woosvi_lens');
        }
        if ($this->woosvi_options['lightbox']) {
            array_push($class, 'woosvi_lightbox');
        }

        $woosvi = array(
            'data' => $this->woosvi_options,
            'class' => implode(' ', $class),
            'lens' => implode(' ', $lens)
        );
    }

    /**
     * Inspect Laoded scritps
     *
     * @since 1.1.1
     * @return instance object
     */
    function insite_inspect_scripts() {
        global $wp_scripts;
        echo PHP_EOL . '<!-- Script Handles: ';
        foreach ($wp_scripts->queue as $handle) :
            echo $handle . ' || ';
        endforeach;
        echo ' -->' . PHP_EOL;
    }

    /**
     * Check if is mobile phone
     *
     * @since 1.1.1
     * @return instance object
     */
    function getMobile() {
        $this->isMobile = false;
        if ($this->detect->isMobile())
            $this->isMobile = true;
        if ($this->detect->isTablet())
            $this->isMobile = false;
    }

    /**
     * public function to get instance
     *
     * @since 1.1.1
     * @return instance object
     */
    public function get_instance() {
        return self::$_this;
    }

    /**
     * load front-end scripts
     *
     * @since 1.0.0
     * @return bool
     */
    function load_scripts() {
        global $wp_styles, $woocommerce;

        $loads = array(
            'jquery'
        );

        if ($this->woosvi_options['lens'] && !$this->isMobile) {
            wp_enqueue_script('sviezlens', plugins_url('assets/js/jquery.ez-plus' . $this->suffix . '.js', dirname(__FILE__)), array('jquery'), null, true);
            array_push($loads, 'sviezlens');
        }

        if ($this->woosvi_options['lightbox']) {
            # prettyPhoto
            $lightbox_en = get_option('woocommerce_enable_lightbox') == 'yes' ? true : false;

            if (!$lightbox_en) {
                wp_enqueue_script('prettyPhoto', $woocommerce->plugin_url() . '/assets/js/prettyPhoto/jquery.prettyPhoto' . $this->suffix . '.js', array('jquery'), '3.1.5', true);
                wp_enqueue_script('prettyPhoto-init', $woocommerce->plugin_url() . '/assets/js/prettyPhoto/jquery.prettyPhoto.init' . $this->suffix . '.js', array('jquery'), $woocommerce->version, true);
                wp_enqueue_style('woocommerce_prettyPhoto_css', $woocommerce->plugin_url() . '/assets/css/prettyPhoto.css');
                array_push($loads, 'prettyPhoto', 'prettyPhoto-init');
            }
        }


        # add-to-cart-variation
        $handle = 'add-to-cart-variation' . $this->suffix . '.js';
        $list = 'enqueued';
        if (!wp_script_is($handle, $list)) {
            array_push($loads, 'wc-add-to-cart-variation');
        }

        wp_enqueue_script('woo_svijs', plugins_url('assets/js/svi-frontend' . $this->suffix . '.js', dirname(__FILE__)), $loads, null, true);

        $styles = null;
        $srcs = array_map('basename', (array) wp_list_pluck($wp_styles->registered, 'src'));
        $key_woocommerce = array_search('woocommerce.css', $srcs);

        if ($key_woocommerce) {
            $styles = array(
                $key_woocommerce,
            );
        }

        wp_enqueue_style('woo_svicss', plugins_url('assets/css/woo_svi' . $this->suffix . '.css', dirname(__FILE__)), $styles, null);
    }

    /**
     * Add 1st match of variation image to cart
     *
     * @since 1.0.0
     * @return html
     */
    function filter_woocommerce_cart_item_thumbnail($product_get_image, $cart_item = array(), $cart_item_key = array()) {

        if ($cart_item['variation_id'] > 0) {

            $found = false;
            $product = wc_get_product($cart_item['product_id']);
            $attachment_ids = $product->get_gallery_attachment_ids();
            foreach ($cart_item['variation'] as $key => $value) {
                if (!$found) {
                    foreach ($attachment_ids as $attachment_id) {
                        $woo_svi = $this->get_woosvi_attribute_thumb($attachment_id);
                        if (strtolower($value) == $woo_svi) {
                            $image_title = $product->get_title();
                            $product_get_image = wp_get_attachment_image($attachment_id, apply_filters('single_product_small_thumbnail_size', 'shop_thumbnail'), 0, $attr = array(
                                'title' => $image_title,
                                'alt' => $image_title
                            ));
                            $found = true;
                            break;
                        }
                    }
                }
            }
        }
        return $product_get_image;
    }

    /**
     * Add SVI slug to images
     *
     * @since 1.0.0
     * @return html
     */
    function add_woosvi_attribute($html, $post) {
        if (is_product()) {

            if (function_exists('icl_object_id')) {
                global $sitepress;
                $original = get_post_meta(apply_filters('wpml_object_id', $post->ID, 'attachment', FALSE, $sitepress->get_default_language()), 'woosvi_slug', true);

                $current = $this->getTranslated($original);
            } else {
                $current = get_post_meta($post->ID, 'woosvi_slug', true);
            }

            if ($this->woosvi_options['lens'] && !$this->isMobile) {
                $img = wp_get_attachment_image_src($post->ID, 'full');
                $html['data-svizoom-image'] = $img[0];
            }

            $html['data-woosvi'] = $current;
        }
        return $html;
    }

    /**
     * Get SVI slug to images
     *
     * @since 1.0.0
     * @return html
     */
    function get_woosvi_attribute($id) {
        if (is_product()) {

            if (function_exists('icl_object_id')) {
                global $sitepress;
                $original = get_post_meta(apply_filters('wpml_object_id', $id, 'attachment', FALSE, $sitepress->get_default_language()), 'woosvi_slug', true);

                $current = $this->getTranslated($original);
            } else {
                $current = get_post_meta($id, 'woosvi_slug', true);
            }
        }
        return $current;
    }

    /**
     * Get woosvi variation slug for cart image
     *
     * @since 1.0.0
     * @return html
     */
    function get_woosvi_attribute_thumb($id) {


        if (function_exists('icl_object_id')) {
            global $sitepress;
            $original = get_post_meta(apply_filters('wpml_object_id', $id, 'attachment', FALSE, $sitepress->get_default_language()), 'woosvi_slug', true);

            $current = $this->getTranslated($original);
        } else {
            $current = get_post_meta($id, 'woosvi_slug', true);
        }

        return $current;
    }

    /**
     * Get the translated text for WPML
     *
     * @since 1.0.0
     * @return html
     */
    function getTranslated($current) {
        if (!empty($this->attr)) {
            foreach ($this->attr as $key => $attribute) {
                if ($attribute['is_taxonomy'] == 1) {
                    $current_term = get_term_by('slug', $current, $key);
                    if ($current_term) {
                        $current = $current_term->slug;
                        break;
                    }
                } else {
                    foreach ($attribute['value_original'] as $k => $v) {
                        if (strtolower($current) == strtolower($v)) {
                            $current = strtolower($attribute['value'][$k]);
                            break;
                        }
                    }
                }
            }
        }
        return $current;
    }

    /**
     * Remove default theme Product Images
     *
     */
    function remove_gallery_and_product_images() {
        if (is_product()) {
            if (function_exists('icl_object_id')) {
                $this->buildWPML();
            }
            if (!$this->woosvi_options['default']) {
                add_filter('woocommerce_product_thumbnails_columns', array($this, 'woo_svi_filter_woocommerce_product_thumbnails_columns'), 11, 1);
                add_filter('woocommerce_locate_template', array($this, 'woo_svi_locate_template'), 1, 3);

                add_filter('single_product_large_thumbnail_size', create_function('', 'return "full";'));
                add_filter('single_product_small_thumbnail_size', create_function('', 'return "shop_single";'));
            }
        }
    }

    /**
     * Build correct WPML matches for translations
     *
     * @since 1.0.0
     * @return html
     */
    function buildWPML() {
        global $sitepress;
        $attr = maybe_unserialize(get_post_meta(get_the_ID(), '_product_attributes', true));
        $attr_original = maybe_unserialize(get_post_meta(icl_object_id(get_the_ID(), 'product', false, $sitepress->get_default_language()), '_product_attributes', true));

        foreach ($attr as $key => $attribute) {
            if ($attribute['is_taxonomy'] == 0) {

                $values = str_replace(" ", "", $attribute['value']);
                $terms = explode('|', $values);
                $attr[$key]['value'] = $terms;

                $values_original = str_replace(" ", "", $attr_original[$key]['value']);
                $terms_original = explode('|', $values_original);

                $attr[$key]['value_original'] = $terms_original;
            }
        }

        $this->attr = $attr;
    }

    /**
     * Get collumns for product
     *
     * @since 1.0.0
     * @return html
     */
    function woo_svi_filter_woocommerce_product_thumbnails_columns($number) {
        $number = $this->woosvi_options['columns'];
        if (empty($number) || $number < 1)
            $number = 3;

        return $number;
    }

    /**
     * Plugin path
     *
     * @since 1.0.0
     * @return html
     */
    function woo_svi_plugin_path() {
        return untrailingslashit(plugin_dir_path(dirname(__FILE__)));
    }

    /**
     * Load SVI Templates
     *
     * @since 1.0.0
     * @return html
     */
    function woo_svi_locate_template($template, $template_name, $template_path) {

        global $woocommerce;

        $_template = $template;

        if (!$template_path)
            $template_path = $woocommerce->template_url;

        $plugin_path = $this->woo_svi_plugin_path() . '/woocommerce/';
        // Look within passed path within the theme - this is priority

        $template = locate_template(
                array(
                    $template_path . $template_name,
                    $template_name
                )
        );

        // Modification: Get the template from this plugin, if it exists

        if (file_exists($plugin_path . $template_name)) {
            $template = $plugin_path . $template_name;
        }

        // Use default template

        if (!$template)
            $template = $_template;

        // Return what we found
        return $template;
    }

    /**
     * Default image
     *
     * @since 1.0.0
     * @return html
     */
    function build_mainimage() {
        global $post, $woocommerce, $product, $woosvi;

        if (has_post_thumbnail()) {
            $image_caption = get_post(get_post_thumbnail_id())->post_excerpt;
            $image_link = wp_get_attachment_url(get_post_thumbnail_id());
            $image = get_the_post_thumbnail($post->ID, apply_filters('single_product_large_thumbnail_size', 'shop_single'), array(
                'title' => get_the_title(get_post_thumbnail_id())
            ));

            $attachment_count = count($product->get_gallery_attachment_ids());

            if ($attachment_count > 0) {
                $gallery = '[product-gallery]';
            } else {
                $gallery = '';
            }

            echo sprintf('<div id="woosvimain"><a href="%s" itemprop="image" class="woocommerce-main-image hidden" title="%s" data-rel="prettyPhoto' . $gallery . '" data-o_href="%s">%s</a></div>', $image_link, $image_caption, $image_link, $image);
        } else {

            echo apply_filters('woocommerce_single_product_image_html', sprintf('<img src="%s" alt="%s" />', wc_placeholder_img_src(), __('Placeholder', 'woocommerce')), $post->ID);
        }
    }

    /**
     * Default thumbs
     *
     * @since 1.0.0
     * @return html
     */
    function build_thumbimage() {
        global $post, $product, $woocommerce, $woosvi;

        $attachment_ids = $product->get_gallery_attachment_ids();

        if ($attachment_ids) {
            $loop = 0;
            $columns = apply_filters('woocommerce_product_thumbnails_columns', 3);
            ?>
            <div class="svithumbnails <?php echo 'columns-' . $columns; ?> hidden" data-columns="<?php echo $columns; ?>"><?php
                foreach ($attachment_ids as $attachment_id) {

                    $classes = array('');

                    if ($loop === 0 || $loop % $columns === 0)
                        $classes[] = 'first';

                    if (( $loop + 1 ) % $columns === 0)
                        $classes[] = 'last';

                    $image_link = wp_get_attachment_url($attachment_id);

                    if (!$image_link)
                        continue;

                    $image_title = esc_attr(get_the_title($attachment_id));
                    $image_caption = esc_attr(get_post_field('post_excerpt', $attachment_id));

                    $image = wp_get_attachment_image($attachment_id, apply_filters('single_product_small_thumbnail_size', 'shop_thumbnail'), 0, $attr = array(
                        'title' => $image_title,
                        'alt' => $image_title
                    ));

                    $image_class = esc_attr(implode(' ', $classes));

                    if ($woosvi['data']['lightbox'])
                        $lightbox = 'gallery';
                    else
                        $lightbox = $this->get_woosvi_attribute($attachment_id);

                    echo sprintf('<a href="%s" class="%s" title="%s" data-rel="prettyPhoto[%s]" data-o_href="%s">%s</a>', $image_link, $image_class, $image_caption, $lightbox, $image_link, $image);

                    $loop++;
                }
                ?></div>
            <?php
        }
    }

}

function woosvi_class() {
    global $woosvi_class;

    if (!isset($woosvi_class)) {
        $woosvi_class = new woocommerce_svi_frontend();
    }

    return $woosvi_class;
}

// initialize
woosvi_class();
