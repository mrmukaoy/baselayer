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
			<div class="site-info">
				<?php // hard-coded footer text should go here
				$year = date('Y');

				echo '<p>&copy;' . $year . ' ' . get_bloginfo('name');
				?>

			</div><!-- .site-info -->
		</footer><!-- #colophon -->
	</div><!-- .site-footer-wrap -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
