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
<?php get_template_part( 'loop', 'index' ); ?>
						<div class="bottomLinks">
							<div class="leftCol"><p><a href="javascript:history.back();" class="arrowLeft" title="Springt zur vorherigen Seite zurück">zur&uuml;ck</a></p></div>
							<div class="middleCol"><p><a href="javascript:window.print()" class="iconPrint" title="Öffnet den Druckdialog des Browsers und druckt die aktuelle Seite ohne Kopfzeile und Navigation">Seite drucken</a></p></div>
							<div class="rightCol"><p><a href="#" class="arrowTop" title="Springt zum Seitenanfang zurück">nach oben</a></p></div>
							<div class="clearer"></div>
						</div>
						<div class="printFooter"><p>&copy; ADFC Sachsen-Anhalt e.V. <?php echo date('Y'); ?></p></div>
					</div>
					<div class="rightCol">
<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if ( $wp_query->max_num_pages > 1 ) : ?>
						<div class="teaserBox noPrint">
						<h2>Weitere Inhalte</h2>
							<div id="nav-timeline-right" class="content noMargin">
								<div class="nav-previous"><?php next_posts_link('<span class="meta-nav">&larr;</span> &Auml;ltere Beitr&auml;ge'); ?></div>
								<div class="nav-next"><?php previous_posts_link('Neuere Beitr&auml;ge <span class="meta-nav">&rarr;</span>'); ?></div>
							</div>
						</div>
<?php endif; ?>
					<div class="teaserBox noPrint">
						<h2>Verwandte Themen</h2>
						<div class="content noMargin">
							<?php echo $categories; ?>
						</div>
					</div>
					<div class="teaserBox noPrint">
						<h2>Stichworte</h2>
						<div class="content noMargin">
							<?php echo $tags; ?>
						</div>
					</div>
<?php if ( $editlink ) : ?>
					<div class="teaserBox noPrint">
						<h2>Admin</h2>
						<div class="content noMargin">
							<?php echo $editlink; ?>
						</div>
					</div>
<?php endif; ?>
					<div class="clearer"></div>
				</div>
			</div>
			<div class="clearer"></div>	
<?php get_footer(); ?>
