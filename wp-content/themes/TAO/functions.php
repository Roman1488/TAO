<?php
function theme_scripts()
{

    wp_deregister_style( 'gllr_fancybox_stylesheet' );
    wp_deregister_script( 'bws_fancybox' );
    // Register and including styles
    wp_enqueue_style('main_style', get_template_directory_uri().'/css/style.min.css', array(), false, '');
    wp_enqueue_style('fonts', get_template_directory_uri().'/css/fonts.css', array(), false, '');

    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', includes_url( '/js/jquery/jquery.js' ), false, NULL, true );
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script('main_scripts', get_template_directory_uri().'/js/scripts.min.js', array(), false, true);
}
add_action( 'wp_enqueue_scripts', 'theme_scripts' );



function my_theme_setup() {
	/*
	 * Make theme available for translation.
	 * If you're building a theme based on Twenty Seventeen, use a find and replace
	 * to change 'my_theme' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'my_theme' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'my_theme-featured-image', 2000, 1200, true );


	// Set the default content width.
	$GLOBALS['content_width'] = 525;

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'top'    => __( 'Top Menu', 'my_theme' ),
		'social' => __( 'Social Links Menu', 'my_theme' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'audio',
	) );

	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'width'       => 250,
		'height'      => 250,
		'flex-width'  => true,
	) );


}
add_action( 'after_setup_theme', 'my_theme_setup' );


function starter_customize_register( $wp_customize ) 
{
    $wp_customize->add_section( 'header_section' , array(
        'title'    => __( 'Header', 'starter' ),
        'priority' => 30
    ) );   

    $wp_customize->add_setting( 'header_color' , array(
        'default'   => '#000000',
        'transport' => 'refresh',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color', array(
        'label'    => __( 'Header Color', 'starter' ),
        'section'  => 'header_section',
        'settings' => 'header_color',
    ) ) );
}
add_action( 'customize_register', 'starter_customize_register');

remove_shortcode('print_gllr');
add_shortcode('print_gllr', 'gllr_shortcode_custom');


if ( ! function_exists ( 'gllr_shortcode_custom' ) ) {
    function gllr_shortcode_custom( $attr ) {
        global $gllr_options, $gllr_vars_for_inline_script;

        wp_register_script( 'gllr_js', plugins_url( 'js/frontend_script.js', __FILE__ ), array( 'jquery' ) );

        /**
         * @deprecated since 4.5.2
         * @todo test and remove after #4234 (M) will be resolved
         */
        if ( isset( $_GET['print'] ) )
            return gllr_add_pdf_print_content( '', $attr );
        /** @todo end */

        extract( shortcode_atts( array(
                'id'		=> '',
                'display'	=> 'full',
                'cat_id'	=>	''
            ), $attr )
        );
        ob_start();
        require_once( ABSPATH . 'wp-admin/includes/plugin.php' );

        if ( ! empty( $cat_id ) ) {
            global $post, $wp_query;

            $term = get_term( $cat_id, 'gallery_categories' );
            if ( ! empty( $term ) ) {

                $old_wp_query = $wp_query;

                $args = array(
                    'post_type'			=> $gllr_options['post_type_name'],
                    'post_status'		=> 'publish',
                    'posts_per_page'	=> -1,
                    'gallery_categories'=> $term->slug,
                    'orderby'			=> $gllr_options['album_order_by'],
                    'order'				=> $gllr_options['album_order']
                );
                $second_query = new WP_Query( $args ); ?>
                <div class="gallery_box">
                    <ul>
                        <?php if ( $second_query->have_posts() ) {
                            if ( 1 == $gllr_options['cover_border_images'] ) {
                                $border = 'border-width: ' . $gllr_options['cover_border_images_width'] . 'px; border-color:' . $gllr_options['cover_border_images_color'] . ';border: ' . $gllr_options['cover_border_images_width'] . 'px solid ' . $gllr_options['cover_border_images_color'];
                            } else {
                                $border = "";
                            }
                            if ( 'album-thumb' != $gllr_options['image_size_album'] ) {
                                $width  = absint( get_option( $gllr_options['image_size_album'] . '_size_w' ) );
                                $height = absint( get_option( $gllr_options['image_size_album'] . '_size_h' ) );
                            } else {
                                $width  = $gllr_options['custom_size_px']['album-thumb'][0];
                                $height = $gllr_options['custom_size_px']['album-thumb'][1];
                            }

                            while ( $second_query->have_posts() ) {
                                $second_query->the_post();
                                $attachments = get_post_thumbnail_id( $post->ID );
                                if ( empty( $attachments ) ) {
                                    $images_id = get_post_meta( $post->ID, '_gallery_images', true );
                                    $attachments = get_posts( array(
                                        'showposts'			=>	1,
                                        'what_to_show'		=>	'posts',
                                        'post_status'		=>	'inherit',
                                        'post_type'			=>	'attachment',
                                        'orderby'			=>	$gllr_options['order_by'],
                                        'order'				=>	$gllr_options['order'],
                                        'post_mime_type'	=>	'image/jpeg,image/gif,image/jpg,image/png',
                                        'post__in'			=> explode( ',', $images_id ),
                                        'meta_key'			=> '_gallery_order_' . $post->ID
                                    ));
                                    if ( ! empty( $attachments[0] ) ) {
                                        $first_attachment = $attachments[0];
                                        $image_attributes = wp_get_attachment_image_src( $first_attachment->ID, $gllr_options['image_size_album'] );
                                    } else
                                        $image_attributes = array( '' );
                                } else {
                                    $image_attributes = wp_get_attachment_image_src( $attachments, $gllr_options['image_size_album'] );
                                } ?>
                                <li>
                                    <a rel="bookmark" href="<?php echo get_permalink(); ?>" title="<?php the_title(); ?>">
                                        <img <?php if ( $width ) echo 'width="' . $width . '"'; if ( $height ) echo 'height="' . $height . '"'; ?> style="<?php if ( $width ) echo 'width:' . $width . 'px;'; if ( $height ) echo 'height:' . $height . 'px;'; echo $border; ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" src="<?php echo $image_attributes[0]; ?>" />
                                    </a>
                                    <div class="gallery_detail_box">
                                        <div><?php the_title(); ?></div>
                                        <div><?php gllr_the_excerpt_max_charlength( 100 ); ?></div>
                                        <a href="<?php echo get_permalink( $post->ID ); ?>"><?php echo $gllr_options["read_more_link_text"]; ?></a>
                                    </div><!-- .gallery_detail_box -->
                                    <div class="gllr_clear"></div>
                                </li>
                            <?php }
                        } ?>
                    </ul>
                </div><!-- .gallery_box -->
                <?php wp_reset_query();
                $wp_query = $old_wp_query;
            }
        } else {
            global $post, $wp_query;
            $old_wp_query = $wp_query;

            $args = array(
                'post_type'			=> $gllr_options['post_type_name'],
                'post_status'		=> 'publish',
                'p'					=> $id,
                'posts_per_page'	=> 1
            );
            $second_query = new WP_Query( $args );
            if ( $display == 'short' ) { ?>
                <div class="gallery_box">
                    <ul>
                        <?php if ( $second_query->have_posts() ) {
                            $second_query->the_post();
                            $attachments = get_post_thumbnail_id( $post->ID );

                            if ( 'album-thumb' != $gllr_options['image_size_album'] ) {
                                $width  = absint( get_option( $gllr_options['image_size_album'] . '_size_w' ) );
                                $height = absint( get_option( $gllr_options['image_size_album'] . '_size_h' ) );
                            } else {
                                $width  = $gllr_options['custom_size_px']['album-thumb'][0];
                                $height = $gllr_options['custom_size_px']['album-thumb'][1];
                            }

                            if ( empty( $attachments ) ) {
                                $images_id = get_post_meta( $post->ID, '_gallery_images', true );
                                $attachments = get_posts( array(
                                    'showposts'			=>	1,
                                    'what_to_show'		=>	'posts',
                                    'post_status'		=>	'inherit',
                                    'post_type'			=>	'attachment',
                                    'orderby'			=>	$gllr_options['order_by'],
                                    'order'				=>	$gllr_options['order'],
                                    'post_mime_type'	=>	'image/jpeg,image/gif,image/jpg,image/png',
                                    'post__in'			=> explode( ',', $images_id ),
                                    'meta_key'			=> '_gallery_order_' . $post->ID
                                ));
                                if ( ! empty( $attachments[0] ) ) {
                                    $first_attachment = $attachments[0];
                                    $image_attributes = wp_get_attachment_image_src( $first_attachment->ID, $gllr_options['image_size_album'] );
                                } else
                                    $image_attributes = array( '' );
                            } else {
                                $image_attributes = wp_get_attachment_image_src( $attachments, $gllr_options['image_size_album'] );
                            }

                            if ( 1 == $gllr_options['cover_border_images'] ) {
                                $border = 'border-width: ' . $gllr_options['cover_border_images_width'] . 'px; border-color:' . $gllr_options['cover_border_images_color'] . ';border: ' . $gllr_options['cover_border_images_width'] . 'px solid ' . $gllr_options['cover_border_images_color'];
                            } else {
                                $border = '';
                            } ?>
                            <li>
                                <a rel="bookmark" href="<?php echo get_permalink(); ?>" title="<?php the_title(); ?>">
                                    <img <?php if ( $width ) echo 'width="' . $width . '"'; if ( $height ) echo 'height="' . $height . '"'; ?> style="<?php if ( $width ) echo 'width:' . $width . 'px;'; if ( $height ) echo 'height:' . $height . 'px;'; echo $border; ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" src="<?php echo $image_attributes[0]; ?>" />
                                </a>
                                <div class="gallery_detail_box">
                                    <div><?php the_title(); ?></div>
                                    <div><?php gllr_the_excerpt_max_charlength( 100 ); ?></div>
                                    <a href="<?php echo get_permalink( $post->ID ); ?>"><?php echo $gllr_options["read_more_link_text"]; ?></a>
                                </div><!-- .gallery_detail_box -->
                                <div class="gllr_clear"></div>
                            </li>
                        <?php } ?>
                    </ul>
                </div><!-- .gallery_box -->
            <?php } else {
                if ( $second_query->have_posts() ) {
                    if ( 1 == $gllr_options['border_images'] ) {
                        $border = 'border-width: ' . $gllr_options['border_images_width'] . 'px; border-color:' . $gllr_options['border_images_color'] . ';border: ' . $gllr_options['border_images_width'] . 'px solid ' . $gllr_options['border_images_color'];
                        $border_images = $gllr_options['border_images_width'] * 2;
                    } else {
                        $border = '';
                        $border_images = 0;
                    }
                    if ( 'photo-thumb' != $gllr_options['image_size_photo'] ) {
                        $width  = absint( get_option( $gllr_options['image_size_photo'] . '_size_w' ) );
                        $height = absint( get_option( $gllr_options['image_size_photo'] . '_size_h' ) );
                    } else {
                        $width  = $gllr_options['custom_size_px']['photo-thumb'][0];
                        $height = $gllr_options['custom_size_px']['photo-thumb'][1];
                    }

                    while ( $second_query->have_posts() ) {
                        $second_query->the_post(); ?>
                        <div class="gallery_box_single">
                        <?php echo do_shortcode( get_the_content() );

                        $images_id = get_post_meta( $post->ID, '_gallery_images', true );

                        $posts = get_posts( array(
                            "showposts"			=>	-1,
                            "what_to_show"		=> "posts",
                            "post_status"		=> "inherit",
                            "post_type"			=> "attachment",
                            "orderby"			=> $gllr_options['order_by'],
                            "order"				=> $gllr_options['order'],
                            "post_mime_type"	=> "image/jpeg,image/gif,image/jpg,image/png",
                            'post__in'			=> explode( ',', $images_id ),
                            'meta_key'			=> '_gallery_order_' . $post->ID
                        ));

                        if ( 0 < count( $posts ) ) {
                            $count_image_block = 0;
                            $bg_counter = 1;?>
                        <div class="gallery clearfix gllr_grid" data-columns="<?php echo $gllr_options["custom_image_row_count"]; ?>" data-border-width="<?php echo $gllr_options['border_images_width']; ?>">
                            <?php foreach ( $posts as $attachment ) {
                                $image_attributes		= 	wp_get_attachment_image_src( $attachment->ID, $gllr_options['image_size_photo'] );
                                $image_attributes_large	=	wp_get_attachment_image_src( $attachment->ID, 'large' );
                                $image_attributes_full	=	wp_get_attachment_image_src( $attachment->ID, 'full' );
                                $url_for_link = get_post_meta( $attachment->ID, 'gllr_link_url', true );
                                $image_text = get_post_meta( $attachment->ID, 'gllr_image_text', true );
                                $image_alt_tag = get_post_meta( $attachment->ID, 'gllr_image_alt_tag', true );

                                if ( $count_image_block % $gllr_options['custom_image_row_count'] == 0 ) { ?>
                                    <div class="gllr_image_row">
                                <?php } ?>
                                <div class="gllr_image_block">
                                    <p style="<?php if ( $width ) echo 'width:' . ( $width + $border_images ) . 'px;'; if ( $height ) echo 'height:' . ( $height + $border_images ) . 'px;'; ?>">
                                        <?php if ( ! empty( $url_for_link ) ) { ?>
                                            <a href="<?php echo $url_for_link; ?>" title="<?php echo $image_text; ?>" target="_blank">
                                                <img <?php if ( $width ) echo 'width="' . $width . '"'; if ( $height ) echo 'height="' . $height . '"'; ?> style="<?php if ( $width ) echo 'width:' . $width . 'px;'; if ( $height ) echo 'height:' . $height . 'px;'; echo $border; ?>" alt="<?php echo $image_alt_tag; ?>" title="<?php echo $image_text; ?>" src="<?php echo $image_attributes[0]; ?>" />
                                            </a>
                                        <?php } else { ?>
                                            <a class="gallery-item <?php echo 'bg_color_'.$bg_counter;?>" data-color="<?php echo 'bg_color_'.$bg_counter;?>" rel="gallery" href="<?php echo $image_attributes_large[0]; ?>" data-fancybox-title="<?php echo $image_text; ?>" title="<?php echo $image_text; ?>">
                                                <img <?php if ( $width ) echo 'width="' . $width . '"'; if ( $height ) echo 'height="' . $height . '"'; ?> style="<?php if ( $width ) echo 'width:' . $width . 'px;'; if ( $height ) echo 'height:' . $height . 'px;'; echo $border; ?>" alt="<?php echo $image_alt_tag; ?>" title="<?php echo $image_text; ?>" src="<?php echo $image_attributes[0]; ?>" rel="<?php echo $image_attributes_full[0]; ?>" />
                                            </a>
                                        <?php } ?>
                                    </p>
                                    <?php if ( 1 == $gllr_options["image_text"] ) { ?>
                                        <div <?php if ( $width ) echo 'style="width:' . ( $width + $border_images ) . 'px;"'; ?> class="gllr_single_image_text"><?php echo $image_text; ?>&nbsp;</div>
                                    <?php } ?>
                                </div><!-- .gllr_image_block -->
                                <?php if ( $count_image_block%$gllr_options['custom_image_row_count'] == $gllr_options['custom_image_row_count']-1 ) { ?>
                                    </div><!-- .gllr_image_row -->
                                <?php }
                                $count_image_block++;
                                $bg_counter++;
                                if($bg_counter > 3) $bg_counter = 1;
                            }
                            if ( 0 < $count_image_block && $count_image_block%$gllr_options['custom_image_row_count'] != 0 ) { ?>
                                </div><!-- .gllr_image_row -->
                            <?php } ?>
                            </div><!-- .gallery.clearfix -->
                        <?php }
                        if ( 1 == $gllr_options['return_link_shortcode'] ) {
                            if ( empty( $gllr_options['return_link_url'] ) ) {
                                if ( ! empty( $gllr_options["page_id_gallery_template"] ) ) { ?>
                                    <div class="return_link gllr_return_link"><a href="<?php echo get_permalink( $gllr_options["page_id_gallery_template"] ); ?>"><?php echo $gllr_options['return_link_text']; ?></a></div>
                                <?php }
                            } else { ?>
                                <div class="return_link gllr_return_link"><a href="<?php echo $gllr_options["return_link_url"]; ?>"><?php echo $gllr_options['return_link_text']; ?></a></div>
                            <?php }
                        } ?>
                        </div><!-- .gallery_box_single -->
                        <div class="gllr_clear"></div>
                    <?php }
                    if ( $gllr_options['enable_lightbox'] ) {
                        $gllr_vars_for_inline_script['single_script'][] = array(
                            'post_id' => $post->ID
                        );

                        if ( defined( 'BWS_ENQUEUE_ALL_SCRIPTS' ) ) {
                            gllr_echo_inline_script();
                        }
                    }
                } else { ?>
                    <div class="gallery_box_single">
                        <p class="not_found"><?php _e( 'Sorry, nothing found.', 'gallery-plugin' ); ?></p>
                    </div><!-- .gallery_box_single -->
                <?php }
            }
            wp_reset_query();
            $wp_query = $old_wp_query;
        }
        $gllr_output = ob_get_clean();
        return $gllr_output;
    }
}


?>