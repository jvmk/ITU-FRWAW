<?php
/**
 * The blogs page.
 * User: varmarken
 * Date: 17/04/15
 * Time: 18:59
 */
?>

<?php get_header(); ?>

<?php

// Update the main query to fetch screenings.
// Inspired by "Example Using Custom Post Types" here: https://codex.wordpress.org/Page_Templates
$args = array (
    'post_type' => 'movie_blog_post',
    'post_status' => 'publish',
    'posts_per_page' => 1, // Only one featured blog.
    'order' => 'DESC' //
);
$temp = $wp_query; // assign ordinal query to temp variable for later use
$wp_query = null;
$wp_query = new WP_Query($args);

$main_content_left_boxes = array(
    // Tuple containing the box heading and a query that defines the posts to be displayed in the box.
    array(
        'heading' => 'Featured Blog',
        'query' => $wp_query
    )
);
include(locate_template('partials/maincontentleft.php'));

$wp_query = $temp; // reassign ordinal query



// Now produce the secondary (right hand side) content...
// (Note the slight difference between the arguments passed to the templates: whereas the LHS content is given a query
// argument, the RHS (below) is given a list of posts, i.e. the result of running a query)
$recent_blogs_query_args = array(
    'post_type'			=> 'movie_blog_post',
    'limit'             => 3 // use default ordering (newest blog post first)
);
$recent_blogs_query = new GetPostsQuery();
$recent_blogs = $recent_blogs_query->get_posts($recent_blogs_query_args);
$rhs_content_boxes = array(
    array(
        'heading' => 'Recent Blogs',
        'items' => $recent_blogs
    )
);
include(locate_template('partials/rhs-content.php'));
?>
?>




<?php get_footer(); ?>