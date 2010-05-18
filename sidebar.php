			<div class="leftCol noPrint">
				<div id="primary" class="widget-area">
					<ul class="xoxo navigation">
<?php if ( ! dynamic_sidebar( 'primary-widget-area' ) ) : // begin default primary widget area ?>
					<li id="search" class="widget-container widget_search">
						<?php get_search_form(); ?>
					</li>
					<li id="archives" class="widget-container">
						<h3 class="widget-title"><?php _e( 'Archives', 'twentyten' ); ?></h3>
						<ul>
							<?php wp_get_archives( 'type=monthly' ); ?>
						</ul>
					</li>

					<li id="meta" class="widget-container">
						<h3 class="widget-title"><?php _e( 'Meta', 'twentyten' ); ?></h3>
						<ul>
							<?php wp_register(); ?>
							<li><?php wp_loginout(); ?></li>
							<?php wp_meta(); ?>
						</ul>
					</li>
<?php endif; // end default primary widget area ?>
<?php if (is_category('termin')) : ?>
					<?php // ec3_calendar() ?>
<?php endif; ?>
					</ul>
				</div>
			</div>