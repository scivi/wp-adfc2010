<?php
/**
 * The loop that displays posts
 *
 * The loop displays the posts and the post content.  See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * @package WordPress
 * @subpackage Twenty Ten
 * @since 3.0.0
 */
?>

<?php /* If there are no posts to display, such as an empty archive page */ ?>
<?php if ( ! have_posts() ) : ?>
	<div id="post-0" class="post error404 not-found">
		<h1 class="entry-title"><?php _e( 'Not Found', 'twentyten' ); ?></h1>
		<div class="entry-content">
			<p><?php _e( 'Apologies, but no results were found for the requested Archive. Perhaps searching will help find a related post.', 'twentyten' ); ?></p>
			<?php get_search_form(); ?>
		</div><!-- .entry-content -->
	</div><!-- #post-0 -->
<?php endif; ?>

<?php /* Start the Loop */ ?>
<?php while ( have_posts() ) : the_post(); ?>

<?php /* How to display posts in the Gallery Category -- TODO */ ?>
	<?php if ( in_category( _x('gallery', 'gallery category slug', 'twentyten') ) ) : ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

			<div class="entry-meta">
				<?php
					printf( __( '<span class="meta-prep meta-prep-author">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a> <span class="meta-sep"> by </span> <span class="author vcard"><a class="url fn n" href="%4$s" title="%5$s">%6$s</a></span>', 'twentyten' ),
						get_permalink(),
						esc_attr( get_the_time() ),
						get_the_date(),
						get_author_posts_url( get_the_author_meta( 'ID' ) ),
						sprintf( esc_attr__( 'View all posts by %s', 'twentyten' ), get_the_author() ),
						get_the_author()
					);
				?>
			</div>

			<div class="content">
				<div class="gallery-thumb">
					<a class="size-thumbnail" href="<?php the_permalink(); ?>"><?php
					$images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999 ) );
					$total_images = count( $images );
					$image = array_shift( $images );
					echo wp_get_attachment_image( $image->ID, 'thumbnail' );
					?></a>
				</div>
				<p><em><?php printf( __( 'This gallery contains <a %1$s>%2$s photos</a>.', 'twentyten' ),
						'href="' . get_permalink() . '" title="' . sprintf( esc_attr__( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ) . '" rel="bookmark"',
						$total_images
					); ?></em></p>

				<?php the_excerpt( '' ); ?>
			</div>

			<div class="entry-utility">
				<?php
					$category_id = get_cat_ID( 'Gallery' );
					$category_link = get_category_link( $category_id );
				?>
				<a href="<?php echo $category_link; ?>" title="<?php esc_attr_e( 'View posts in the Gallery category', 'twentyten' ); ?>"><?php _e( 'More Galleries', 'twentyten' ); ?></a>
				<span class="meta-sep"> | </span>
				<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'twentyten' ), __( '1 Comment', 'twentyten' ), __( '% Comments', 'twentyten' ) ); ?></span>
				<?php edit_post_link( __( 'Edit', 'twentyten' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
			</div>
		</div>

<?php /* How to display posts in the teaserbox category */ ?>
	<?php elseif (in_category('teaserbox')) : ?>
		<div class="teaserBox teaserBoxGrey teaserBoxOffer">
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( is_archive() || is_search() ) : // Only display Excerpts for archives & search ?>
				<div class="rubricList">
					<?php the_excerpt('Weiterlesen <span class="meta-nav">&rarr;</span>'); ?>
				</div>
	<?php else : ?>
				<div class="content">
					<?php the_content('Weiterlesen <span class="meta-nav">&rarr;</span>'); ?>
				</div>
	<?php endif; ?>
				<div class="entry-meta">
					<?php
						printf('<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>. <span class="meta-sep"> Von </span> <span class="author vcard"><a class="url fn n" href="%4$s" title="%5$s">%6$s</a></span>',
							get_permalink(),
							esc_attr( get_the_time() ),
							get_the_date(),
							get_author_posts_url( get_the_author_meta( 'ID' ) ),
							sprintf( esc_attr__('Alle Beiträge von %s zeigen', 'twentyten'), get_the_author()),
							get_the_author()
						);
					?>
					<span class="meta-sep"> | </span>
					<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'twentyten' ), __( '1 Comment', 'twentyten' ), __( '% Comments', 'twentyten' ) ); ?></span>
					<?php edit_post_link( __( 'Edit', 'twentyten' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
				</div>
			</div><!-- #post-<?php the_ID(); ?> -->
		</div><!-- teaserbox -->

<?php /* How to display all other posts */ ?>
	<?php else : ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<h1><a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Permalink zu %s', 'twentyten'), the_title_attribute('echo=0')); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

			<div class="entry-meta">
				<?php
					printf('<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>. <span class="meta-sep"> Von </span> <span class="author vcard"><a class="url fn n" href="%4$s" title="%5$s">%6$s</a></span>',
						get_permalink(),
						esc_attr( get_the_time() ),
						get_the_date(),
						get_author_posts_url(get_the_author_meta('ID')),
						sprintf( esc_attr__('Alle Beiträge von %s zeigen', 'twentyten'), get_the_author()),
						get_the_author()
					);
				?>
			</div>

	<?php if ( is_archive() || is_search() ) : // Only display Excerpts for archives & search ?>
			<div class="rubricList">
				<?php the_excerpt('Weiterlesen <span class="meta-nav">&rarr;</span>'); ?>
			</div>
	<?php else : ?>
			<div class="content">
				<?php the_content('Weiterlesen <span class="meta-nav">&rarr;</span>'); ?>
				<?php wp_link_pages(array('before' => '<div class="page-link">Seiten:', 'after' => '</div>')); ?>
			</div>
	<?php endif; ?>
	<?php // for the right sidebar; comes after the loop
		//$categories = get_category(', ');
		//$tags = get_tags('', ', ', '<br/>');
		//$editlink = get_edit_post_link('Bearbeiten', '<span class="edit-link">', '</span>' );
	?>

			<div class="entry-utility">
				<span class="cat-links"><?php the_category( ', ' ); ?></span>
				<?php the_tags('<span class="tag-links"><span class="entry-utility-prep entry-utility-prep-tag-links">Stichworte </span>', ', ', '<span class="meta-sep"> | </span>'); ?>
				<?php // <span class="comments-link">
				      // comments_popup_link( __( 'Leave a comment', 'twentyten' ), __( '1 Comment', 'twentyten' ), __( '% Comments', 'twentyten' ) ); 
				      //</span>
				?>
				<?php edit_post_link('Bearbeiten', '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
			</div>
		</div><!-- #post-<?php the_ID(); ?> -->

		<?php // comments_template( '', true ); 
		?>

	<?php endif; // if different categories queried ?>
<?php endwhile; ?>
