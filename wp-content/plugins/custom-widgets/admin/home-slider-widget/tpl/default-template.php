<?php

    if ( ! empty( $instance['a_section'] ) ) {
        $background = $instance['a_section']['background'];
    }



    // Ensure that the repeater is available and not empty.
    if ( ! empty( $instance['a_repeater'] ) ) {
        $repeater_items = $instance['a_repeater'];
        $repeater_items_count = count($instance['a_repeater']); ?>
        <div class="slider-home-widget">
            <div class="home-slider-text <?php echo $repeater_items_count > 1 ? 'owl-carousel' : '' ; ?>">
                <?php foreach( $repeater_items as $key => $repeater_item ) { ?>
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="home-slider-image">
                                <div>
                                	<?php echo wp_get_attachment_image($repeater_item['image'], 'full'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5" style="background-color: <?php echo $background; ?>">
                            <div>
                                <div class="home-slider-text-content">
                                    <div class="hm__text">
                                        <h3 class="widget-before-title">
                                            <?php echo $repeater_item['before_title']; ?>
                                        </h3>
                                        <h2 class="widget-title">
                                            <?php echo $repeater_item['title']; ?>
                                        </h2>
                                        <div class="widget-text">
                                            <?php echo $repeater_item['text']; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php if ($repeater_items_count > 1) { ?>
                                <div class="slider-nav">
                                    <i class="fa fa-chevron-circle-left prev-btn"></i>
                                    <i class="fa fa-chevron-circle-right next-btn"></i>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php } ?>