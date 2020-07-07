<?php

get_header();
?>

<?php while (have_posts()) : the_post(); ?>
    <div class="post__content">
        <div class="wrap">
            <?php echo the_content(); ?>
        </div>
    </div>

<?php if($countdown_shortcode = get_post_meta(get_the_ID(), 'countdown_shortcode')[0]) : ?>
    <div class="countdown">
        <div class="wrap">
            <div class="countdown__content">
                <?php echo do_shortcode( $countdown_shortcode) ?>
            </div>
        </div>
    </div>
<?php endif; ?>
    <div class="post__title">
        <div class="wrap text__center">
            <h2 class="title"><?php the_title(); ?></h2>
        </div>
    </div>

    <div class="work">
        <div class="wrap">
            <?php get_template_part('template-parts/works') ?>
        </div>
    </div>
<?php endwhile; ?>

<?php
get_footer();