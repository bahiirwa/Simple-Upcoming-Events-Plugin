<?php

namespace Inc\Base;
/**
 * Adding metabox for event information
 */

class Metabox {

	public function register() {
		
		add_action( 'save_post', array( $this, 'suep_save_event_info' ) );
		add_action( 'add_meta_boxes', array( $this, 'suep_add_event_info_metabox' ) );

	}

	public function suep_add_event_info_metabox() {
		add_meta_box(
			'suep-event-info-metabox',
			__( 'Event Info', 'suep' ),
			array( $this, 'suep_render_event_info_metabox' ),
			'suep_event',
			'side',
			'core'
		);
	}

	/**
	 * Rendering the metabox for event information
	 * @param  object $post The post object
	 */
	public function suep_render_event_info_metabox( $post ) {
		//generate a nonce field
		wp_nonce_field( basename( __FILE__ ), 'suep-event-info-nonce' );

		//get previously saved meta values (if any)
		$event_start_date = get_post_meta( $post->ID, 'event-start-date', true );
		$event_end_date = get_post_meta( $post->ID, 'event-end-date', true );
		$event_venue = get_post_meta( $post->ID, 'event-venue', true );

		//if there is previously saved value then retrieve it, else set it to the current time
		$event_start_date = ! empty( $event_start_date ) ? $event_start_date : time();

		//we assume that if the end date is not present, event ends on the same day
		$event_end_date = ! empty( $event_end_date ) ? $event_end_date : $event_start_date;

		?>
		<p> 
			<label for="suep-event-start-date"><?php _e( 'Event Start Date:', 'uep' ); ?></label>
			<input type="text" id="suep-event-start-date" name="suep-event-start-date" class="widefat suep-event-date-input" value="<?php echo date( 'F d, Y', $event_start_date ); ?>" placeholder="Format: February 18, 2014">
		</p>
		<p>
			<label for="suep-event-end-date"><?php _e( 'Event End Date:', 'uep' ); ?></label>
			<input type="text" id="suep-event-end-date" name="suep-event-end-date" class="widefat suep-event-date-input" value="<?php echo date( 'F d, Y', $event_end_date ); ?>" placeholder="Format: February 18, 2014">
		</p>
		<p>
			<label for="suep-event-venue"><?php _e( 'Event Venue:', 'uep' ); ?></label>
			<input type="text" id="suep-event-venue" name="suep-event-venue" class="widefat" value="<?php echo $event_venue; ?>" placeholder="eg. Times Square">
		</p>
		<?php
	}


	/**
	 * Saving the event along with its meta values
	 * @param  int $post_id The id of the current post
	 */
	public function suep_save_event_info( $post_id ) {

		global $post_type;
		//checking if the post being saved is an 'suep_event',
		//if not, then return
		if ( 'suep_event' != $post_type ) {
			return;
		}

		//checking for the 'save' status
		$is_autosave = wp_is_post_autosave( $post_id );
		$is_revision = wp_is_post_revision( $post_id );
		$is_valid_nonce = ( isset( $_POST['suep-event-info-nonce'] ) && ( wp_verify_nonce( $_POST['suep-event-info-nonce'], basename( __FILE__ ) ) ) ) ? true : false;

		//exit depending on the save status or if the nonce is not valid
		if ( $is_autosave || $is_revision || ! $is_valid_nonce ) {
			return;
		}

		//checking for the values and performing necessary actions
		if ( isset( $_POST['suep-event-start-date'] ) ) {
			update_post_meta( $post_id, 'event-start-date', strtotime( $_POST['suep-event-start-date'] ) );
		}

		if ( isset( $_POST['suep-event-end-date'] ) ) {
			update_post_meta( $post_id, 'event-end-date', strtotime( $_POST['suep-event-end-date'] ) );
		}

		if ( isset( $_POST['suep-event-venue'] ) ) {
			update_post_meta( $post_id, 'event-venue', sanitize_text_field( $_POST['suep-event-venue'] ) );
		}
	}
	
}