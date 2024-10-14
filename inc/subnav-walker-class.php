<?php
/**
 * Create HTML list of pages.
 * This is where the super-awesome (and very nit-picky) secondary nav comes from
 *
 * @package Razorback
 * @subpackage Walker
 * @author Michael Fields <michael@mfields.org>
 * @copyright Copyright (c) 2010, Michael Fields
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 * @uses Walker_Page
 *
 * @since 2010-05-28
 * @alter 2010-10-09
 */
class Razorback_Walker_Page_Selective_Children extends Walker_Page {
	/**
	 * Walk the Page Tree.
	 *
	 * @global stdClass WordPress post object.
	 * @uses Walker_Page::$db_fields
	 * @uses Walker_Page::display_element()
	 *
	 * @since 2010-05-28
	 * @alter 2010-10-09
	 */
	function walk( $elements, $max_depth, ...$args ) {
		global $post;
		// print_r($post->ancestors);
		// print_r($elements);
		$args = array_slice( func_get_args(), 2 );
		$output = '';

		/* invalid parameter */
		if ( $max_depth < -1 ) {
			return $output;
		}

		/* Nothing to walk */
		if ( empty( $elements ) ) {
			return $output;
		}

		/* Set up variables. */
		$top_level_elements = array();
		$children_elements  = array();
		$parent_field = $this->db_fields['parent'];
		$child_of = ( isset( $args[0]['child_of'] ) ) ? (int) $args[0]['child_of'] : 0;
		$ancestors = $post->ancestors;

		if ( empty( $ancestors ) ) {
			$children = get_pages( array( 'child_of' => $post->ID ) );
			if ( $children ) {
				$ancestors[] = $post->ID;
			}
		}

		/* Loop elements */
		foreach ( (array) $elements as $e ) {
			$parent_id = $e->$parent_field;
			if ( isset( $parent_id ) ) {
				/* Top level pages. */
				if ( $child_of === $parent_id && ( isset( $ancestors ) && in_array( $e->ID, (array) $ancestors ) ) ) {
					$top_level_elements[] = $e;
				}
				/* Only display children of the current hierarchy. */
				elseif (
					( isset( $post->ID ) && $parent_id == $post->ID ) ||
					( isset( $post->post_parent ) && $parent_id == $post->post_parent ) ||
					( isset( $post->ancestors ) && in_array( $parent_id, (array) $post->ancestors ) )
				) {
					$children_elements[ $e->$parent_field ][] = $e;
				}
			}
		}

		/* Define output. */
		foreach ( $top_level_elements as $e ) {
			$this->display_element( $e, $children_elements, $max_depth, 0, $args, $output );
		}
		return $output;
	}
}
