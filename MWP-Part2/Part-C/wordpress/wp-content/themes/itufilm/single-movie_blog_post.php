<?php
/**
 * Handles display of a blog post on a page dedicated to only that post.
 * User: varmarken
 * Date: 17/04/15
 * Time: 20:42
 */
?>

<?php get_header();?>

<?php
$main_content_left_boxes = array(
    // Tuple containing the box heading and a query that defines the posts to be displayed in the box.
    array(
        'heading' => 'Movie Blog Post',
        'query' => $wp_query // Use the main query which should contain only the single movie blog post that is to be displayed.
    )
);
include(locate_template('partials/maincontentleft.php'));
?>

<?php get_footer();?>