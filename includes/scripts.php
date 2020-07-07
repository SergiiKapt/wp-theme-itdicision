<?php

add_action('wp_enqueue_scripts', 'frontendScripts');
function frontendScripts()
{
    wp_enqueue_style('fonts-style', ROOT_URI . '/assets/css/fonts.css', array() ,false, 'all');
    wp_enqueue_style('reset-style', ROOT_URI . '/assets/css/reset.css', array() ,false, 'all');
    wp_enqueue_style('itdecision-style', get_stylesheet_uri(), array(), false, 'all');

    wp_deregister_script('jquery');
    wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-3.4.1.min.js', array(), null, true);
//    wp_enqueue_script('animateNumber-js', ROOT_URI . '/assets/js/jquery.animateNumber.min.js', array('jquery'), null, true);
//    wp_enqueue_script('itdecision-js', ROOT_URI . '/assets/js/script.js', array('jquery', 'animateNumber-js'), null, true);
}

add_action('admin_enqueue_scripts', 'rudr_select2_enqueue');
function rudr_select2_enqueue()
{
    wp_enqueue_style('select2', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css');

    wp_enqueue_script('select2', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js', array('jquery'));
    wp_enqueue_script('admin', get_stylesheet_directory_uri() . '/assets/js/admin.js', array('jquery', 'select2'));
}