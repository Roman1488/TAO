<?php
/**
 * The header for theme
 *
 * This is the template that displays all of the <head>
 *
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php bloginfo('name'); ?> <?php wp_title("", true); ?></title>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div class="mobileMenuWrap">
    <i class="fa fa-2x fa-times closeMobileMenu" aria-hidden="true"></i>
    <nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Top Menu', 'polynovepole' ); ?>">
        <?php wp_nav_menu( array(
            'theme_location' => 'top',
            'menu_id'        => 'main-menu'
        ) ); ?>
    </nav>
</div>
<div class="page-container">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <header class="header">
                <a class="header__title" href="<?php echo get_home_url(); ?>"><img src="<?php echo get_template_directory_uri()?>/img/logo.svg" alt=""></a>
                <div class="menu-wrap" id="open-menu">
                    <span class="menu-wrap__label">Menu</span>
                    <i class="open-overlay menu-icon" aria-hidden="true"></i>
                </div>
                </header>
            </div>
        </div>
    </div>


