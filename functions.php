<?php
/**
 * ADFC TwentyTen functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * The first function, adfc2010_setup(), sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails, navigation menus, and the like.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development), you can
 * override certain functions (those wrapped in a function_exists() call) by defining
 * them first in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme functions would
 * be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 *
 * We can remove the parent theme's hook only after it is attached, which means we need to
 * wait until setting up the child theme:
 *
 * <code>
 * add_action( 'after_setup_theme', 'my_child_theme_setup' );
 * function my_child_theme_setup() {
 *     // We are providing our own filter for excerpt_length (or using the unfiltered value)
 *     remove_filter( 'excerpt_length', 'adfc2010_excerpt_length' );
 *     ...
 * }
 * </code>
 *
 * For more information on hooks, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage ADFC Twenty Ten
 * @since 3.0.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * Used to set the width of images and content. Should be equal to the width the theme
 * is designed for, generally via the style.css stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 980;

/** Tell WordPress to run adfc2010_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'adfc2010_setup' );

if ( ! function_exists('adfc2010_setup') ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override adfc2010_setup() in a child theme, add your own adfc2010_setup to your child theme's
 * functions.php file.
 *
 * @uses add_theme_support() To add support for post thumbnails, navigation menus, and automatic feed links.
 * @uses add_custom_background() To add support for a custom background.
 * @uses add_editor_style() To style the visual editor.
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_custom_image_header() To add support for a custom header.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since 3.0.0
 */
function adfc2010_setup() {

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu()
	add_theme_support( 'nav-menus' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	//load_theme_textdomain( 'adfc2010', TEMPLATEPATH . '/languages' );
	load_theme_textdomain( 'twentyten', TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	// This theme allows users to set a custom background
	add_custom_background();
}
endif;

if ( ! function_exists( 'adfc2010_the_page_number' ) ) :
/**
 * Prints the page number currently being browsed, with a vertical bar before it.
 *
 * Used in Twenty Ten's header.php to add the page number to the <title> HTML tag.
 *
 * @since 3.0.0
 */
function adfc2010_the_page_number() {
	global $paged; // Contains page number.
	if ( $paged >= 2 )
		echo ' | ' . sprintf('Seite %s', $paged);
}
endif;

/**
 * Sets the post excerpt length to 40 characters.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 *
 * @return int
 */
function adfc2010_excerpt_length( $length ) {
	return 42;
}
add_filter( 'excerpt_length', 'adfc2010_excerpt_length' );

/**
 * Sets the "read more" link to something pretty.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 *
 * @since 3.0.0
 * @return string A pretty 'Continue reading' link.
 */
function adfc2010_excerpt_more( $more ) {
	return ' &hellip; <a href="'. get_permalink() . '">Weiterlesen <span class="meta-nav">&rarr;</span></a>';
}
add_filter( 'excerpt_more', 'adfc2010_excerpt_more' );

/**
 * Remove inline styles printed when the gallery shortcode is used.
 *
 * Galleries are styled by the theme in Twenty Ten's style.css.
 *
 * @return string The gallery style filter, with the styles themselves removed.
 */
function adfc2010_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
add_filter( 'gallery_style', 'adfc2010_remove_gallery_css' );

if ( ! function_exists( 'adfc2010_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own adfc2010_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since 3.0.0
 */
function adfc2010_comment( $comment, $args, $depth ) {
	$GLOBALS ['comment'] = $comment; ?>
	<?php if ( '' == $comment->comment_type ) : ?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard">
			<?php echo get_avatar( $comment, 40 ); ?>
			<?php printf('<cite class="fn">%s</cite> <span class="says">kommentiert:</span>', get_comment_author_link()); ?>
		</div>
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em><?php _e( 'Your comment is awaiting moderation.', 'adfc2010' ); ?></em>
			<br />
		<?php endif; ?>
		<div class="comment-meta commentmetadata">
			<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><?php printf('%1$s', get_comment_date()); ?></a>
			<?php edit_comment_link('(Bearbeiten)', ' '); ?>
		</div>
		<div class="comment-body"><?php comment_text(); ?></div>
		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ))); ?>
		</div>
	</div>

	<?php else : ?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'adfc2010' ); ?> <?php comment_author_link(); ?><?php edit_comment_link ('(Bearbeiten)', ' '); ?></p>
	<?php endif;
}
endif;

/**
 * Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
 *
 * To override adfc2010_widgets_init() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 * @uses register_sidebar
 */
function adfc2010_widgets_init() {
	// Area 1
	register_sidebar( array (
		'name' => 'Erster Widget-Bereich',
		'id' => 'primary-widget-area',
		'description' => 'Der 1. Widget-Bereich, in der Sidebar oben',
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => "</li>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 2
	register_sidebar( array (
		'name' => 'Zweiter Widget-Bereich',
		'id' => 'secondary-widget-area',
		'description' => 'Der 2. Widget-Bereich, in der Sidebar unten.',
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => "</li>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 3
	register_sidebar( array (
		'name' => 'Footer Widget Area',
		'id' => 'footer-widget-area',
		'description' => 'Der Widget-Bereich im Seitenfuß',
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => "</li>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

/*
	// Area 4
	register_sidebar( array (
		'name' => __( 'Second Footer Widget Area', 'adfc2010' ),
		'id' => 'second-footer-widget-area',
		'description' => __( 'The second footer widget area', 'adfc2010' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => "</li>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
*/
}
add_action( 'init', 'adfc2010_widgets_init' );

/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 */
function adfc2010_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'adfc2010_remove_recent_comments_style' );

/**
 * Get the URL of the next image in a gallery for attachment pages
 */
function adfc2010_get_next_attachment_url() {
	global $post;
	$post = get_post($post);
	$attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );

	foreach ( $attachments as $k => $attachment ) {
		if ( $attachment->ID == $post->ID )
			break;
	}
	$k++;
	if ( isset( $attachments[ $k ] ) )
		return get_attachment_link( $attachments[ $k ]->ID );
	else
		return get_permalink( $post->post_parent );
}

// cf. http://lists.automattic.com/pipermail/wp-testers/2010-May/012932.html
function is_page_by_slug( $slug ) {
    $page = get_page_by_path( $slug );
    return ($page ? is_page( $page->ID ) : false);
}

function remember($type, $these = null) {
	static $memo = array();
	if (! is_array($memo[$type])) $memo[$type] = array();
	if (is_array($these)) $memo[$type] = array_merge($memo[$type], $these);
	return $memo[$type];
}

function uniq_objects($ary, $id_field) {
	$uniq = array();
	foreach ($ary as $obj) {
		$uniq[$obj->$id_field] = $obj;
	}
	return $uniq;
}
