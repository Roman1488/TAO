<section class="section pink border" id="<?php echo $instance['section_name']?>">
    <div class="section-content">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-6 offset-lg-0 col-xl-6 images-wrap">
                <div class="images">
                    <img class="img-fluid" src="<?php echo wp_get_attachment_url( $instance['image'], 'full'); ?>" alt="Image">
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-6 offset-lg-0 col-xl-5 offset-xl-1 text-wrapper text--pink">
                <h2 class="title"><?php echo $instance['title']; ?></h2>
                <div class="the_content">
                    <?php echo $instance['text']; ?>
                </div>
            </div>
        </div>
    </div>
</section>