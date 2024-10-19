<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Yo_Base_Layer
 */

?>

	<div class="site-footer-wrap">
		<footer id="colophon" class="site-footer">
			<?php // count number of active sidebars
			$col = 0;
			if ( is_active_sidebar( 'footer-1' ) ) { $col++; }
			if ( is_active_sidebar( 'footer-2' ) ) { $col++; }
			if ( is_active_sidebar( 'footer-3' ) ) { $col++; }
			$columns = 'col-' . $col;

			if ( 0 < $col ) {

				echo '<section class="footer-widget-container ' . $columns . '">';

				if ( is_active_sidebar( 'footer-1' ) ) {
					echo '<div id="footer-1" class="widget-area footer-1"><div class="widget-wrapper">';
					dynamic_sidebar( 'footer-1' );
					echo '</div></div><!-- #footer-1 -->';
				}

				if ( is_active_sidebar( 'footer-2' ) ) {
					echo '<div id="footer-2" class="widget-area footer-2"><div class="widget-wrapper">';
					dynamic_sidebar( 'footer-2' );
					echo '</div></div><!-- #footer-2 -->';
				}

				if ( is_active_sidebar( 'footer-3' ) ) {
					echo '<div id="footer-3" class="widget-area footer-3"><div class="widget-wrapper">';
					dynamic_sidebar( 'footer-3' );
					echo '</div></div><!-- #footer-3 -->';
				}

				echo '</section>';

			}
			?>

			<div class="site-info">
				<?php // hard-coded footer text should go here
				/*
				$year = date('Y');

				echo '<p>&copy;' . $year . ' ' . get_bloginfo('name');
				*/
				?>
			</div><!-- .site-info -->
		</footer><!-- #colophon -->
	</div><!-- .site-footer-wrap -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
