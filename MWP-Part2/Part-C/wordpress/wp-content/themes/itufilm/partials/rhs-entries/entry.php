<?php
/**
 * Handles default display of posts as entries within a content box on the right hand side of the main content area on a
 * page (e.g. the "Upcoming Events" box on the front page).
 * Assumes that the including script exposes a variable with name 'post_entry' that contains a post formatted as an array
 * as per the result items of GetPostsQuery().
 *
 * User: varmarken
 * Date: 16/04/15
 * Time: 18:12
 */

?>
<div class="section-item">
    <div class="thumbnail">
        <div class="thumbnail-content-wrapper">
            Post type not recognized.<br/>
            No image available.
        </div>
    </div>
    <div class="details">
        <div class="details-content-wrapper">
            <h4>
                <?php echo $post_entry["post_title"];?>
            </h4>
            <?php echo $post_entry["post_content"];?>
        </div>
    </div>
</div>