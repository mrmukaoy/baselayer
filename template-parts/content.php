<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Yo_Base_Layer
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php yo_baselayerpost_thumbnail(); ?>

	<header class="entry-header">
		<?php
		if ( is_singular() ) {
			the_title( '<h1 class="entry-title">', '</h1>' );
		} else {
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		} //endif;

		if ( 'post' === get_post_type() ) {
			?>
			<div class="entry-meta">
				<?php
				yo_baselayerposted_on();
				yo_baselayerposted_by();
				?>
			</div><!-- .entry-meta -->
		<?php } //endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
		if ( 1 == get_option( 'rss_use_excerpt' ) && ( is_home() || is_archive() ) ) {
			$excerpt = get_the_excerpt();
			echo $excerpt;
		} else {
			the_content(
				sprintf( wp_kses( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'baselayer' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				), wp_kses_post( get_the_title() ) )
			);

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'baselayer' ),
					'after'  => '</div>',
				)
			);
		}
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php yo_baselayerentry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
