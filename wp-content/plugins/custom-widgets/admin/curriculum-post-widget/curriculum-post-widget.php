<?php
/*
Widget Name: Curriculum Post
Description: This widget add small icons before text
Author: MakeIT
*/

class Curriculum_Post_Widget extends SiteOrigin_Widget {

    function get_post_array () {
        $args = array(
            'numberposts' => -1,
            'post_type'   => 'curriculum',
            'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
        );
        $posts = get_posts( $args );

        $postOption = [];

        foreach($posts as $post){ setup_postdata($post);
            $postOption[$post->ID] = $post->post_title;
        }

        wp_reset_postdata(); // сброс

        return $postOption;
    }


    function get_style_name($instance) {
        $this->register_frontend_styles(array(
            array(
                'curriculum-post-widget',
                plugin_dir_url(__FILE__) . 'css/style.css'
            )
        ));
        return false;
    }


    function __construct() {
        //Here you can do any preparation required before calling the parent constructor, such as including additional files or initializing variables.

        //Call the parent constructor with the required arguments.
        parent::__construct(
            // The unique id for your widget.
            'curriculum-post-widget',

            // The name of the widget for display purposes.
            __('Curriculum Post', 'curriculum-post-widget-text-domain'),

            // The $widget_options array, which is passed through to WP_Widget.
            // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
            array(
                'description' => __('Curriculum Post widget.', 'curriculum-post-widget-text-domain')
            ),

            //The $control_options array, which is passed through to WP_Widget
            array(
            ),

            //The $form_options array, which describes the form fields used to configure SiteOrigin widgets. We'll explain these in more detail later.
            array(
                'a_repeater' => array(
                    'type' => 'repeater',
                    'label' => __( 'Block repeater' , 'widget-form-fields-text-domain' ),
                    'item_name'  => __( 'Post block', 'text-widgets' ),
                    'item_label' => array(
                        'selector'     => "[id*='repeat_text']",
                        'update_event' => 'change',
                        'value_method' => 'val'
                    ),
                    'fields' => array(
                        'post' => array(
                            'type' => 'select',
                            'label' => __( 'Choose post', 'widget-form-fields-text-domain' ),
                            'options' => $this->get_post_array()
                        ),
                        'image' => array(
                            'type' => 'media',
                            'label' => __( 'Block image', 'widget-form-fields-text-domain' ),
                            'choose' => __( 'Choose image', 'widget-form-fields-text-domain' ),
                            'update' => __( 'Set image', 'widget-form-fields-text-domain' ),
                            'library' => 'image',
                            'fallback' => true,
                            'description' => 'You can set specific image to the block'
                        ),
                        'mobile_image' => array(
                            'type' => 'media',
                            'label' => __( 'Block mobile image', 'widget-form-fields-text-domain' ),
                            'choose' => __( 'Choose image', 'widget-form-fields-text-domain' ),
                            'update' => __( 'Set image', 'widget-form-fields-text-domain' ),
                            'library' => 'image',
                            'fallback' => true,
                            'description' => 'You can set specific mobile image to the block'
                        ),
                        'text' => array(
                            'type' => 'tinymce',
                            'label' => __( 'Block Text', 'widget-form-fields-text-domain' ),
                            'rows' => 10,
                            'default_editor' => 'html',
                            'description' => 'You can set specific text to the block'
                        )
                    )
                ),
                /*'a_section' => array(
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
                )*/
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

siteorigin_widget_register( 'curriculum-post', __FILE__, 'Curriculum_Post_Widget' );
?>