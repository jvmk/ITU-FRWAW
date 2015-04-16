<?php get_header(); ?>
<?php
// Set the headings for boxes containing the main content on the front page.
// Array of arrays facilitates the ability to have multiple content boxes.
// The array keyed by 'post_query_args' defines the query args used when fetching the posts for the box using get_posts(array).
global $wp_query;
$main_content_left_boxes = array(
    // Tuple containing the box heading and arguments for fetching the posts to be displayed in the box.
    array(
        'heading' => 'News',
        'posts' => $wp_query // Use posts from the main query (which is altered in functions.php for index.php).
    )
);
include(locate_template('partials/maincontentleft.php'));
//get_template_part('partials/maincontentleft', 'index');
?>
<!--    <section id="content" role="main">-->
<!--        --><?php //if (have_posts()) : while (have_posts()) : the_post(); ?>
<!--            --><?php //get_template_part('entry'); ?>
<!--            --><?php //comments_template(); ?>
<!--        --><?php //endwhile; endif; ?>
<!--        --><?php //get_template_part('nav', 'below'); ?>
<!--    </section>-->
<?php //get_sidebar(); ?>
<?php get_footer(); ?>