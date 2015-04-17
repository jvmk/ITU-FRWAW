<?php
/**
 * Handles display of a single news item in the 'News' section of the front page.
 * User: varmarken
 * Date: 16/04/15
 * Time: 18:11
 */
?>
<article>

    <h1>
        <?php
        // Get the permalink for this news_post.
        $post_entry_permalink = "";
        if(is_array($post_entry)) {
            // CCTM query item.
            // Must use filter.
            $post_entry_permalink = CCTM::filter($post_entry["ID"], 'to_link_href');
        } else {
            // Main loop query item.
            // Simply get permalink from current item.
            $post_entry_permalink = get_post_permalink();
        }
        ?>
        <a href="<?php echo $post_entry_permalink;?>"><?php echo get_the_title($post_entry);?></a>
    </h1>
    <?php
    // Get the url for the image for the news post.
    $imgurl = "";
    if(is_array($post_entry) && isset($post_entry["news_post_img"])) {
        // Specialized wp query.
        // Image media is part of the array.
        // Use function to convert media id to url.
        $imgurl = CCTM::filter($post_entry["news_post_img"], 'to_image_src');
    } else {
        // Regular (main) wp query.
        // Can access src uri through get_custom_field.
        $imgurl = get_custom_field("news_post_img");
    }
    // Now add the image to the html.
    ?>
    <img src="<?php print $imgurl?>">
    <?php echo the_content($post_entry);?>
</article>