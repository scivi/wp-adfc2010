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
								<div class="blockLink singleArrow nav-previous"><?php next_posts_link('<span class="meta-nav">&larr;</span> &Auml;ltere Beitr&auml;ge', ''); ?></div>
								<div class="blockLink singleArrow nav-next"><?php previous_posts_link('Neuere Beitr&auml;ge <span class="meta-nav">&rarr;</span>'); ?></div>
								<p>(Seite <?php $page = get_query_var('paged'); echo ($page == 0) ? 1 : $page; ?> von <?php echo $wp_query->max_num_pages; ?>)</p>
							</div>
						</div>
<?php endif; ?>
<?php global $categories, $tags, $editlink; ?>
						<div class="teaserBox noPrint">
							<h2>Verwandte Themen</h2>
							<div class="content noMargin">
								<?php foreach($categories as $cat) {
									echo '<a class="blockLink singleArrow" href="' . get_category_link($cat->cat_ID) . "\">$cat->cat_name</a>";
								}; ?>
							</div>
						</div>
<?php if ( $tags ) : ?>
						<div class="teaserBox noPrint">
							<h2>Stichworte</h2>
							<div class="content noMargin">
								<?php foreach($tags as $tag) {
									echo '<a class="blockLink singleArrow" href="' . get_tag_link($tag->term_ID) . "\">$tag->name</a>";
								}; ?>
							</div>
						</div>
<?php endif; ?>
<?php if ( $editlink ) : ?>
						<div class="teaserBox noPrint">
							<h2>Admin</h2>
							<div class="content noMargin">
								 <span class="blockLink singleArrow edit-link">'<?php echo $editlink; ?></span>
							</div>
						</div>
<?php endif; ?>
					</div>
					<div class="clearer"></div>
				</div>
			</div>
			<div class="clearer"></div>	
<?php get_footer(); ?>
