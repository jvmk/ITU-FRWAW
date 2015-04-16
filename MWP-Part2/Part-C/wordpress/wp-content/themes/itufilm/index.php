<?php get_header(); ?>
<?php
// First produce the main/primary (left hand side) content.
// Set the headings and populates content for boxes containing the main (left hand side) content on the front page.
// Array of arrays facilitates the ability to have multiple content boxes.
global $wp_query; // Fetches the main query into current scope.
$main_content_left_boxes = array(
    // Tuple containing the box heading and a query that defines the posts to be displayed in the box.
    array(
        'heading' => 'News',
        'query' => $wp_query // Use posts from the main query (which is altered in functions.php for index.php).
    )
);
include(locate_template('partials/maincontentleft.php'));


// Now produce the secondary (right hand side) content...
// First build a query for the upcoming screenings.
// (Note the slight difference between the arguments passed to the templates: whereas the LHS content is given a query
// argument, the RHS (below) is given a list of posts, i.e. the result of running a query)
$upcoming_screenings_query_args = array(
    'post_type'			=> 'screening',
    'orderby'           => 'event_date',
    'order'             => 'ASC',
    'limit'             => 3
);
$upcoming_screenings_query = new GetPostsQuery();
$upcoming_screenings = $upcoming_screenings_query->get_posts($upcoming_screenings_query_args);
$rhs_content_boxes = array(
    array(
        'heading' => 'Upcoming Screenings',
        'items' => $upcoming_screenings
    )
);
include(locate_template('partials/rhs-content.php'));
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