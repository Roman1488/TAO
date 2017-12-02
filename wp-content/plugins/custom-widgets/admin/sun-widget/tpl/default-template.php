<section class="section sun border" id="<?php echo $instance['section_name']?>">
    <div class="section-content">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-6 offset-lg-0 col-xl-6 text-wrapper">
                <h2 class="title"><?php echo $instance['title']?></h2>
                <div class="the_content">
                    <?php echo  $instance['section_text']; ?>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-6 offset-lg-0 col-xl-6 image-wrapper">
                <img class="img-fluid" src="<?php echo wp_get_attachment_url( $instance['section_image'], 'full'); ?>" alt="Image">
            </div>
            <div class="col-12">
                <p class="scroll-down"><i class="fa fa-3x fa-angle-down" aria-hidden="true"></i></p>
            </div>
        </div>
    </div>
</section>