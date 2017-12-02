<section class="section olive" id="<?php echo $instance['section_name']?>">
    <div class="section-content">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-6 offset-lg-0 col-xl-6 text-wrapper">
                <h2 class="title"><?php echo $instance['title']?></h2>
                <h3 class="subtitle"><?php echo $instance['subtitle']?></h3>
                <div class="the_content">
                    <?php echo nl2br( $instance['text'] ); ?>
                </div>
                <div class="contact-info">
                    <a href="tel:<?php echo $instance['phone']?>">T: <?php echo $instance['phone']?></a>
                    <a href="mailto:<?php echo $instance['email']?>"><?php echo $instance['email']?></a>
                </div>
                <div class="contact-form">
                    <?php echo do_shortcode($instance['contact_form']); ?>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-6 offset-lg-0 col-xl-6 image-wrapper">
                <img class="img-fluid" src="<?php echo wp_get_attachment_url( $instance['image'], 'full'); ?>" alt="Image">
            </div>
            <div class="col-12">
                <p class="scroll-down"><i class="fa fa-3x fa-angle-down" aria-hidden="true"></i></p>
            </div>
        </div>
    </div>
</section>