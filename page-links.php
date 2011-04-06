<?php get_header(); ?>
<?php get_sidebar(); ?>
			<div class="rightCol printRightCol">
				<div class="metaNav"><?php wp_nav_menu( array( 'sort_column' => 'menu_order' /*, 'container_class' => 'metaNav' */) ); ?></div>
				<div class="breadcrumb"><p class="noMargin">
<?php if ( is_home() || is_front_page() ) { ?>
					<strong>Aktuelles vom ADFC Sachsen-Anhalt e.V.</strong>
<?php } else { if(function_exists('bcn_display')) { bcn_display(); } } ?>
				</p></div>
				<div class="content">
					<div class="leftCol">
					<!-- links -->
						<h1>Linksammlung rund um's Radfahren</h1>
<?php
	wp_list_bookmarks(array(
		'show_description'	=> true,
		'show_name'			=> true,
		'show_images'		=> false,
		'category_before'	=> '<div class="newsDetail" id="link-%id;"><ul>',
		'title_before'		=> '<h3>',
		'between'			=> '<br/>',
 		'title_after'		=> '</h3>',
		'category_after'	=> '</ul></div>'
	));
?>
						<div class="bottomLinks">
							<div class="leftCol"><p><a href="javascript:history.back();" class="arrowLeft" title="Springt zur vorherigen Seite zurück">zur&uuml;ck</a></p></div>
							<div class="middleCol"><p><a href="javascript:window.print()" class="iconPrint" title="Öffnet den Druckdialog des Browsers und druckt die aktuelle Seite ohne Kopfzeile und Navigation">Seite drucken</a></p></div>
							<div class="rightCol"><p><a href="#" class="arrowTop" title="Springt zum Seitenanfang zurück">nach oben</a></p></div>
							<div class="clearer"></div>
						</div>
						<div class="printFooter"><p>&copy; ADFC Sachsen-Anhalt e.V. <?php echo date('Y'); ?></p></div>
					</div>
					<div class="rightCol">
					</div>
					<div class="clearer"></div>
				</div>
			</div>
			<div class="clearer"></div>	
<?php get_footer(); ?>
