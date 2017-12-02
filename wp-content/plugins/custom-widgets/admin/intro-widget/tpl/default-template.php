<section class="section head" style="background-image: url(<?php echo wp_get_attachment_url( $instance['bg_image'], 'full'); ?>)" id="<?php echo $instance['section_name']?>">
    <div class="section_header">
        <h2 class="title"><?php echo $instance['before_title']?></h2>
    </div>
    <div class="section_bottom">
        <h2 class="title text--red"><?php echo $instance['title']?></h2>
        <h3 class="subtitle text--aqua"><?php echo $instance['after_title']?></h3>
        <div class="quote"><?php echo nl2br($instance['quote']);?></div>
        <p class="scroll-down"><i class="fa fa-4x fa-angle-down" aria-hidden="true"></i></p>
    </div>
</section>