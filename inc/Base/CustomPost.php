<?php

namespace Inc\Base;
/**
 * Registering custom post type for events
 */
class CustomPost {

	public function register() {
		add_action( 'init', array( $this, 'suep_custom_post_type' ) );
	}

	public static function suep_custom_post_type() {

		$labels = array(
			'name'					=>	__( 'Events', 'suep' ),
			'singular_name'			=>	__( 'Event', 'suep' ),
			'add_new_item'			=>	__( 'Add New Event', 'suep' ),
			'all_items'				=>	__( 'All Events', 'suep' ),
			'edit_item'				=>	__( 'Edit Event', 'suep' ),
			'new_item'				=>	__( 'New Event', 'suep' ),
			'view_item'				=>	__( 'View Event', 'suep' ),
			'not_found'				=>	__( 'No Events Found', 'suep' ),
			'not_found_in_trash'	=>	__( 'No Events Found in Trash', 'suep' )
		);

		$args = array(
			'label'			=>	__( 'Events', 'suep' ),
			'labels'		=>	$labels,
			'description'	=>	__( 'A list of upcoming events', 'suep' ),
			'public'		=>	true,
			'show_in_menu'	=>	true,
			'menu_icon'		=>	'dashicons-calendar-alt',
			'has_archive'	=>	true,
			'rewrite'		=>	true,
			'supports'		=>	array( 'title', 'editor', 'excerpt' ),
			'show_in_rest'  =>  true
		);

		register_post_type( 'suep_event', $args );
	}

}