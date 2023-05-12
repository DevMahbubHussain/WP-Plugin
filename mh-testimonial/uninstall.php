<?php 

    if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) )
    {
        die;
    }

    delete_option( 'widget_mh-testimonial' );
    $posts = get_posts(
        array(
            'post_type' => 'mh-testimonials',
            'number_posts'  => -1,
            'post_status'   => 'any'
        )
    );

    foreach( $posts as $post ){
        wp_delete_post( $post->ID, true );
    }

    // drop a custom database table
    global $wpdb;
    $wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}mytable" );