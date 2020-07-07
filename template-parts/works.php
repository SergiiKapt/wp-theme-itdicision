<?php

$args = array(
    'post_type'      => 'work',
    'post_status'    => 'publish',
    'posts_per_page' => - 1,
    'post__in'=> get_post_meta(get_the_ID(), 'work_select2_posts')[0],
    'posts_per_page' => 3,
);
$query = new WP_Query( $args );
if ( $query->have_posts() ) : ?>
<div class="work__list">
    <?php
    while ( $query->have_posts() ) :
        $query->the_post();
        ?>
        <div class="work__item">
             <div class="work__img"
            style="background: url(<?php has_post_thumbnail()?the_post_thumbnail_url('work-thumb') : '' ?>);background-size: cover;">
             </div>
        <span class="d__separator"></span>
        <h3 class="title">
            <?php echo the_title(); ?></h3>
        <div class="description">
            <?php the_content() ?>
        </div>
        </div>
    <?php endwhile; ?>
</div>
<?php  endif ;
wp_reset_postdata();