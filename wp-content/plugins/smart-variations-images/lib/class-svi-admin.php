<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class woocommerce_svi_admin {

    private static $_this;

    /**
     * init
     *
     * @since 1.0.0
     * @return bool
     */
    public function __construct() {
        include_once( 'admin/admin-init.php' );

        add_filter('attachment_fields_to_edit', array($this, 'woo_svi_field'), 10, 2);
        add_filter('attachment_fields_to_save', array($this, 'woo_svi_field_save'), 10, 2);

        $role = get_role('shop_manager');
        $role->add_cap('manage_options');


        return true;
    }



    /**
     * Add woovsi field to media uploader
     *
     * @param $form_fields array, fields to include in attachment form
     * @param $post object, attachment record in database
     * @return $form_fields, modified form fields
     */
    function woo_svi_field($form_fields, $post) {

        if (isset($_POST['post_id']) && $_POST['post_id'] != '0') {
            $in_use = false;
            $wc = new WC_Product($_POST['post_id']);
            $att = $wc->get_attributes();

            if (!empty($att)) {

                $current = get_post_meta($post->ID, 'woosvi_slug', true);

                $html = "<select name='attachments[{$post->ID}][woosvi-slug]' id='attachments[{$post->ID}][woosvi-slug]' style='width:100%;'>";

                $variations = false;

                $html .= "<option value='' " . selected($current, '', false) . ">Select Variation</option>";

                foreach ($att as $key => $attribute) {
                    if ($attribute['is_taxonomy']) {

                        $terms = wp_get_post_terms($_POST['post_id'], $key, 'all');

                        if (!empty($terms)) {
                            $the_tax = get_taxonomy($attribute['name']);
                            $variations = true;

                            $html .= '<optgroup label="' . $the_tax->label . '">';
                            foreach ($terms as $term) {
                                if ($current == $term->slug)
                                    $in_use = true;
                                $html .= "<option value='" . $term->slug . "' " . selected($current, $term->slug, false) . ">" . $term->name . "</option>";
                            }
                            $html .= '</optgroup>';
                        }
                    } else {
                        $values = str_replace(" ", "", $attribute['value']);
                        $terms = explode('|', $values);
                        if (!empty($terms)) {
                            $variations = true;
                            $html .= '<optgroup label="' . $attribute['name'] . '">';
                            foreach ($terms as $term) {
                                if ($current == strtolower($term))
                                    $in_use = true;
                                $html .= "<option value='" . strtolower($term) . "' " . selected($current, strtolower($term), false) . ">" . $term . "</option>";
                            }
                            $html .= '</optgroup>';
                        }
                    }
                }

                if (!$in_use && $current != '')
                    $html .= "<option value='" . $current . "' " . selected($current, $current, false) . ">" . $current . "</option>";

                $html .= '</select>';
                $helps = '';
                if (!$in_use && $current != '')
                    $helps = '<div style="color:red;">Image in use by other product, if you wish to use with this product upload another new/same image.<br><strong>Image will not be displayed!</strong></div><br>';

                if ($variations) {
                    $form_fields['woosvi-slug'] = array(
                        'label' => 'Variation',
                        'input' => 'html',
                        'html' => $html,
                        'application' => 'image',
                        'exclusions' => array(
                            'audio',
                            'video'
                        ),
                        'helps' => $helps . 'Choose the variation'
                    );
                } else {
                    $form_fields['woosvi-slug'] = array(
                        'label' => 'Variation',
                        'input' => 'html',
                        'html' => 'This product doesn\'t seem to be using any variations.',
                        'application' => 'image',
                        'exclusions' => array(
                            'audio',
                            'video'
                        ),
                        'helps' => 'Add variations to the product and Save'
                    );
                }
            }
        }
        return $form_fields;
    }

    /**
     * Save values of woovsi in media uploader
     *
     * @param $post array, the post data for database
     * @param $attachment array, attachment fields from $_POST form
     * @return $post array, modified post data
     */
    function woo_svi_field_save($post, $attachment) {
        if (isset($attachment['woosvi-slug']))
            update_post_meta($post['ID'], 'woosvi_slug', $attachment['woosvi-slug']);


        return $post;
    }

}

new woocommerce_svi_admin();
