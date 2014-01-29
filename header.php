<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package sfu_theme
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html id="ie7" class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html id="ie8" class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><html class="no-js" <?php language_attributes(); ?>> <![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php // Checking user agent to apply font aliasing for windows
if (strpos($_SERVER['HTTP_USER_AGENT'], "Windows", 0) !== FALSE) { ?>
    <link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri() . '/css/windows-aliasing.css'; ?>" />
<?php } ?>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div class="contain-to-grid fixed hide-for-medium-up">
    <nav class="top-bar" data-topbar>
        <ul class="title-area">
            <li class="name">
                <h1>
                    <a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a>
                </h1>
            </li>
            <?php if( has_nav_menu( 'primary' ) ){ ?>
                <li class="toggle-topbar menu-icon">
                    <a href="#">
                        <span><?php _e('Menu', 'sfu_theme'); ?></span>
                    </a>
                </li>
            <?php } ?>
        </ul>
        <section class="top-bar-section">
            <?php foundation_top_bar(); ?>
        </section>
    </nav>
</div>
    
<div id="page" class="hfeed site row">
	<?php do_action( 'before' ); ?>
	<header id="masthead" class="site-header small-12 columns show-for-medium-up" role="banner">
		<div class="site-branding">
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
		</div>

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<h1 class="menu-toggle"><?php _e( 'Menu', 'sfu_theme' ); ?></h1>
			<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'sfu_theme' ); ?></a>

			<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content small-12 columns">
