<?php
/**
 * Template Name: Gallery page template
 */
?>
<?php get_header(); ?>
<?php
while ( have_posts() ) : the_post(); ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="gallery-wrapper">
                <h1 class="title"><?php echo get_the_title(); ?></h1>
                <?php the_content(); ?>
            </div>
        </div>
    </div>
<?php endwhile; ?>
<?php get_footer(); ?>

