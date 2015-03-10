<?php
define('CPT_NAME', "Слайдер на главной");
define('CPT_SINGLE', "Слайдер на главной");
define('CPT_TYPE', "slider-image");
add_theme_support('post-thumbnails', array('slider-image'));

function efs_register() {
    $args = array(
        'label' => __(CPT_NAME),
        'singular_label' => __(CPT_SINGLE),
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => true,
        'supports' => array('title', 'editor', 'thumbnail')
       );
 
    register_post_type(CPT_TYPE , $args );
}  
add_action('init', 'efs_register');
?>