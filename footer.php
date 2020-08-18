<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package writ
 */

?>

	</div><!-- #content -->
	<div class="no-sidebar">
<div id="secondary" class="widget-area clear" role="complementary" >
	<?php dynamic_sidebar( 'sidebar-3' ); ?>
</div><!-- #footer-widgets -->
</div>

	<footer id="colophon" class="site-footer" role="contentinfo" itemtype="https://schema.org/WPFooter" itemscope>
		<div class="site-info">
		    <?php if ( is_active_sidebar( 'sidebar-2' ) ) {
		    dynamic_sidebar( 'sidebar-2' ); }
else { ?>
			<?php printf( esc_html__( 'Theme: %1$s', 'writ' ), '<a href="https://wordpress.org/themes/writ/" target="_none"	rel="nofollow noopener">Writ</a>' ); ?><a href="<?php echo esc_url( __( 'https://gauravtiwari.org/', 'writ' ) ); ?>"><?php printf( esc_html__( ' by %s', 'writ' ), 'Gaurav Tiwari' ); ?></a>
			
			<?php } ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
	<?php if ( has_nav_menu( 'footer' ) ) : ?>
			<nav id="site-navigation" class="main-navigation" role="navigation" itemtype="https://schema.org/SiteNavigationElement" itemscope>
				<?php wp_nav_menu( array( 'theme_location' => 'footer', 'menu_id' => 'footer-menu', 'menu_class' => 'nav-menu' ) ); ?>
			</nav><!-- #site-navigation -->
		<?php endif; ?>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
