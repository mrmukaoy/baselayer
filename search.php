<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Yo_Base_Layer
 */

get_header();
?>

	<main id="primary" class="site-main">

			<?php if ( have_posts() ) { ?>

				<header class="page-header">
					<h1 class="page-title">
						<?php
						/* translators: %s: search query. */
						printf( esc_html__( 'Search Results for: %s', 'baselayer' ), '<span>' . get_search_query() . '</span>' );
						?>
					</h1>
				</header><!-- .page-header -->

				<section class="meat-potatoes">
				<?php
				/* Start the Loop */
				while ( have_posts() ) {
					the_post();

					/**
					 * Run the loop for the search to output the results.
					 * If you want to overload this in a child theme then include a file
					 * called content-search.php and that will be used instead.
					 */
					get_template_part( 'template-parts/content', 'search' );

					echo '</section><!-- .meat-potatoes -->';

				} //endwhile;

				the_posts_navigation();

			} else {

				get_template_part( 'template-parts/content', 'none' );

				echo '</section><!-- .meat-potatoes -->';

			} //endif;
			?>

		<?php get_sidebar(); ?>

	</main><!-- #main -->

<?php
get_footer();
