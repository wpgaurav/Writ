<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package writ
 */

?>
<?php global $first_post; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemtype="https://schema.org/CreativeWork" itemscope>
<div class="entry-meta">
			<?php writ_posted_on(); ?>
		</div><!-- .entry-meta -->
	<div class="entry-content">
		<?php the_content(''); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'writ' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php
		if ( $first_post == false ) { ?>
			<footer class="entry-footer">
				<?php writ_entry_footer(); ?>
			</footer><!-- .entry-footer -->
		<?php } else { 
			echo writ_modify_read_more_link();
		}
?>
</article><!-- #post-## -->
