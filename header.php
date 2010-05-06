<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage ADFC-Layout
 * @since 3.0.0
 */
?>
<!DOCTYPE html
     PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
     "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de-DE" lang="de-DE">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<title><?php
	// Returns the title based on the type of page being viewed
		if ( is_single() ) {
			single_post_title(); echo ' | '; bloginfo( 'name' );
		} elseif ( is_home() || is_front_page() ) {
			bloginfo( 'name' ); 
			if( get_bloginfo( 'description' ) ) 
				echo ' | ' ; bloginfo( 'description' ); 
			adfc2010_the_page_number();
		} elseif ( is_page() ) {
			single_post_title( '' ); echo ' | '; bloginfo( 'name' );
		} elseif ( is_search() ) {
			printf( __( 'Search results for "%s"', 'adfc2010' ), get_search_query() ); adfc2010_the_page_number(); echo ' | '; bloginfo( 'name' );
		} elseif ( is_404() ) {
			_e( 'Not Found', 'adfc2010' ); echo ' | '; bloginfo( 'name' );
		} else {
			wp_title( '' ); echo ' | '; bloginfo( 'name' ); adfc2010_the_page_number();
		}
	?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	<!--[if IE 6]>
		<style media="all" type="text/css">@import url(<?php bloginfo('template_directory') ?>/css/stylesheet_master_ie6.css);</style>
	<![endif]-->
	<!--[if IE 7]>
		<style media="all" type="text/css">@import url(<?php bloginfo('template_directory') ?>/css/stylesheet_master_ie7.css);</style>
	<![endif]-->
	<link media="print" rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory') ?>/css/stylesheet_print.css" />
	<?php if ( is_singular() && get_option('thread_comments') ) wp_enqueue_script( 'comment-reply' ); ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<link rel="shortcut icon" href="<?php bloginfo('template_directory') ?>/gfx/favicon.ico" type="image/vnd.microsoft.icon">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="wrapper" class="hfeed nonFooter">
	<div class="adsTop"></div>
	<div class="master">
		<div class="head noPrint">
			<div class="headStripe "></div>
			<div class="cLogo">
				<a href="<?php echo home_url( '/' ); ?>" title="Ein Klick auf das ADFC Logo führt zurück zur Startseite">
					<img src="<?php bloginfo('template_directory') ?>/gfx/logo_adfc.gif" alt="ADFC Allgemeiner Deutscher Fahrrad-Club e. V." class="noPrint" />
				</a>
				<div class="cLogoSubline"><p><strong><?php bloginfo( 'description' ); ?></strong></p></div>
			</div>
			<div class="headPic noPrint">
				<?php if(function_exists('show_media_header')){ show_media_header(); } else { ?>
				<img src="<?php bloginfo('template_directory') ?>/gfx/muster_headpic_liegende_menschen.jpg" alt="" />
				<?php } ?>
			</div>
			<div class="clearer"></div>
		</div>
		<div class="printLogo"><img src="<?php bloginfo('template_directory') ?>/gfx/logo_adfc_print.gif" alt="ADFC Allgemeiner Deutscher Fahrrad-Club Sachsen-Anhalt e. V."/></div>
		<div class="main">
