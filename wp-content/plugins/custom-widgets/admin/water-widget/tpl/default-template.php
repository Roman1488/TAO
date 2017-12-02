<section class="section border water" id="<?php echo $instance['section_name']?>">
    <div class="section-content">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-6 offset-lg-0 col-xl-6 text-wrapper">
                <h2 class="title"><?php echo nl2br($instance['title']);?></h2>
                <h3 class="subtitle"><?php echo $instance['subtitle']?></h3>
                <?php if ( ! empty( $instance['a_repeater'] ) ) {
                $repeater_items = $instance['a_repeater']; ?>
                <?php foreach( $repeater_items as $key => $repeater_item ) { ?>
                <h3 class="step-title">
                    <?php echo $repeater_item['title']; ?>
                </h3>
                <span class="step-text">
                    <?php echo $repeater_item['text']; ?>
                </span>

                <?php
                    }
                }
                ?>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-6 offset-lg-0 col-xl-6 image-wrapper">
                <img class="img-fluid" src="<?php echo wp_get_attachment_url( $instance['image'], 'full'); ?>" alt="Image">
            </div>
            <div class="col-12">
                <h2 class="instruction-title">
                    <?php echo $instance['private_instruction_title']; ?>
                </h2>
                <h2 class="instruction-subtitle"><?php echo $instance['private_instruction_subtitle']; ?></h2>
                <div class="instruction">
                    <div class="row">
                        <?php if ( ! empty( $instance['instruction_repeater'] ) ) :
                        $repeater_items = $instance['instruction_repeater'];
                        $counter = 0;
                        $maxCounter = count($repeater_items);
                        ?>
                        <?php foreach( $repeater_items as $key => $repeater_item ) :
                            $counter++;  ?>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 instruction-wrap <?php if(($counter % 2 != 0) && $counter != $maxCounter ) echo 'border-r'?>">
                            <div class="instruction-item">
                                <div class="instruction-head">
                                    <img class="instruction-item__img" src="<?php echo wp_get_attachment_url( $repeater_item['icon'], 'full'); ?>" alt="Image">
                                    <h2 class="instruction-item__title"><?php echo nl2br($repeater_item['title']); ?></h2>
                                </div>
                                <div class="instruction-text">
                                    <?php echo nl2br( $repeater_item['text'] ); ?>
                                </div>
                            </div>
                        </div>
                            <?php if(($counter % 2 == 0) && $counter != $maxCounter ) : ?>
                                <div class="col-12">
                                <p class="separation"></p>
                                </div>
                        <?php
                            endif;
                            endforeach;
                            endif; ?>

                        <div class="col-12">
                            <p class="scroll-down"><i class="fa fa-3x fa-angle-down" aria-hidden="true"></i></p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>