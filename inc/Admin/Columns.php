<?php

namespace Inc\Admin;

class Columns {

	public function register() {

		add_filter( 'manage_edit-suep_event_columns', array ( $this, 'suep_custom_columns_head' ), 10 );
		add_action( 'manage_suep_event_posts_custom_column', array ( $this, 'suep_custom_columns_content' ), 10, 2 );
		add_action( 'quick_edit_custom_box', array ( $this, 'generatewp_quickedit_fields', 10, 2 ) );

	}

	/**
	 * Custom columns head
	 * @param  array $defaults The default columns in the post admin
	 */

	public function suep_custom_columns_head( $defaults ) {
		unset( $defaults['date'] );

		$defaults['event_start_date'] = __( 'Start Date', 'uep' );
		$defaults['event_end_date'] = __( 'End Date', 'uep' );
		$defaults['event_venue'] = __( 'Venue', 'uep' );

		return $defaults;
	}
	
	/**
	 * Custom columns content
	 * @param  string 	$column_name The name of the current column
	 * @param  int 		$post_id     The id of the current post
	 */
	public function suep_custom_columns_content( $column_name, $post_id ) {
		if ( 'event_start_date' == $column_name ) {
			$start_date = get_post_meta( $post_id, 'event-start-date', true );
			echo date( 'F d, Y', $start_date );
		}

		if ( 'event_end_date' == $column_name ) {
			$end_date = get_post_meta( $post_id, 'event-end-date', true );
			echo date( 'F d, Y', $end_date );
		}

		if ( 'event_venue' == $column_name ) {
			$venue = get_post_meta( $post_id, 'event-venue', true );
			echo $venue;
		}
	}

}