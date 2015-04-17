<?php
/*
Template Name: Movies
*/
?>

<?php get_header(); ?>
<?php

// Set the headings and populates content for boxes containing the main (left hand side) content area.
// Array of arrays facilitates the ability to have multiple content boxes.

// Update the main query to fetch screenings.
// Inspired by "Example Using Custom Post Types" here: https://codex.wordpress.org/Page_Templates
$args = array (
    'post_type' => 'screening',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'ignore_sticky_posts'=> 1,
    'meta_query' => array(
        array(
            'key' => 'event_date',
            'type' => 'DATE',
            'value' => date('Y-m-d H:i:s'), // todays date (exclude past screenings)
            'compare' => '>'
        )
    ),
    'orderby' => 'meta_value',
//    'meta_key' => '_events_meta',
    'order' => 'ASC'
);
$temp = $wp_query; // assign ordinal query to temp variable for later use
$wp_query = null;
$wp_query = new WP_Query($args);

$main_content_left_boxes = array(
    // Tuple containing the box heading and a query that defines the posts to be displayed in the box.
    array(
        'heading' => 'Screening Schedule',
        'query' => $wp_query // Use posts from the main query (which is altered in functions.php for index.php).
    )
);
include(locate_template('partials/maincontentleft.php'));

$wp_query = $temp; // reassign ordinal query

get_footer();