<?php

defined( 'ITDECISION' ) or die;

add_action( 'init', 'as_register_posttype' );
function as_register_posttype(){
    register_post_type('work', array(
        'labels'             => array(
            'name'               => 'Работы',
            'singular_name'      => 'Работа',
            'add_new'            => 'Добавить новую',
            'add_new_item'       => 'Добавить новую Работу',
            'edit_item'          => 'Редактировать Работу',
            'new_item'           => 'Новый Работа',
            'view_item'          => 'Посмотреть Работу',
            'search_items'       => 'Найти Работу',
            'not_found'          => 'Работу не найдено',
            'not_found_in_trash' => 'В корзине Работу не найдено',
            'menu_name'          => 'Работы'
        ),
        'public'             => false,
        'hierarchical'       => false,
        'menu_position'      => 30,
        'supports'           => array('title','editor','thumbnail'),
        'exclude_from_search' => true,
        'show_ui' 			=> true,
        'show_in_menu' 		=> true,
        'menu_icon' 		=> 'dashicons-testimonial',
    ) );
}
