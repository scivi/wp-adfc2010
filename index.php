<?php get_header(); ?>
<?php get_sidebar(); ?>
			<div class="rightCol printRightCol">
				<div class="metaNav"><?php wp_nav_menu( array( 'sort_column' => 'menu_order' /*, 'container_class' => 'metaNav' */) ); ?></div>
				<div class="breadcrumb"><p class="noMargin">
<?php if (is_home() || is_front_page()) { ?>
					<strong>Aktuelles vom ADFC Sachsen-Anhalt e.V.</strong>
<?php } elseif(function_exists('bcn_display')) { bcn_display(); } ?>
				</p></div>
				<div class="content">
					<div class="leftCol">
<?php
	// feature
	if (is_home() || is_front_page()) :
		$featuredPosts = new WP_Query();
		$featuredPosts->query('posts_per_page=1&cat=42');
		global $more;
		while ( $featuredPosts->have_posts()) : $featuredPosts->the_post(); 
			update_post_caches($posts); 
			$more = 0;
			remember('categories', get_the_category());
			remember('tags', get_the_tags());
		?>
						<div class="newsTeaser"><h1><a rel="bookmark" href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1>
							<div class="entry-meta"><?php
									printf('<span class="entry-date">%3$s</span><span class="meta-sep"> &ndash; Von </span> <span class="author vcard"><a class="url fn n" href="%4$s" title="%5$s">%6$s</a></span>',
										get_permalink(),
										esc_attr( get_the_time()),
										get_the_date(),
										get_author_posts_url(get_the_author_meta('ID')),
										sprintf( esc_attr__('Alle Beiträge von %s zeigen', 'twentyten'), get_the_author()),
										get_the_author()
									);
							?></div>
							<div <?php post_class(); ?>>
								<?php the_content('Mehr zu &raquo;' . get_the_title() . '&laquo;'); ?>
							</div>
						</div>
<?php endwhile; endif; // feature
get_template_part( 'loop', 'index' ); // all stuff
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
<?php 
	// Display navigation to next/previous pages when applicable
	global $paged;
	$has_pages = $wp_query->max_num_pages > 1;

	// sub-pages menu - TODO: show siblings, if on subpage.
	$children_for = array_shift(remember('id'));
	if (is_numeric($children_for)) { $children = wp_list_pages("title_li=&child_of=${children_for}&echo=0"); }
	else { $children = false; }

	// get extra links (custom field)
	if (is_numeric($children_for)) { $extra_links = get_post_custom_values('Weitere Inhalte - Extra Link', $children_for); }
	else { $extra_links = false; }
?>
<?php if ($has_pages || $children || $extra_links) : ?>
						<div class="teaserBox noPrint">
						<h2>Weitere Inhalte <?php if ($has_pages) { ?>(Seite <?php echo (($paged == 0) ? 1 : $paged) .'/'. $wp_query->max_num_pages .')'; } ?></h2>
						<?php if ($has_pages) : ?>
							<div id="nav-timeline-right" class="content noMargin">
							<?php if ($paged < $wp_query->max_num_pages) : ?> 
								<a class="blockLink singleArrow nav-older" href="<?php next_posts();?>">&Auml;ltere Beitr&auml;ge</a>
							<?php endif;
							if ($paged > 1) : ?>	
								<a class="blockLink singleArrow nav-younger" href="<?php previous_posts();?>">Neuere Beitr&auml;ge</a>
							<?php endif; ?>
							</div>
						<?php endif;
						if ($children) : ?>
							<div id="subpages" class="content noMargin">
								<ul><?php echo $children; ?></ul>
							</div>
						<?php endif;
						if ($extra_links) : ?>
							<div id="extralinks" class="content noMargin">
							<?php foreach ($extra_links as $link) {
								if (!$link) continue;
								$class = '';
								list($url, $title) = explode('|', $link);
								if ($title == '') { $title = preg_replace('@https?://@', '', $url); }
								if (('http' == substr($url, 0, 4)) && (!strstr('adfc-sachsen-anhalt', $url))) { $class = 'external'; }
								echo "<a class=\"blockLink singleArrow $class\" href=\"$url\">$title</a>";
							} ?>
							</div>
						<?php endif; ?>
						</div>
<?php endif; 
if ($cats = uniq_objects(remember('categories'), 'cat_ID')) : ?>
						<div class="teaserBox noPrint">
							<h2>Verwandte Themen</h2>
							<div class="content noMargin">
								<?php // print_r($cats); 
								foreach($cats as $cat) {
									$url = get_category_link($cat->cat_ID);
									if (strpos($url, '/thema/feature')) continue; // never show feature category.
									// hide redundant category
									$cur = $_SERVER['REQUEST_URI'];
									if (substr($url, 29) == $cur) continue;
									if (substr($url, 29) == substr($cur, 0, 1 + strpos($cur, '/page/'))) continue;
									echo "<a class=\"blockLink singleArrow\" href=\"$url\">$cat->cat_name</a>";
								}; ?>
							</div>
						</div>
<?php endif;
if ($tags = uniq_objects(remember('tags'), 'term_id')) : ?>
						<div class="teaserBox noPrint">
							<h2>Stichworte</h2>
							<div class="content noMargin">
								<?php foreach($tags as $tag) {
									echo '<a class="blockLink singleArro`w" href="' . get_tag_link($tag->term_id) . "\">$tag->name</a>";
								}; ?>
							</div>
						</div>
<?php endif; ?>
						<?php edit_post_link('Bearbeiten', 
							'<div class="teaserBox noPrint"><h2>Admin</h2><div class="content noMargin"><div class="blockLink singleArrow edit-link">', 
						'	</div>',
							array_shift(remember('the_id')));
						?>
								<div id="secondary" class="widget-area">
									<ul>
									<?php dynamic_sidebar('secondary-widget-area'); ?>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="clearer"></div>
				</div>
			</div>
			<div class="clearer"></div>	
<?php get_footer(); ?>
