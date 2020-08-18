<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package writ
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> itemtype="https://schema.org/WebPage" itemscope>
<?php wp_body_open(); ?>
<div id="page" class="hfeed site <?php echo get_theme_mod( 'layout_setting', 'no-sidebar' ); ?>">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'writ' ); ?></a>

	<?php
		if ( get_header_image() ) { ?>
			<header id="masthead" class="site-header header-background-image" style="background-image: url(<?php echo get_header_image(); ?>) " role="banner" itemtype="https://schema.org/WPHeader" itemscope>
		<?php } else { ?>
			<header id="masthead" class="site-header" role="banner" itemtype="https://schema.org/WPHeader" itemscope>
		<?php }
		?>

		<div class="site-logo">
			<?php $site_title = get_bloginfo( 'name' ); ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<div class="screen-reader-text">
					<?php printf( esc_html__('Go to the home page of %1$s', 'writ'), $site_title ); ?>
				</div>
				<?php
					// Display logo if Custom Logo or Site Icon is defined, otherwise display First Letter
					if ( writ_custom_logo() ) {
						echo writ_custom_logo();
					} else { ?>
						<div class="site-firstletter" aria-hidden="true">
							<?php echo substr($site_title, 0, 1); ?>
						</div>
				<?php } ?>
			</a>
		</div>


		<?php if ( has_nav_menu( 'primary' ) ) : ?>
			<nav id="site-navigation" class="main-navigation" role="navigation">
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false" itemtype="https://schema.org/SiteNavigationElement" itemscope><?php esc_html_e( 'Menu', 'writ' ); ?></button>
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu', 'menu_class' => 'nav-menu' ) ); ?>
			</nav><!-- #site-navigation -->
		<?php endif; ?>
		<div class="site-branding<?php if ( !is_front_page() && is_singular() ) { echo ' screen-reader-text'; } ?>">
			<?php if ( is_front_page() && is_home() ) : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php else : ?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php endif; ?>
			<?php
			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) : ?>
				<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
			<?php endif; ?>
		</div><!-- .site-branding -->
		<header class="entry-header">
		<?php if ( !(is_front_page() && is_home() )) {
				the_title( '<h1 class="entry-title">', '</h1>' ); }
		?>

		<?php
		if ( has_excerpt( $post->ID ) ) {
			echo '<div class="deck">';
			echo '<p>' . get_the_excerpt() . '</p>';
			echo '</div><!-- .deck -->';
		}
		?>

	</header><!-- .entry-header -->
		<?php if ( has_nav_menu( 'secondary' ) ) : ?>
			<nav id="site-navigation" class="main-navigation" role="navigation" itemtype="https://schema.org/SiteNavigationElement" itemscope>
				<?php wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_id' => 'secondary-menu', 'menu_class' => 'nav-menu' ) ); ?>
			</nav><!-- #site-navigation -->
		<?php endif; ?>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
