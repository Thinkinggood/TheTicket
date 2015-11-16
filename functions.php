<?php

add_action('wp_enqueue_scripts', 'my_mediaelement_settings');
function my_mediaelement_settings() {
        wp_deregister_script('wp-mediaelement');
        wp_register_script('wp-mediaelement', get_stylesheet_directory_uri() . '/js/mediaelement/wp-mediaelement.js', array( 'mediaelement' ), false, true);
}
