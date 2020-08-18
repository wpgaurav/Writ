<?php
/**
 * Writ functions and definitions.
 *
 * @package writ
 */

if ( ! function_exists( 'writ_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function writ_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on writ, use a find and replace
	 * to change 'writ' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'writ', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Add new image sizes and theme support for Custom Logo
	 */
	 add_theme_support( 'custom-logo', array(
        'height'      => 96,
        'width'       => 96,
        'flex-height' => false,
        'flex-width'  => false,
 	) );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 828, 360, true );
	add_theme_support( 'custom-header' );

	// This theme uses wp_nav_menu() in three locations.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'writ' ),
		'secondary' => esc_html__( 'Secondary Menu', 'writ' ),
		'footer' => esc_html__('Footer Menu', 'writ')
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	/*
	 * TinyMCE Fallback styles
	 */
	add_editor_style( array( 'inc/editor-style.css', '/icons/style.css' ) );
	/*
	* Gutenberg Styles
	*/ 
	add_action(
	'enqueue_block_editor_assets',
	function () {
		$theme = wp_get_theme();

		wp_enqueue_style(
			'gt-main-editor-styles',
			get_stylesheet_directory_uri() . '/inc/editor-style.css',
			[],
			$theme->get( 'Version' )
		);
		wp_enqueue_style(
			'writ-icons',
			get_stylesheet_directory_uri() . '/icons/style.css', [],
			$theme-> get('Version')
		);
	}
);
}
endif; // writ_setup
add_action( 'after_setup_theme', 'writ_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function writ_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'writ_content_width', 702 );
}
add_action( 'after_setup_theme', 'writ_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function writ_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Primary Sidebar', 'writ' ),
		'description'   => __('In no-sidebar mode these will work as footer widgets, otherwise as Right or Left Sidebars. Go to customizer to setup.', 'writ'),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Copyright Widget', 'writ' ),
		'description'   => __('Remove credits to one of your own. Use shortcodes, social media icons or anything.', 'writ'),
		'id'            => 'sidebar-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Extra Footer Widgets', 'writ' ),
		'description'   => __('Extra column of footer widgets', 'writ'),
		'id'            => 'sidebar-3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'writ_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function writ_scripts() {
	wp_enqueue_style( 'writ-style', get_stylesheet_uri() );

	// Icon font
	wp_enqueue_style( 'writ-icons', get_template_directory_uri() . '/icons/style.css' );

	wp_enqueue_script( 'writ-functions', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20150916', true );

	wp_enqueue_script( 'writ-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_localize_script( 'writ-functions', 'screenReaderText', array(
		'expand'   => '<span class="screen-reader-text">' . __( 'expand child menu', 'writ' ) . '</span>',
		'collapse' => '<span class="screen-reader-text">' . __( 'collapse child menu', 'writ' ) . '</span>',
	) );
}
add_action( 'wp_enqueue_scripts', 'writ_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load custom widgets
 */

require get_template_directory() . "/widgets/recent-comments.php";
require get_template_directory() . "/widgets/recent-posts.php";
