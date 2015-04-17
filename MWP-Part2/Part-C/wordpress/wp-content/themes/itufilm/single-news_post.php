<?php
/**
 * Handles display of single news post.
 * User: varmarken
 * Date: 17/04/15
 * Time: 15:16
 */
?>
<?php get_header() ?>
<?php
$main_content_left_boxes = array(
    // Tuple containing the box heading and a query that defines the posts to be displayed in the box.
    array(
        'heading' => 'News Post',
        'query' => $wp_query // Use the main query which should contain only the single news post that is to be displayed.
    )
);
include(locate_template('partials/maincontentleft.php'));

?>
<?php get_footer() ?>