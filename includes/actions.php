<?php

add_action('after_setup_theme', 'workecisionSupport');
function workecisionSupport()
{
    add_theme_support('post-thumbnails');
    add_image_size('work-thumb', 350, 380, true);
    add_image_size('work-thumb-sm', 480, 300, true);
    //add_theme_support( 'html5', array( 'search-form' ) );

//    if ( function_exists('register_sidebar') ) {
//        register_sidebar();
//    }

}

add_action('admin_menu', 'remove_my_post_metaboxes');
function remove_my_post_metaboxes()
{
    remove_meta_box('authordiv', ['post', 'page'], 'normal'); // Author Metabox
    remove_meta_box('commentstatusdiv', ['post', 'page'], 'normal'); // Comments Status Metabox
    remove_meta_box('commentsdiv', ['post', 'page'], 'normal'); // Comments Metabox
    remove_meta_box('postcustom', ['post', 'page'], 'normal'); // Custom Fields Metabox
    remove_meta_box('postexcerpt', ['post', 'page'], 'normal'); // Excerpt Metabox
    remove_meta_box('revisionsdiv', ['post', 'page'], 'normal'); // Revisions Metabox
    remove_meta_box('slugdiv', ['post', 'page'], 'normal'); // Slug Metabox
    remove_meta_box('trackbacksdiv', ['post', 'page'], 'normal'); // Trackback Metabox
}

add_action('admin_menu', 'countdown_shortcode_metabox');
function countdown_shortcode_metabox()
{
    add_meta_box('countdown_shortcode', 'Add Countdown shortcode', 'countdown_shortcode_display_metabox', 'page', 'normal', 'default');
}
function countdown_shortcode_display_metabox($post_object)
{
    $html = '';
    $appended_posts = get_post_meta($post_object->ID, 'countdown_shortcode', true);
    $html .= '<p><label>Shortcode:</label><br />';
        $html .= '<input name="countdown_shortcode" value="' . $appended_posts . '" type="text" style="width:99%;max-width:20em;">';
    $html .= '</p>';

    echo $html;
}


add_action('admin_menu', 'work_metabox_for_select2');
function work_metabox_for_select2()
{
    add_meta_box('work_select2', 'Add works posts', 'work_display_select2_metabox', 'page', 'normal', 'default');
}

function work_display_select2_metabox($post_object)
{
    $html = '';
    $appended_posts = get_post_meta($post_object->ID, 'work_select2_posts', true);
    $html .= '<p><label for="work__select2">Works:</label><br /><select id="work__select2" name="work_select2_posts[]" multiple="multiple" style="width:99%;max-width:300px;">';
    if ($appended_posts) {
        foreach ($appended_posts as $post_id) {
            $title = get_the_title($post_id);
            // if the post title is too long, truncate it and add "..." at the end
            $title = (mb_strlen($title) > 50) ? mb_substr($title, 0, 49) . '...' : $title;
            $html .= '<option value="' . $post_id . '" selected="selected">' . $title . '</option>';
        }
    }
    $html .= '</select></p>';

    echo $html;
}

add_action('save_post', 'work_save_metaboxdata', 10, 2);
function work_save_metaboxdata($post_id, $post)
{
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;
    if ($post->post_type == 'page') {
        if (isset($_POST['work_select2_posts']))
            update_post_meta($post_id, 'work_select2_posts', $_POST['work_select2_posts']);
        else
            delete_post_meta($post_id, 'work_select2_posts');
        if (isset($_POST['countdown_shortcode']))
            update_post_meta($post_id, 'countdown_shortcode', $_POST['countdown_shortcode']);
        else
            delete_post_meta($post_id, 'countdown_shortcode');
    }



    return $post_id;
}

add_action('wp_ajax_getwork', 'work_get_posts_ajax_callback');
function work_get_posts_ajax_callback()
{
    $return = array();
    $search_results = new WP_Query(array(
        's' => $_GET['q'],
        'post_type' => 'work',
        'post_status' => 'publish',
        'ignore_sticky_posts' => 1,
        'posts_per_page' => 50
    ));
    if ($search_results->have_posts()) :
        while ($search_results->have_posts()) : $search_results->the_post();
            // shorten the title a little
            $title = (mb_strlen($search_results->post->post_title) > 50) ? mb_substr($search_results->post->post_title, 0, 49) . '...' : $search_results->post->post_title;
            $return[] = array($search_results->post->ID, $title); // array( Post ID, Post Title )
        endwhile;
    endif;

    echo json_encode($return);
    die;
}