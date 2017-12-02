<?php
/*
Widget Name: Home Slider
Description: This widget add small icons before text
Author: MakeIT
*/

class Home_Slider_Widget extends SiteOrigin_Widget {

    function get_style_name($instance) {
        $this->register_frontend_styles(array(
            array(
                'owl-slider-css',
                plugin_dir_url(__FILE__) . 'css/owl.carousel.min.css'
            ),
            array(
                'home-slider-widget',
                plugin_dir_url(__FILE__) . 'css/style.css'
            )
        ));
        $this->register_frontend_scripts(
            array(
                array( 'owl-slider-js', plugin_dir_url(__FILE__) .'js/owl.carousel.min.js', array( 'jquery' ), '1.8.0' ),
                array( 'home-slider-js', plugin_dir_url(__FILE__) .'js/home-slider.js', array( 'jquery' ), '1.0' ),
            )
        );
        return false;
    }


    function __construct() {
        //Here you can do any preparation required before calling the parent constructor, such as including additional files or initializing variables.

        //Call the parent constructor with the required arguments.
        parent::__construct(
            // The unique id for your widget.
            'home-slider-widget',

            // The name of the widget for display purposes.
            __('Home Slider', 'home-slider-widget-text-domain'),

            // The $widget_options array, which is passed through to WP_Widget.
            // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
            array(
                'description' => __('Home slider widget.', 'home-slider-widget-text-domain')
            ),

            //The $control_options array, which is passed through to WP_Widget
            array(
            ),

            //The $form_options array, which describes the form fields used to configure SiteOrigin widgets. We'll explain these in more detail later.
            array(
                'a_repeater' => array(
                    'type' => 'repeater',
                    'label' => __( 'Block repeater' , 'widget-form-fields-text-domain' ),
                    'item_name'  => __( 'Slide block', 'text-widgets' ),
                    'item_label' => array(
                        'selector'     => "[id*='repeat_text']",
                        'update_event' => 'change',
                        'value_method' => 'val'
                    ),
                    'fields' => array(
                        'title' => array(
                            'type' => 'text',
                            'label' => __('Title', 'siteorigin-widgets'),
                        ),
                        'before_title' => array(
                            'type' => 'text',
                            'label' => __('Text before title', 'siteorigin-widgets'),
                        ),
                        'text' => array(
                            'type' => 'tinymce',
                            'rows' => 20
                        ),
                        'image' => array(
                            'type' => 'media',
                            'label' => __( 'Slider Image', 'widget-form-fields-text-domain' ),
                            'choose' => __( 'Choose image', 'widget-form-fields-text-domain' ),
                            'update' => __( 'Set image', 'widget-form-fields-text-domain' ),
                            'library' => 'image',
                            'fallback' => true
                        )
                    )
                ),
                'a_section' => array(
                    'type' => 'section',
                    'label' => __( 'Customize how to display.' , 'widget-form-fields-text-domain' ),
                    'hide' => true,
                    'fields' => array(
                        'background' => array(
                            'type' => 'color',
                            'label' => __( 'Background color', 'widget-form-fields-text-domain' ),
                            'default' => '#09274b'
                        )
                    )
                )
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

siteorigin_widget_register( 'home-slider', __FILE__, 'Home_Slider_Widget' );
?>