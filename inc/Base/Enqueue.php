<?php

namespace Inc\Base;

class Enqueue extends BaseController {

	public function register(){
		add_action( 'admin_enqueue_scripts', array( $this, 'suep_admin_script_style' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'suep_widget_style' ) );
	}

	/**
	 * Enqueueing scripts and styles in the admin
	 * @param  int $hook Current page hook
	 */
	public function suep_admin_script_style( $hook ) {
		global $post_type;

		if ( ( 'post.php' == $hook || 'post-new.php' == $hook ) && ( 'suep_event' == $post_type ) ) {
			wp_enqueue_script( 'upcoming-events', $this->plugin_url . 'js/script.js', array( 'jquery', 'jquery-ui-datepicker' ), '1.0', true );
			wp_enqueue_style( 'jquery-ui-calendar', $this->plugin_url . 'css/jquery-ui-1.10.4.custom.min.css', false, '1.10.4', 'all' );
		}
	}

	/**
	 * Enqueueing styles for the front-end widget
	 */
	public function suep_widget_style() {
		if ( is_active_widget( '', '', 'suep_upcoming_events', true ) ) {
			wp_enqueue_style( 'upcoming-events', $this->plugin_url . 'css/upcoming-events.css', false, '1.0', 'all' );
		}
	}

}