<?php
/**
 * Custom template tags for this theme
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Yo_Base_Layer
 */

if ( ! function_exists( 'yo_baselayerposted_on' ) ) {
	/** Prints HTML with meta information for the current post-date/time. */
	function yo_baselayerposted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			// translators: %s: post date.
			esc_html_x( 'Posted on %s', 'post date', 'baselayer' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
} //endif;

if ( ! function_exists( 'yo_baselayerposted_by' ) ) {
	/** Prints HTML with meta information for the current author. */
	function yo_baselayerposted_by() {
		$byline = sprintf(
			// translators: %s: post author.
			esc_html_x( 'by %s', 'post author', 'baselayer' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
} //endif;

if ( ! function_exists( 'yo_baselayerentry_footer' ) ) {
	/** Prints HTML with meta information for the categories, tags and comments. */
	function yo_baselayerentry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/*
			// translators: used between list items, there is a space after the comma
			$categories_list = get_the_category_list( esc_html__( ', ', 'baselayer' ) );
			if ( $categories_list ) {
				// translators: 1: list of categories.
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'baselayer' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
			*/

			// get categories for the post
			$the_cats = get_the_category();
			// if "uncategorized" is one of the categories, excise it from the array
			// there's gotta be a more streamlined way to do this
			if ( !empty( $the_cats ) ) {
				$i = 0;
				$flag = '';
				foreach( $the_cats as $cat ) {
					if ( 'Uncategorized' == $cat->name ) {
						$flag = $i;
						break;
					} else { $i++; }
				}
				if ( '' != $flag ) {
					unset( $the_cats[$flag] );
				}
				// print the remaining categories as links
				if ( 1 <= count($the_cats) ) {
					$i = 1;
					$categories_list = '<span class="cat-links">Posted in ';
					foreach( $the_cats as $cat ) {
						$categories_list .= '<a href="' . esc_url( get_category_link( $cat->term_id ) ) . '">' . esc_html( $cat->name ) . '</a>';
						if ( $i < count($the_cats) ) {
							$categories_list .= ', ';
						}
						$i++;
					}
					$categories_list .= '</span>';
					echo $categories_list;
				}
			}





/*

			Array ( [0] => WP_Term Object ( 
				[term_id] => 16 
				[name] => Classic 
				[slug] => classic 
				[term_group] => 0 
				[term_taxonomy_id] => 16 
				[taxonomy] => category 
				[description] => Items in the classic category have been created with the classic editor. 
				[parent] => 0 
				[count] => 23 
				[filter] => raw 
				[cat_ID] => 16 
				[category_count] => 23 
				[category_description] => Items in the classic category have been created with the classic editor. 
				[cat_name] => Classic 
				[category_nicename] => classic 
				[category_parent] => 0 
			) 
			[1] => WP_Term Object ( [term_id] => 1 [name] => Uncategorized [slug] => uncategorized [term_group] => 0 [term_taxonomy_id] => 1 [taxonomy] => category [description] => [parent] => 0 [count] => 14 [filter] => raw [cat_ID] => 1 [category_count] => 14 [category_description] => [cat_name] => Uncategorized [category_nicename] => uncategorized [category_parent] => 0 ) ) 

*/









			// translators: used between list items, there is a space after the comma
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'baselayer' ) );
			if ( $tags_list ) {
				// translators: 1: list of tags.
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'baselayer' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link( sprintf( wp_kses(
				// translators: %s: post title
				__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'baselayer' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			wp_kses_post( get_the_title() )
			) );
			echo '</span>';
		}

		edit_post_link( sprintf( wp_kses(
			// translators: %s: Name of current post. Only visible to screen readers
			__( 'Edit <span class="screen-reader-text">%s</span>', 'baselayer' ),
			array(
				'span' => array(
					'class' => array(),
				),
			)
		),
		wp_kses_post( get_the_title() )
		),
		'<span class="edit-link">',
		'</span>'
		);
	}
} //endif;

if ( ! function_exists( 'yo_baselayerpost_thumbnail' ) ) {
	/**
	 * Displays an optional post thumbnail.
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function yo_baselayerpost_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) {
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

		<?php } else { ?>

			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
					the_post_thumbnail(
						'post-thumbnail',
						array(
							'alt' => the_title_attribute(
								array(
									'echo' => false,
								)
							),
						)
					);
				?>
			</a>

			<?php
		} //endif is_singular().
	}
} //endif;

if ( ! function_exists( 'wp_body_open' ) ) {
	/**
	 * Shim for sites older than 5.2.
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
} //endif;
