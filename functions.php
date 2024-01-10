<?php
// Enqueue the parent style
add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );

function enqueue_parent_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}

// Enqueue the child theme's compiled CSS file
add_action( 'wp_enqueue_scripts', 'enqueue_child_theme_styles', 11 );

function enqueue_child_theme_styles() {
    $parent_style = 'parent-style'; // This is 'geist-style' for the Geist theme.
    
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/css/geist-master-child.css',
        array( $parent_style ),
        wp_get_theme()->get('Version') // This ensures that a version number is assigned to the stylesheet.
    );
}
?>
