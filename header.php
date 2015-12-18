<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width" />
    <title><?php wp_title( ' | ', true, 'right' ); ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>" />
    <?php
    wp_head();
    ?>
</head>
<body <?php body_class(); ?>>
    <div id="wrapper" class="hfeed">
        <header id="header" role="banner">
            <?php $homeUrl = esc_url( home_url( '/' )) ?>
            <a id="branding" href="<?php echo $homeUrl ?>" title="<?php esc_attr_e( get_bloginfo( 'name' ), 'blankslate' ); ?>" rel="home">
                <h2 id="site-title">
                    <?php echo esc_html( get_bloginfo( 'name' ) ); ?>
                </h2>
                <div id="site-description"><?php bloginfo( 'description' ); ?></div>
            </a>
            <nav class="secondary-nav" role="navigation">
                <?php wp_nav_menu( array( 'theme_location' => 'main-menu', 'walker' => new SecondaryNavWalker ) ); ?>
            </nav>
            <nav class="primary-nav" id="menu" role="navigation">
                <?php wp_nav_menu( array( 'theme_location' => 'main-menu', 'walker' => new Thumbnail_Walker ) ); ?>
            </nav>
        </header>
        <div id="container">