<?php

    // Ensure that the repeater is available and not empty.
if ( ! empty( $instance['a_repeater'] ) ) {
    $repeater_items = $instance['a_repeater']; ?>

    <div class="curriculum-post-widget">
        <div class="row curriculum-row-wrapper">

            <?php foreach( $repeater_items as $key => $repeater_item ) {
                if ($repeater_item['post']) {
                    $post = get_post($repeater_item['post']);
                    if ($post) {
                        $title = $post->post_title;
                        $url = get_permalink($post->ID);

                        if (trim($repeater_item['image'])) {
                            $image_id = $repeater_item['image'];
                        } else {
                            $image_id = get_post_thumbnail_id($post->ID);
                        }

                        if (trim($repeater_item['text'])) {
                            $content = $repeater_item['text'];
                            
                        } else {
                            if (trim($post->post_excerpt)) {
                                $content = $post->post_excerpt;
                            } else {
                                $content = apply_filters( 'wp_trim_excerpt', $post->post_content );
                            }
                        }
                        $mobile_image_id = $repeater_item['mobile_image'];
                    ?>
                        <div class="col-xl-6 curriculum-post-item-wrap">
                            <div class="curriculum-post-item">
                                <div class="cm-post-image">
                                    <a href="<?php echo $url; ?>">
                                    	<?php echo wp_get_attachment_image($image_id , 'full'); ?>
                                    </a>
                                </div>
                                <div class="cm-post-image mobile-image">
                                    <a href="<?php echo $url; ?>">
                                        <?php echo wp_get_attachment_image($mobile_image_id , 'full'); ?>
                                    </a>
                                </div>
                                <div class="cm-post-content">
                                    <h4>
                                        <a href="<?php echo $url; ?>"><?php echo $title; ?></a>
                                    </h4>
                                    <div>
                                        <?php echo $content ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }
                }
            } ?>
        </div>
    </div>
<?php } ?>