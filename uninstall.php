<?php

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) )
die( 'Unauthorized Access!' );

function go_delete_now() {
    global $wpdb;

    $posts = get_posts( array(
        'numberposts' => -1,
        'post_type' => 'suep_event',
        'post_status' => 'any' ) );

    foreach ( $posts as $post ){
        wp_delete_post( $post->ID, true );
    }
}

go_delete_now();
