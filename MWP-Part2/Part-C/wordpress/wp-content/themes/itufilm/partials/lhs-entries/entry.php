<?php
/**
 * Created by PhpStorm.
 * User: varmarken
 * Date: 16/04/15
 * Time: 18:12
 */

// Default display of posts as entries within a content box on a page (e.g. the "News" box on the front page).
// Assumes that the including script exposes a variable with name 'post_entry' that contains a post.
?>
<article>
    <h1>
        <?php echo get_the_title($post_entry);?>
    </h1>
    <?php echo the_content($post_entry);?>
</article>