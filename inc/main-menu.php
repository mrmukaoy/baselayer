<?php

function yo_baselayer_main_menu() {

	// Try to get the menu from a transient first
	if ( ! $menu = get_transient( 'yo_baselayer_main_menu' ) ) {

		if ( has_nav_menu( 'primary' ) ) {

			$args = array(
				'theme_location' => 'primary',
				'container'      => false,
				'items_wrap'     => '%3$s',
				'echo'           => false,
			);

			$menu = wp_nav_menu( $args );

		} else {

			$frontpage_id = get_option( 'page_on_front' );
			$args = array(
				'title_li'    => '', '',
				'exclude'     => $frontpage_id,
				'echo'        => false,
				'walker'      => new yo_baselayer_main_menu(),
			);

			$menu = wp_list_pages( $args );
		}

		// Cache the resulting menu in a transient for 24 hours
		set_transient( 'yo_baselayer_main_menu', $menu, 60*60*24 );
	}

	echo $menu;
}


function yo_baselayer_main_menu_flush_cached_menu() {
	delete_transient( 'yo_baselayer_main_menu' );
}
add_action( 'wp_update_nav_menu',  'yo_baselayer_main_menu_flush_cached_menu' );
add_action( 'publish_page', 'yo_baselayer_main_menu_flush_cached_menu' );
add_action( 'edit_page', 'yo_baselayer_main_menu_flush_cached_menu' );
add_action( 'trash_page', 'yo_baselayer_main_menu_flush_cached_menu' );
