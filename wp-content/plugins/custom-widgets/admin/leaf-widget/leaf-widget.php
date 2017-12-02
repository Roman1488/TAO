<?php
/*
Widget Name: Leaf Widget
Description: This widget add small icons before text
Author: MakeIT
*/

class Leaf_Widget extends SiteOrigin_Widget {


    /*function get_style_name($instance) {
        $this->register_frontend_styles(array(
            array(
                'curriculum-post-widget',
                plugin_dir_url(__FILE__) . 'css/style.css'
            )
        ));
        return false;
    }*/


    function __construct() {
        //Here you can do any preparation required before calling the parent constructor, such as including additional files or initializing variables.

        //Call the parent constructor with the required arguments.
        parent::__construct(
            // The unique id for your widget.
            'leaf-widget',

            // The name of the widget for display purposes.
            __('Leaf Widget', 'leaf-widget-text-domain'),

            // The $widget_options array, which is passed through to WP_Widget.
            // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
            array(
                'description' => __('Leaf Widget', 'leaf-widget-text-domain')
            ),

            //The $control_options array, which is passed through to WP_Widget
            array(
            ),

            //The $form_options array, which describes the form fields used to configure SiteOrigin widgets. We'll explain these in more detail later.
            array(
                'section_name' => array(
                    'type' => 'text',
                    'label' => __( 'Enter section name for menu navigation', 'widget-form-fields-text-domain' ),
                ),
                'head_title' => array(
                    'type' => 'text',
                    'label' => __( 'Head Title', 'widget-form-fields-text-domain' ),
                ),
                'head_subtitle' => array(
                    'type' => 'text',
                    'label' => __( 'Head Subtitle', 'widget-form-fields-text-domain' ),
                ),
                'head_text' => array(
                    'type' => 'tinymce',
                    'label' => __( 'Section Head Text', 'widget-form-fields-text-domain' ),
                    'rows' => 10,
                    'default_editor' => 'html',
                    'description' => 'You can set specific text to the block'
                ),
                'video_url' => array(
                    'type' => 'text',
                    'label' => __( 'Video Url', 'widget-form-fields-text-domain' ),
                ),
                'image' => array(
                    'type' => 'media',
                    'label' => __( 'Section image', 'widget-form-fields-text-domain' ),
                    'choose' => __( 'Choose image', 'widget-form-fields-text-domain' ),
                    'update' => __( 'Set image', 'widget-form-fields-text-domain' ),
                    'library' => 'image',
                    'fallback' => true,
                    'description' => 'You can set specific image to the block'
                ),
                'bottom_title' => array(
                    'type' => 'text',
                    'label' => __( 'Bottom Title', 'widget-form-fields-text-domain' ),
                ),
                'bottom_subtitle' => array(
                    'type' => 'text',
                    'label' => __( 'Bottom Subtitle', 'widget-form-fields-text-domain' ),
                ),
                'bottom_text' => array(
                    'type' => 'tinymce',
                    'label' => __( 'Section Bottom Text', 'widget-form-fields-text-domain' ),
                    'rows' => 10,
                    'default_editor' => 'html',
                    'description' => 'You can set specific text to the block'
                ),
            ),

            //The $base_folder path string.
            plugin_dir_path(__FILE__)
        );
    }

    function get_template_dir($instance) {
        return plugin_dir_path(__FILE__).'tpl';
    }
 
    function get_template_name($instance) {
        return 'default-template';
    }
}

siteorigin_widget_register( 'leaf', __FILE__, 'Leaf_Widget' );
?>