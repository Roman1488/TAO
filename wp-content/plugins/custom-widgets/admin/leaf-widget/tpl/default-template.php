<section class="section leaf border" id="<?php echo $instance['section_name']?>">
    <div class="section-content">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-6 offset-lg-0 col-xl-6 head-text-wrapper">
                <h2 class="title">
                    <?php echo $instance['head_title'];?>
                </h2>
                <h3 class="subtitle">
                    <?php echo $instance['head_subtitle'];?>
                </h3>
                <div class="the_content">
                    <?php echo $instance['head_text']; ?>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-6 offset-lg-0 col-xl-6 video-wrapper">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="<?php echo $instance['video_url']; ?>?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
        <div class="row bottom-wrap">
            <div class="col-12 col-sm-12 col-md-12 col-lg-6 offset-lg-0 col-xl-6 images-wrapper">
                <div class="images">
                    <img class="img-fluid" src="<?php echo wp_get_attachment_url( $instance['image'], 'full'); ?>" alt="image">
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-6 offset-lg-0 col-xl-6 text-wrapper text--olive">
                <h2 class="title bottom-title"><?php echo $instance['bottom_title'];?></h2>
                <h3 class="subtitle"><?php echo $instance['bottom_subtitle'];?></h3>
                <div class="the_content">
                    <?php echo $instance['bottom_text']; ?>
                </div>
            </div>
            <div class="col-12">
                <p class="scroll-down"><i class="fa fa-3x fa-angle-down" aria-hidden="true"></i></p>
            </div>
        </div>
    </div>
</section>