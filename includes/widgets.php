<?php
add_action('widgets_init', 'as_register_sidebars');
function as_register_sidebars()
{
    register_sidebar(array(
        'name' => 'Footer Widget Left',
        'id' => 'footer_widget_left',
        'description' => __('Footer text left'),
        'before_widget' => '<div class="widget fwl">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>'
    ));

    register_sidebar(array(
        'name' => 'Footer Widget Right',
        'id' => 'footer_widget_right',
        'description' => __('Footer text right'),
        'before_widget' => '<div class="widget fwr">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>'
    ));
}